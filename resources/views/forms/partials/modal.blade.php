<div id="{{ $name }}" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog {{ $modal_size }} @if (!$modal_size) @if (strlen($content) < 120) modal-xs @elseif (strlen($content) > 1000) modal-lg @endif @endif">
        <div class="modal-content">
            <div class="modal-header bg-{{ $type }}">
                <h4 class="modal-title"><i class="til_img"></i><strong>{!! $title !!}</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>

            <div class="modal-body with-padding">
                {!! $content !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="float-start btn btn-{{ $type != 'warning' ? 'warning' : 'info' }}" data-dismiss="modal">{{ trans('tables.cancel') }}</button>
                <a class="float-end btn btn-{{ $type }}" id="{{ $action_id }}" href="#" data-action="{!! $action_route !!}">{!! $action_name !!}</a>
            </div>
        </div>
    </div>
</div>
<!-- end Modal -->
