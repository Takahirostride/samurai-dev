@if ($paginator->hasPages())
<div class="pagination">    
    <ul class="pagination-sm  pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item  page-prev disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a href="#" onclick="return false;">最初</a>
            </li>
        @else
            <li class="page-item page-prev">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">最初</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><a href="#" onclick="return false;">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><a href="#" onclick="return false;">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item page-next">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">最後</a>
            </li>
        @else
            <li class="page-item page-next disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="#" onclick="return false;">最後</a>
            </li>
        @endif
    </ul>
</div>    
@endif
