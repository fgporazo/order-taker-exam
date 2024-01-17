@props(['id','maxWidth','fullWidth'])

@php
$id = $id ?? md5($attributes->wire('model'));
$fullWidth = $fullWidth ?? "false";
$maxWidth = [
    'sm' => 'modal-sm',
    'md' => 'modal-md',
    'lg' => 'modal-lg',
    'xl' => 'modal-xl',
][$maxWidth ?? 'xl'];

$fullWidth = $fullWidth === "true" ? true : false;
@endphp

<div wire:ignore.self class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}" aria-hidden="true">
    <div class="modal-dialog {{ $maxWidth }}" role="document" @if($fullWidth) style="max-width: 100%" @endif>
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$title}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{$slot}}
            </div>
            <div class="modal-footer justify-content-between">
                {{$save}}
            </div>
        </div>

    </div>
</div>