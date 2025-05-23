<?php

namespace App\Http\Controllers\Central\Authentication;

use App\Http\Controllers\Controller;
use App\Repositories\Module\ModuleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    private $ModuleRepository;

    public function __construct(ModuleRepository $ModuleRepository)
    {
        $this->ModuleRepository = $ModuleRepository;
    }
    public function index(Request $request)
    {
        $data = [];
        $data['total_module'] = $this->ModuleRepository->countTotalModule();
        $data['total_active_module'] = $this->ModuleRepository->countTotalModuleByStatus(1);
        $data['total_inactive_module'] = $this->ModuleRepository->countTotalModuleByStatus(0);
        
        return view('pages.authentication.module.index')->with($data);
    }

    public function getAllModule(Request $request){
        try {
            $filters = [
                'search' => $request->input('search.value'),
    
            ];

            $query = $this->ModuleRepository->getAll($filters);
            return DataTables::of($query)
                ->addColumn('permission_count', function($module) {
                    return $module->permissions->count();
                })
                ->addColumn('option', function($module) {
                    return view('pages.authentication.module._action-table', [
                        'id' => Crypt::encryptString($module->id),
                        'name' => $module->name ?? '',
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

    public function onDetailModule(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $module = $this->ModuleRepository->getModuleById($id);
    
            if (!$module) {
                return response()->json([
                    'code' => 2000,
                    'message' => "Sistem Module tidak ditemukan"
                ]);
            }
            $data = [
                'module' => $module,
            ];

            return response()->json([
                'code' => 1000,
                'content' => view('pages.authentication.module.edit', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in get Module : ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Mohon maaf, terjadi kesalahan saat mengambil data',
            ], 400);
        }
    }

    public function onShowModule(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $module = $this->ModuleRepository->getModuleById($id);
    
            if (!$module) {
                return response()->json([
                    'code' => 2000,
                    'message' => "Sistem Module tidak ditemukan"
                ]);
            }
            $data = [
                'module' => $module,
                'permissions' => $module->permissions,
                'permission_count' => $module->permissions->count(),
            ];

    
            return response()->json([
                'code' => 1000,
                'content' => view('pages.authentication.module.show', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in get Module : ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Mohon maaf, terjadi kesalahan saat mengambil data',
            ], 400);
        }
    }

    public function onEditModule(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'core' => 'required',
            'is_active' => 'required'
        ], [
            'name.required' => "Nama Modul harus dibuat",
            'description.required' => "Deskripsi Modul harus dibuat",
            'core.required' => "Core Modul harus dibuat",
            'is_active.required' => "Status Modul harus dibuat",
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
            $module_id = Crypt::decryptString($id);
            $data = $request->except('_token');
            $updatedModule = $this->ModuleRepository->updateModule($data, $module_id);
            return response()->json([
                'code' => 1000,
                'message' => "Modul telah diubah.",
                'data' => $updatedModule
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "code" => 2000,
                "message" => "Terjadi kesalahan saat mengubah data modul",
            ], 400);
        }
    }
}
