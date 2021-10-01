@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <span href="" class="btn btn-danger">Prev</span>
                {{-- <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">@lang('pagination.previous')</span>
                </li> --}}
            @else
            <a href="{{ $paginator->previousPageUrl() }}" class="btn btn-success">Prev</a>
                {{-- <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
                </li> --}}
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())

            <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-info">Next</a>
                {{-- <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
                </li> --}}
            @else
            <span class="btn btn-warning disabled">next</span>
                {{-- <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">@lang('pagination.next')</span>
                </li> --}}
            @endif
        </ul>
    </nav>
@endif
