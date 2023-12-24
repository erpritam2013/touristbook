@if ($paginator->hasPages())
    <nav aria-label="Page navigation">

        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if (!$paginator->onFirstPage())
                <li class="page-item">
                    <a class="page-link" href="javascript::void(0)" rel="prev"
                        aria-label="@lang('pagination.previous')" pageid="{{$paginator->currentPage()-1}}">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true">
                        <a class="page-link" href="javascript::void(0)" pageid="{{$element}}">{{ $element }}</a>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="javascript::void(0)" pageid="{{$page}}">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="javascript:void(0)" pageid="{{$page}}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0)" rel="next"
                        aria-label="@lang('pagination.next')" pageid="{{$paginator->currentPage()+1}}">&rsaquo;</a>
                </li>
            @else

            @endif
        </ul>

    </nav>
@endif
