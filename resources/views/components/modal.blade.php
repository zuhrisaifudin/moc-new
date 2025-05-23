<div class="modal fade" @if ($backdrop == 'true') data-bs-backdrop="static" data-bs-keyboard="false" @endif id="modal-{{ $id }}" tabindex="-1" role="dialog"
     aria-hidden="true">
    <div class="modal-dialog {{ $size }} modal-dialog-centered {{ $scrollable }}">
        <div class="modal-content">
            <div class="modal-header bg-soft-info py-3">
                <h5 class="modal-title">{{ strtoupper($title) }}</h5>
                @if ($isShowCloseButton == 'true')
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                @endif
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>