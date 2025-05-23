<?php

namespace App\Http\Controllers\Central\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Region\RegionRepository;
// Model
use App\Models\Region;


class RegionsController extends Controller
{
    private $RegionRepository;

    public function __construct(
        RegionRepository $RegionRepository,
    ){
        $this->RegionRepository = $RegionRepository;
    }

    public function index(Request $request){
        
        if (!$request->user()->can('manage-region')) {
            return view('auth-404');
        }

        $data= [];
        
        $data['totalRegion'] = $this->RegionRepository->countTotalRegion();
        $data['totalActiveRegion'] = $this->RegionRepository->countTotalRegionByStatus(1);
        $data['totalInactiveRegion'] = $this->RegionRepository->countTotalRegionByStatus(0);
        
        return view('pages.master.region.index')->with($data);
    }

    public function getAllRegion(Request $request){
        try {
            $model= Region::latest();
            return  Datatables::of($model)->filter(function($query) use($request) {
                if ($request->has('search.value') && strlen($request->input('search.value')) > 0) {
                    $query->where('regions.name', 'LIKE', '%'.$request->input('search.value').'%');
                }
            })->addColumn('option', function($query) {
                return view('pages.master.region._action-table', [
                    'id'=> Crypt::encryptString(($query->id)),
                    'name' => $query->name ?? '',
                ]);
            })->make(true);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    public function addRegion(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'region_code' => 'required',
            'is_active' => 'required'
        ], [
            'name.required' => "Nama Wilayah harus diisi",
            'region_code.required' => "Kode Wilayah harus diisi",
            'is_active.required' => "Status Aktif harus ditentukan",

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
            $this->RegionRepository->createRegion($data);
            return response()->json([
                "code" => 1000,
                "message" => "Wilayah baru berhasil dibuat.",
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "code" => 2000,
                "message" => "Mohon maaf, terjadi kesalahan saat menambahkan Wilayah."
            ], 400);
        }
    }

    public function onDetailRegion(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $region = $this->RegionRepository->getRegionById($id);

            if (!$region) {
                return response()->json([
                    'code' => 2000,
                    'message' => "Sistem Wilayah tidak ditemukan"
                ]);
            }
            $data = [
                'region' => $region
            ];

            return response()->json([
                'code' => 1000,
                'content' => view('pages.master.region.edit', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in get Wilayah : ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function updateRegion(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'region_code' => 'required',
            'is_active' => 'required'
        ], [
            'name.required' => "Nama Wilayah harus diisi",
            'region_code.required' => "Kode Wilayah harus diisi",
            'is_active.required' => "Status Aktif harus ditentukan",
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 2000,
                'message' => implode("<br />", $validator->errors()->all())
            ], 400);
        }

        try {
            $id = Crypt::decryptString($id);
            $data = $request->except('_token');
            $updatedRegion = $this->RegionRepository->updateRegion($data, $id);
            return response()->json([
                'code' => 1000,
                'message' => 'Wilayah berhasil diubah.',
                'data' => $updatedRegion
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'ID Wilayah tidak valid.'
            ], 400);
        } catch (\Exception $e) {
            Log::error('Update Wilayah Error: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function onDeleteRegion(Request $request, $id) {
        try {
            $model_id = Crypt::decryptString($id);
            $deleted = $this->RegionRepository->deleteRegion($model_id);
            if (!$deleted) {
                return response()->json([
                    'code' => 2000,
                    'message' => 'Mohon Maaf, Wilayah gagal dihapus'
                ]);
            }

            return response()->json([
                'code' => 1000,
                'message' => 'Wilayah telah dihapus.'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'Wilayah tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([ 
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat menghapus Wilayah.'
            ], 400);
        }
    }

}

