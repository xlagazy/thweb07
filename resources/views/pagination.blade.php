@if ($paginator->hasPages())

<ul class="pagination">
    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">FirstPage</a></li>
    @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->onFirstPage()) }}">FirstPage</a></li>
    @endif

    @if ($paginator->onFirstPage())
        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>
    @else
        <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Previous</a></li>
    @endif

    <!-- @foreach ($elements as $element)

        @if (is_string($element))
            <li class="page-item disabled">{{ $element }}</li>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <li class="page-item active"><a class="page-link">{{ $page }}</a></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif

    @endforeach -->

    <?php
        $start = $paginator->currentPage() - 2; // show 3 pagination links before current
        $end = $paginator->currentPage() + 2; // show 3 pagination links after current
        if($start < 1) {
            $start = 1; // reset start to 1
            $end += 1;
        } 
        if($end >= $paginator->lastPage() ) $end = $paginator->lastPage(); // reset end to last page
    ?>

    @if($start > 1)
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url(1) }}">{{1}}</a>
        </li>
        @if($paginator->currentPage() != 4)
            {{-- "Three Dots" Separator --}}
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
        @endif
    @endif
        @for ($i = $start; $i <= $end; $i++)
            <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{$i}}</a>
            </li>
        @endfor
    @if($end < $paginator->lastPage())
        @if($paginator->currentPage() + 3 != $paginator->lastPage())
            {{-- "Three Dots" Separator --}}
            <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
        @endif
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">{{$paginator->lastPage()}}</a>
        </li>
    @endif

    @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a></li>
    @else
        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Next</a></li>
    @endif

    @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">LastPage</a></li>
    @else
        <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">LastPage</a></li>
    @endif

</ul>

@endif