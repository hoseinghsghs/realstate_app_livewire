@if ($paginator->hasPages())
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <ul class="pagination p-center">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="قبلی">
                            <span class="ti-arrow-right"></span>
                            <span class="sr-only">قبلی</span>
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" wire:navigate aria-label="قبلی">
                            <span class="ti-arrow-right"></span>
                            <span class="sr-only">قبلی</span>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item"><a class="page-link" href="#">{{ $element }}</span></a>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}"
                                        wire:navigate>{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" wire:navigate aria-label="بعدی">
                            <span class="ti-arrow-left"></span>
                            <span class="sr-only">بعدی</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="بعدی">
                            <span class="ti-arrow-left"></span>
                            <span class="sr-only">بعدی</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
@endif
