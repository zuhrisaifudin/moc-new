<?php

namespace App\Http\Controllers\Central\Authentication;

use App\Repositories\Permission\PermissionRepository;
use App\Repositories\Module\ModuleRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $PermissionRepository;
    private $ModulRepository;

    public function __construct(
        PermissionRepository $PermissionRepository,
        ModuleRepository $ModulRepository
    ){
        $this->PermissionRepository = $PermissionRepository;
        $this->ModulRepository = $ModulRepository;
    }  

    public function index(Request $request)
    {
        $data = [];
        $data['module'] = $this->ModulRepository->pluckNameWithId(); 
        $data['totalPermission'] = $this->PermissionRepository->countTotalPermission();
        $data['totalActivePermission'] = $this->PermissionRepository->countTotalPermissionByStatus(1);
        $data['totalInactivePermission'] = $this->PermissionRepository->countTotalPermissionByStatus(0);
        
        return view('pages.authentication.permission.index')->with($data);
    }
    
    public function getAllPermission(Request $request){
        try {
            $filters = [
                'search' => $request->input('search.value'),
                'module' => $request->get('module', 'all'),
            ];

            $query = $this->PermissionRepository->getAll($filters);
            return DataTables::of($query)
                ->addColumn('option', function($permission) {
                    return view('pages.authentication.permission._action-table', [
                        'id' => Crypt::encryptString($permission->id),
                        'name' => $permission->name ?? '',
                    ]);
                })
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error in getAllModule: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Error retrieving user data',
            ], 400);
        }
    }

    public function addPermission(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required'
        ], [
            'name.required' => "Nama Permission harus dibuat",
            'display_name.required' => "Display Permission harus dibuat",
            'description.required' => "Deskripsi Permission harus dibuat"
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
            $this->PermissionRepository->createPermission($data);
            return response()->json([
                "code" => 1000,
                "message" => "Permission baru berhasil dibuat.",
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
    
            return response()->json([
                "code" => 2000,
                "message" => "Mohon maaf, terjadi kesalahan saat menambahkan permission."
            ], 400);
        }
    }

    public function onDetailPermission(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $permission = $this->PermissionRepository->getPermissionById($id);
            $module = $this->PermissionRepository->pluckNameWithId();
         
            if (!$permission) {
                return response()->json([
                    'code' => 2000,
                    'message' => "Sistem Permission tidak ditemukan"
                ]);
            }
            $data = [
                'permission' => $permission,
                'module' => $this->PermissionRepository->pluckNameWithId(),
            ];

            return response()->json([
                'code' => 1000,
                'content' => view('pages.authentication.permission.edit', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in get Permission : ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function updatePermission(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'display_name' => 'required',
            'description'  => 'required',
        ], [
            'display_name.required' => "Display Permission harus diisi",
            'description.required'  => "Deskripsi Permission harus diisi",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 2000,
                'message' => implode("<br />", $validator->errors()->all())
            ], 400);
        }

        try {
            $permissionId = Crypt::decryptString($id);
            $data = $request->only(['display_name', 'description', 'module_id','is_active']);
            $updatedPermission = $this->PermissionRepository->updatePermission($data, $permissionId);
            return response()->json([
                'code' => 1000,
                'message' => 'Permission berhasil diubah.',
                'data' => $updatedPermission
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'ID permission tidak valid.'
            ], 400);
        } catch (\Exception $e) {
            Log::error('Update Permission Error: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat mengubah data permission.'
            ], 400);
        }
    }

    public function onDeletePermission(Request $request, $id) {
        try {
            $permission_id = Crypt::decryptString($id);
            $deleted = $this->PermissionRepository->deletePermission($permission_id);
            if (!$deleted) {
                return response()->json([
                    'code' => 2000,
                    'message' => 'Mohon Maaf, Permission gagal dihapus'
                ]);
            }

            return response()->json([
                'code' => 1000,
                'message' => 'Permission telah dihapus.'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'Permission tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat menghapus permission.'
            ], 400);
        }
    }


    
}
