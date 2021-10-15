@if ($paginator->hasPages())
    <nav>
        <ul class="pagination pagination-gutter">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled page-item page-indicator" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a class="page-link" href="javascript:void()"><i class="icon-arrow-left"></i></a>
                </li>
            @else
                <li class="page-item page-indicator">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="icon-arrow-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled page-item" aria-disabled="true"><a class="page-link" href="javascript:void()">{{ $element }}</a></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><a class="page-link" href="javascript:void()">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item page-indicator">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="icon-arrow-right"></i></a>
                </li>
            @else
                <li class="disabled page-item page-indicator" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a class="page-link" href="javascript:void()"><i class="icon-arrow-right"></i></a>
                </li>
            @endif
        </ul>
    </nav>
@endif
