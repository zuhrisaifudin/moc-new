<?php

namespace App\Http\Controllers\Central\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

use App\Repositories\Role\RoleRepository;
use App\Repositories\Module\ModuleRepository;
use App\Repositories\Permission\PermissionRepository;

class RoleController extends Controller
{
    private $RoleRepository;
    private $ModuleRepository;
    private $PermissionRepository;

    public function __construct(
        RoleRepository $RoleRepository,
        ModuleRepository $ModuleRepository,
        PermissionRepository $PermissionRepository
    ){
        $this->RoleRepository = $RoleRepository;
        $this->ModuleRepository = $ModuleRepository;
        $this->PermissionRepository = $PermissionRepository;
    }
    public function index(Request $request)
    {
        $data = [];
        $data['totalRole'] = $this->RoleRepository->countTotalRole();
        $data['totalActiveRole'] = $this->RoleRepository->countTotalRoleByStatus(1);
        $data['totalInactiveRole'] = $this->RoleRepository->countTotalRoleByStatus(0);
        
        return view('pages.authentication.role.index')->with($data);
    }

    public function getAllRole(Request $request){
        try {
            $filters = [
                'search' => $request->input('search')['value'] ?? null,
            ];

            $query = $this->RoleRepository->getAll($filters);
            return DataTables::of($query)
                ->addColumn('option', function($role) {
                    return view('pages.authentication.role._action-table', [
                        'id' => Crypt::encryptString($role->id),
                        'name' => $role->name ?? '',
                    ]);
                })->addColumn('count_permission', function($query){
                    return count($query->permissions);
                })->make(true);
        } catch (\Exception $e) {
            Log::error('Error in get Role: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat mengambil data Role',
            ], 400);
        }
    }

    public function addRole(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'display_name'=> 'required',
            'description'=> 'required'
        ], [
            'name.required' => "Nama Role harus dibuat",
            'display_name.required' => "Display Role harus dibuat",
            'description.required' => "Deskripsi Role harus dibuat"
        ]);
    
        if ($validator->fails()) {
            $errs = [];
            $errors = $validator->errors();
            foreach ($errors->all() as $message) {
                $errs[] = $message;
            }
            return response()->json([
                "code" => 2000,
                "message" => implode("<br />", $errs)
            ], 400);
        }
    
        try {
            $data = $request->except("_token");
            $this->RoleRepository->createRole($data);
            return response()->json([
                "code" => 1000,
                "message" => "Role baru berhasil dibuat.",
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "code" => 2000,
                "message" => "Mohon maaf, terjadi kesalahan saat menambahkan Role."
            ], 400);
        }
    }

    public function onDetailRole(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $roles = $this->RoleRepository->getRoleById($id);
         
            if (!$roles) {
                return response()->json([
                    'code' => 2000,
                    'message' => "Sistem Role tidak ditemukan"
                ]);
            }
            $data = [
                'roles' => $roles,
            ];

            return response()->json([
                'code' => 1000,
                'content' => view('pages.authentication.role.edit', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in get Role : ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function updateRole(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'display_name'=> 'required',
            'description'=> 'required',
            'is_active'=> 'required|boolean',
        ], [
            'display_name.required' => "Display Role harus dibuat",
            'description.required' => "Deskripsi Role harus dibuat",
            'is_active.required' => "Status Role harus dibuat",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 2000,
                'message' => implode("<br />", $validator->errors()->all())
            ], 400);
        }

        try {
            $roleId = Crypt::decryptString($id);
            $data = $request->only(['display_name', 'description','is_active']);
            $updatedRole = $this->RoleRepository->updateRole($data, $roleId);
            return response()->json([
                'code' => 1000,
                'message' => 'Role berhasil diubah.',
                'data' => $updatedRole
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'ID Role tidak valid.'
            ], 400);
        } catch (\Exception $e) {
            Log::error('Update Role Error: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat mengubah data Role.'
            ], 400);
        }
    }

    public function onDeleteRole(Request $request, $id) {
        try {
            $role_id = Crypt::decryptString($id);
            $deleted = $this->RoleRepository->deleteRole($role_id);
            if (!$deleted) {
                return response()->json([
                    'code' => 2000,
                    'message' => 'Mohon Maaf, Role gagal dihapus'
                ]);
            }

            return response()->json([
                'code' => 1000,
                'message' => 'Role berhasil dihapus.'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'Role tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat menghapus Role.'
            ], 400);
        }
    }

    // Role Detail

    public function indexDetailRole(Request $request) {

        $data = [];
        $id = Crypt::decryptString($request->id);
        $roles = $this->RoleRepository->getRoleById($id);
        $module = $this->ModuleRepository->getAllWithPermissions();
       
        if (!$roles) {
            return redirect()->route('central-role-page')->with('error', 'Role tidak ditemukan.');
        }

        $data = [
            'roles' => $roles,
            'module' => $module,
            'AllRoles' => $roles->permissions,
        ];
       
        return view('pages.authentication.role.detail')->with($data);
    }

    public function attachPermission(Request $request, $role_id ){
        $role = $this->RoleRepository->getRoleById($role_id);
        $permission = $this->PermissionRepository->findByName($request->permission);
        $role->givePermissionTo($permission);  
    }

    public function detachPermission(Request $request, $role_id){
        $role = $this->RoleRepository->getRoleById($role_id);
        $permission = $this->PermissionRepository->findByName($request->permission);
        $role->revokePermissionTo($permission);
    }
}
