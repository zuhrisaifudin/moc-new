<?php

namespace App\Http\Controllers\Central\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Repositories\District\DistrictRepository;
use App\Repositories\Region\RegionRepository;
// Model
use App\Models\District;
class DistrictController extends Controller
{
    private $DistrictRepository;
    private $RegionRepository;

    public function __construct(
        DistrictRepository $DistrictRepository,
        RegionRepository $RegionRepository,
    ){
        $this->DistrictRepository = $DistrictRepository;
        $this->RegionRepository = $RegionRepository;
    }

    public function index(Request $request){
        
        if (!$request->user()->can('manage-district')) {
            return view('auth-404');
        }

        $data= [];
        
        $data['totalDistrict'] = $this->DistrictRepository->countTotalDistrict();
        $data['totalActiveDistrict'] = $this->DistrictRepository->countTotalDistrictByStatus(1);
        $data['totalInactiveDistrict'] = $this->DistrictRepository->countTotalDistrictByStatus(0);
        $data['regions'] = $this->RegionRepository->pluckNameWithId();
        
        return view('pages.master.district.index')->with($data);
    }

    public function getAllDistrict(Request $request){
        try {
            $model= District::latest();
            return  Datatables::of($model)->filter(function($query) use($request) {
                if ($request->has('search.value') && strlen($request->input('search.value')) > 0) {
                    $query->where('districts.name', 'LIKE', '%'.$request->input('search.value').'%');
                }
            })->addColumn('option', function($query) {
                return view('pages.master.district._action-table', [
                    'id'=> Crypt::encryptString(($query->id)),
                    'name' => $query->name ?? '',
                ]);
            })->addColumn('region', function($query) {
                return $query->region->name ?? '';
            })->make(true);
        }catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    public function addDistrict(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'district_code' => 'required',
            'is_active' => 'required'
        ], [
            'name.required' => "Nama Area harus diisi",
            'district_code.required' => "Kode Area harus diisi",
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
            $this->DistrictRepository->createDistrict($data);
            return response()->json([
                "code" => 1000,
                "message" => "Area baru berhasil dibuat.",
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "code" => 2000,
                "message" => "Mohon maaf, terjadi kesalahan saat menambahkan Area."
            ], 400);
        }
    }

    public function onDetailDistrict(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $district = $this->DistrictRepository->getDistrictById($id);

            if (!$district) {
                return response()->json([
                    'code' => 2000,
                    'message' => "Sistem Area tidak ditemukan"
                ]);
            }
            $data = [
                'district' => $district,
                'regions' => $this->RegionRepository->pluckNameWithId()
            ];

            return response()->json([
                'code' => 1000,
                'content' => view('pages.master.district.edit', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in get Area : ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function updateDistrict(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'district_code' => 'required',
            'is_active' => 'required'
        ], [
            'name.required' => "Nama Area harus diisi",
            'district_code.required' => "Kode Area harus diisi",
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
            $updatedDistrict = $this->DistrictRepository->updateDistrict($data, $id);
            return response()->json([
                'code' => 1000,
                'message' => 'Area berhasil diubah.',
                'data' => $updatedDistrict
            ]);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'ID Area tidak valid.'
            ], 400);
        } catch (\Exception $e) {
            Log::error('Update Area Error: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function onDeleteDistrict(Request $request, $id) {
        try {
            $model_id = Crypt::decryptString($id);
            $deleted = $this->DistrictRepository->deleteDistrict($model_id);
            if (!$deleted) {
                return response()->json([
                    'code' => 2000,
                    'message' => 'Mohon Maaf, Area gagal dihapus'
                ]);
            }

            return response()->json([
                'code' => 1000,
                'message' => 'Area telah dihapus.'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'Area tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([ 
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat menghapus Area.'
            ], 400);
        }
    }

}