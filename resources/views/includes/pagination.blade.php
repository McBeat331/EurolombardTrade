@if ($paginator->hasPages())
  <nav>
    <ul class="pagination">
      @if ($paginator->onFirstPage())
        <li class=button-prev disabled><span class="icon-arrow-l-primaryColor"></span></li>
      @else
        <li class=button-prev><a href="{{ $paginator->previousPageUrl() }}" rel="nofollow" aria-label="@lang('pagination.previous')" class="icon-arrow-l-primaryColor"></a></li>
      @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
          {{-- "Three Dots" Separator --}}
          @if (is_string($element))
            <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
          @endif

          {{-- Array Of Links --}}
          @if (is_array($element))
            @foreach ($element as $page => $url)
              @if ($page == $paginator->currentPage())
                <li class="page-item active" aria-current="page"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
              @else
                <li class="page-item"><a href="{{ $url }}" rel="nofollow">{{ $page }}</a></li>
              @endif
            @endforeach
          @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <li class="button-next"><a href="{{ $paginator->nextPageUrl() }}" rel="nofollow" aria-label="@lang('pagination.next')" class="icon-arrow-r-pimaryColor"></a></li>

        @else

          <li class="button-next" disabled><span class="icon-arrow-r-pimaryColor"></span></li>
        @endif

    </ul>
  </nav>

@endif