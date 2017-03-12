<?php
    // http://stackoverflow.com/questions/28240777/custom-pagination-view-in-laravel-5
    // xABE Todo : prefere presenter for next revision
?>
@if ($paginator->lastPage() > 1)
    <ul class="pagination pagination-sm no-margin pull-right">
        @if ($paginator->currentPage() != 1)
        <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url(1) }}">{{ trans('pagination.previous') }}</a>
        </li>
        @endif
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor
        @if ($paginator->currentPage() != $paginator->lastPage())
        <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url($paginator->currentPage()+1) }}" >{{ trans('pagination.next') }}</a>
        </li>
        @endif
    </ul>
@endif