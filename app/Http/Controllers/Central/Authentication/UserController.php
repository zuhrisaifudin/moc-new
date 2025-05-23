<?php

namespace App\Http\Controllers\Central\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Repositories\User\UserRepository;
use App\Repositories\Role\RoleRepository;
use App\Repositories\Module\ModuleRepository;
use App\Repositories\Permission\PermissionRepository;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $UserRepository;
    private $RoleRepository;
    private $ModuleRepository;
    private $PermissionRepository;

    public function __construct(
        UserRepository $userRepository,
        RoleRepository $RoleRepository,
        ModuleRepository $ModuleRepository,
        PermissionRepository $PermissionRepository
    ){
        $this->UserRepository = $userRepository;
        $this->RoleRepository = $RoleRepository;
        $this->ModuleRepository = $ModuleRepository;
        $this->PermissionRepository = $PermissionRepository;
    }
    
    public function index(Request $request){
        
        if (!$request->user()->can('manage-user')) {
            return view('auth-404');
        }
        
        $data= [];
        $data['totalUser'] = $this->UserRepository->countTotalUser();
        $data['totalActiveUser'] = $this->UserRepository->countTotalUserByStatus(1);
        $data['totalInactiveUser'] = $this->UserRepository->countTotalUserByStatus(0);
        $data['totalSoftDeletedUser'] = $this->UserRepository->countSoftDeletedUsers();

        return view('pages.authentication.user.index')->with($data);
    }

    public function getAllUser(Request $request){
        try {
            $filters = [
                'search' => $request->input('search.value'),
    
            ];

            $query = $this->UserRepository->getAll($filters);
            return DataTables::of($query)
                ->addColumn('option', function($user) {
                    return view('pages.authentication.user._action-table', [
                        'id' => Crypt::encryptString($user->id),
                        'name' => $user->name ?? '',
                    ]);
                })->addColumn('direct_permissions', function($user) {
                    return $user->getDirectPermissions()->count();
                }) ->addColumn('permissions_via_roles', function($user) {
                    return $user->getPermissionsViaRoles()->count();
                })->addColumn('roles', function($user) {
                    return $user->getRoleNames()->implode(', ');
                })->addColumn('role_count', function($user) {
                    return $user->getRoleNames()->count();
                })
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error in getAllUser: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Error retrieving user data',
            ], 400);
        }
    }

    public function onDetailUser(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $user = $this->UserRepository->getUserById($id);
            if (!$user) {
                return response()->json([
                    'code' => 2000,
                    'message' => "User tidak ditemukan"
                ]);
            }
            $data = [
                'user' => $user,
            ];

            return response()->json([
                'code' => 1000,
                'content' => view('pages.authentication.user.edit', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in getAllUser: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Error retrieving user data',
            ], 400);
        }
    }

    public function updateUser(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'is_active'=> 'required|boolean',
        ], [
            'name.required' => "Nama harus harus dibuat",
            'is_active.required' => "Status User harus dipilih",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 2000,
                'message' => implode("<br />", $validator->errors()->all())
            ], 400);
        }

        try {
            $UserId = Crypt::decryptString($id);
            $data = $request->only(['name','is_active']);
            $updatedUser = $this->UserRepository->updateUser($data, $UserId);
            return response()->json([
                'code' => 1000,
                'message' => 'User berhasil diubah.',
                'data' => $updatedUser
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'ID User tidak valid.'
            ], 400);
        } catch (\Exception $e) {
            Log::error('Update User Error: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat mengubah data User.'
            ], 400);
        }
    }

    public function onDeleteUser(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $user = $this->UserRepository->deleteUser($id);
            if (!$user) {
                return response()->json([
                    'code' => 2000,
                    'message' => 'Mohon Maaf, User gagal dihapus'
                ]);
            }

            return response()->json([
                'code' => 1000,
                'message' => "User telah dihapus."
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error in getAllUser: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Error retrieving user data',
            ], 400);
        }
    }

    public function indexDetailUser(Request $request) {

        $data = [];
        $id = Crypt::decryptString($request->id);
        $user = $this->UserRepository->getUserById($id);
        $module = $this->ModuleRepository->getAllWithPermissions();
        $nisa =  $user->permissions;
       
        if (!$user) {
            return redirect()->route('central-role-page')->with('error', 'User tidak ditemukan.');
        }

        $data = [
            'user' => $user,
            'module' => $module,
            'AllRoles' => $user->permissions,
        ];
       
        return view('pages.authentication.user.detail')->with($data);
    }

    public function attachPermission(Request $request, $id ){
        $user = $this->UserRepository->getUserById($id);
        $permission = $this->PermissionRepository->findByName($request->permission);
        $user->givePermissionTo($permission);  
    }

    public function detachPermission(Request $request, $id){
        $user = $this->UserRepository->getUserById($id);
        $permission = $this->PermissionRepository->findByName($request->permission);
        $user->revokePermissionTo($permission);
    }

    // Attach Role

    public function onDetailUserRole(Request $request , $id){
        try {
            if (!$request->user()->can('add-permission-user')) {
                return view('auth-404');
            }
            $id = Crypt::decryptString($request->id);
            $user = $this->UserRepository->getUserById($id);
            $roles = $this->RoleRepository->getRoleIsActive();
            
            if (!$user) {
                return response()->json([
                    'code' => 2000,
                    'message' => "User tidak ditemukan"
                ]);
            }
            $data = [
                'user' => $user,
                'roles' => $roles,
            ];

            return response()->json([
                'code' => 1000,
                'content' => view('pages.authentication.user.role', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in getAllUser: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Error retrieving User data',
            ], 400);
        }
    }

    public function attachRole(Request $request, $id){
        $user = $this->UserRepository->getUserById($id);
        $role = $this->RoleRepository->findByName($request->role);
   
        $user->assignRole($role);  
        return response()->json(['success' => true]);
    }
    
    public function detachRole(Request $request, $id){
        $user = $this->UserRepository->getUserById($id);
        $role = $this->RoleRepository->findByName($request->role);
    
        $user->removeRole($role);

        return response()->json(['success' => true]);
    }

   
      
}
