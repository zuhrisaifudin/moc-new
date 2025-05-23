<?php

namespace App\Http\Controllers\Central\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Repositories\MocRequest\MocRequestRepository;
use App\Repositories\Region\RegionRepository;
use Illuminate\Http\RedirectResponse;
use App\Models\MocRequest;
use App\Models\District;
use App\Models\Region;

class MocRequestController extends Controller
{
    private $MocRequestRepository;
    private $RegionRepository;

    public function __construct(
        MocRequestRepository $MocRequestRepository,
        RegionRepository $RegionRepository
    ){
        $this->MocRequestRepository = $MocRequestRepository;
        $this->RegionRepository = $RegionRepository;
    }

    public function index(Request $request)
    {
        $data = [];
        $data['total_moc_requests'] = $this->MocRequestRepository->countTotalMocRequest();
 
        return view('pages.moc-request.index')->with($data);
    }

    public function getAllMocRequest(Request $request)
    {
        try {
            $filters = [
                'search' => $request->input('search.value'),
                'is_temporary' => $request->get('is_temporary', 'all')
            ];

            $query = $this->MocRequestRepository->getAll($filters);
            return DataTables::of($query)
                ->addColumn('option', function($mocRequest) {
                    return view('pages.moc-request._action-table', [
                        'id' => Crypt::encryptString($mocRequest->id),
                        'moc_title' => $mocRequest->moc_title ?? '',
                    ]);
                })
                ->make(true);
        } catch (\Exception $e) {
            Log::error('Error in getAllMocRequest: ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Error retrieving MOC Request data',
            ], 400);
        }
    }

    public function create(Request $request)
    {
        $data = [];
        $data['reference'] = MocRequest::generateReference();
        $data['regions'] = $this->RegionRepository->pluckNameWithId();

        return view('pages.moc-request.create')->with($data);
    }

    public function byRegion($regionId){
        $districts = District::where('region_id', $regionId)
            ->where('is_active', 1)
            ->get(['id', 'name']);

        return response()->json($districts);
    }

    public function addMocRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'moc_title' => 'required',
            'date' => 'required',
            'region_id' => 'required',
            'district_id' => 'required',
            'risk_level' => 'required',
            'type_of_change' => 'required',
            'reference_document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:20480', // 20MB
            'risk_level_document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:20480', // 20MB
        ], [
            'moc_title.required' => "Judul Permohonan harus diisi",
            'date.required' => "Tanggal harus di pilih",
            'region_id.required' => "Wilayah harus di pilih",
            'district_id.required' => "Area harus di pilih",
            'risk_level.required' => "Tingkat Risiko harus di pilih",
            'type_of_change.required' => "Jenis Perubahan harus di pilih",
            'reference_document.file' => "Dokumen Referensi harus berupa file yang valid",
            'reference_document.mimes' => "Format Dokumen Referensi didukung (pdf, doc, docx, xls, xlsx, jpg, jpeg, png)",
            'reference_document.max' => "Ukuran Dokumen Referensi maksimal 20MB",

            'risk_level_document.file' => "Dokumen Tingkat Risiko harus berupa file yang valid",
            'risk_level_document.mimes' => "Format Dokumen Tingkat Risiko didukung (pdf, doc, docx, xls, xlsx, jpg, jpeg, png)",
            'risk_level_document.max' => "Ukuran Dokumen Tingkat Risiko maksimal 20MB",

        ]);


        if ($validator->fails()) {
            return response()->json([
                "code" => 2000,
                "message" => implode("<br />", $validator->errors()->all())
            ], 422);
        }

        try {
            $data = $request->except("_token", "reference_document","risk_level_document");
    
            if ($request->hasFile('reference_document')) {
                $file = $request->file('reference_document');
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('uploads/moc/reference', $filename, 'public');
                $data['reference_document'] = 'storage/' . $path;
            }

            if ($request->hasFile('risk_level_document')) {
                $file = $request->file('risk_level_document');
                $filename = $file->getClientOriginalName();
                $path = $file->storeAs('uploads/moc/risklevel', $filename, 'public');
                $data['risk_level_document'] = 'storage/' . $path;
            }

            $region = Region::find($request->region_id)->region_code ?? 'OMM';
            $reference = MocRequest::generateReference($region);

            $data['type_of_change'] = $request->type_of_change; 
            $data['moc_number'] = $reference;

            $this->MocRequestRepository->createMocRequest($data);
            return response()->json([
                "code" => 1000,
                "message" => "Permohonan baru berhasil dibuat.",
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                "code" => 2000,
                "message" => $e->getMessage()
            ], 400);
        }
    }

    public function getById($id)
    {
        $data['mocRequest'] = $this->MocRequestRepository->getMocRequestById($id);

        return view('pages.moc-request.show')->with($data);
    }

    public function onDetailMapsMocRequest(Request $request , $id){
        try {
            $id = Crypt::decryptString($request->id);
            $moc = $this->MocRequestRepository->getMocRequestById($id);
           
         
            if (!$moc) {
                return response()->json([
                    'code' => 2000,
                    'message' => "Permohonan tidak ditemukan"
                ]);
            }
            $data = [
                'moc' => $moc,
            ];

            return response()->json([
                'code' => 1000,
                'content' => view('pages.moc-request.detail-maps', $data)->render()
            ]);

        } catch (\Exception $e) {
            Log::error('Error in get criteria : ' . $e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => $e->getMessage(),
            ], 400);
        }
    }


    public function onDeleteMocRequest(Request $request, $id) {
        try {
            $moc_id = Crypt::decryptString($id);
            $moc = $this->MocRequestRepository->find($moc_id); 
            // Cek dan hapus file jika ada cuy 
            if ($moc && $moc->reference_document) {
                $filePath = str_replace('storage/', '', $moc->reference_document); 
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
            if ($moc && $moc->risk_level_document) {
                $filePath = str_replace('storage/', '', $moc->risk_level_document); 
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }
            $deleted = $this->MocRequestRepository->deleteMocRequest($moc_id);
            if (!$deleted) {
                return response()->json([
                    'code' => 2000,
                    'message' => 'Mohon Maaf, Permohonan gagal dihapus'
                ]);
            }

            return response()->json([
                'code' => 1000,
                'message' => 'Permohonan telah dihapus.'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 2000,
                'message' => 'Permohonan tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'code' => 2000,
                'message' => 'Terjadi kesalahan saat menghapus TahPermohonanapan.'
            ], 400);
        }
    }


    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'moc_title' => 'required',
            'date' => 'required',
            'region_id' => 'required',
            'district_id' => 'required',
            'risk_level' => 'required',
            'type_of_change' => 'required',
            'reference_document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:20480', // 20MB
            'risk_level_document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png|max:20480', // 20MB
        ],
        [
            'moc_title.required' => "Judul Permohonan harus diisi",
            'date.required' => "Tanggal harus di pilih",
            'region_id.required' => "Wilayah harus di pilih",
            'district_id.required' => "Area harus di pilih",
            'risk_level.required' => "Tingkat Risiko harus di pilih",
            'type_of_change.required' => "Jenis Perubahan harus di pilih",
            'reference_document.file' => "Dokumen Referensi harus berupa file yang valid",
            'reference_document.mimes' => "Format Dokumen Referensi didukung (pdf, doc, docx, xls, xlsx, jpg, jpeg, png)",
            'reference_document.max' => "Ukuran Dokumen Referensi maksimal 20MB",

            'risk_level_document.file' => "Dokumen Tingkat Risiko harus berupa file yang valid",
            'risk_level_document.mimes' => "Format Dokumen Tingkat Risiko didukung (pdf, doc, docx, xls, xlsx, jpg, jpeg, png)",
            'risk_level_document.max' => "Ukuran Dokumen Tingkat Risiko maksimal 20MB",

        ]);

        //upload image
    
        $file = $request->file('reference_document');
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('uploads/moc/reference', $filename, 'public');
        $reference_document = 'storage/' . $path;


        $file = $request->file('risk_level_document');
        $filename = $file->getClientOriginalName();
        $path = $file->storeAs('uploads/moc/risklevel', $filename, 'public');
        $risk_level_document = 'storage/' . $path;

        //create product
        MocRequest::create([
            'date'         => $request->date,
            'moc_title'    => $request->moc_title,
            'risk_level'   => $request->risk_level,
            'type_of_change' => $request->type_of_change,
            'region_id'    => $request->region_id,
            'district_id'  => $request->district_id,
            'change_reason' => $request->change_reason,
            'changed_parts' => $request->changed_parts,
            'changed_to' => $request->changed_to,
            
            'reference_document' => $reference_document,
            'risk_level_document' => $risk_level_document
         
        ]);

        //redirect to index
        return redirect()->route('central-moc-request-index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

}
