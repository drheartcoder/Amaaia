@if ($paginator->hasPages())
<div class="paginations space-top-bottm">
    <ul>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())

            <li class="previous-class disabled"><a href="javascript:void(0)"><i class="fa fa-angle-left"></i> Previous</a></li>
        @else
            {{-- <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li> --}}
            <li class="previous-class"><a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i> Previous</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><a href="javascript:void(0)">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a href="javascript:void(0)" class="active">{{ $page }}</a></li>
                        @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                        
                    {{-- @elseif($page == ($paginator->currentPage()+1) | $page == ($paginator->currentPage()-1)| $page=='1' | $page==$paginator->lastPage())
                        @else
                        . --}}
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="next-class"><a href="{{ $paginator->nextPageUrl() }}">Next <i class="fa fa-angle-right"></i></a></li>
        @else
            <li class="next-class disabled"><a href="javascript:void(0)">Next <i class="fa fa-angle-right"></i></a></li>
        @endif
    </ul>
    </div>
@endif