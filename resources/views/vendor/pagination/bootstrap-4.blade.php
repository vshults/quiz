@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a href="{{ $paginator->previousPageUrl() }}"><button type="button" class="btn btn-default btn-sm prev">
                        <i class="fas fa-chevron-left"></i>
                    </button></a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"><button type="button" class="btn btn-default btn-sm prev">
                    <i class="fas fa-chevron-left"></i>
                </button></a>
            @endif

            {{-- Pagination Elements --}}

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"><button type="button" class="btn btn-default btn-sm next">
                    <i class="fas fa-chevron-right"></i>
                </button></a>
            @else
                <a href="{{ $paginator->nextPageUrl() }}"><button type="button" class="btn btn-default btn-sm next">
                        <i class="fas fa-chevron-right"></i>
                    </button></a>
            @endif
        </ul>
    </nav>
@endif
