<div class="hstack gap-2">
    @php
        $disabled = in_array($status, [2, 3, 4]);
    @endphp
    @can('show-moc')
        <a href="{{ route('central-moc-request-edit-pages', $id) }}" class="btn btn-sm btn-subtle-info edit-list" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat {{ $moc_title }}">
            <i class="ph-eye"></i>
        </a>  
    @endcan
    @can('edit-moc')
        <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-info edit-list" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit {{ $moc_title }}">
            <i class="ri-pencil-fill align-bottom"></i>
        </button>
    @endcan
    @can('id-asset-moc')
        <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-primary maps-digio"  data-bs-toggle="tooltip" data-bs-placement="top" title="Masukan ID Tag Asset  {{ $moc_title }}">
            <i class=" ri-global-line align-bottom"></i>
        </button>
    @endcan
    @can('approved-moc-request-fuction')
        @if ($status == 2)
            <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-secondary approved-moc-request-fuction" data-bs-toggle="tooltip" data-bs-placement="top" title="Approved Permohonan Ini Fungsi Pengusul">
                <i class="ri-character-recognition-line align-bottom"></i>
            </button>
        @endif
    @endcan
    @can('send-moc')
       @if($status == 1)
            <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-secondary send-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Kirim Permohonan Ke Fungsi Pengusul ">
                <i class="ri-send-plane-fill align-bottom"></i> 
            </button>
        @endif
    @endcan
   
    @can('delete-moc')
        @if (!$disabled) 
        <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-danger delete-item"  data-bs-toggle="tooltip" data-bs-placement="top" title=" Hapus {{ $moc_title }}" >
            <i class="ri-delete-bin-5-fill align-bottom"></i>
        </button>
        @endif
    @endcan
    
</div>


   