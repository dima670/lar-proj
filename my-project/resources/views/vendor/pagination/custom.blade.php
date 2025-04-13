@php
    $visiblePages = env('PAGINATION_VISIBLE_PAGES', 3);
    $startPage = max(1, $paginator->currentPage() - floor($visiblePages / 2));
    $endPage = min($paginator->lastPage(), $startPage + $visiblePages - 1);
    $startPage = max(1, $endPage - $visiblePages + 1);
@endphp

@if ($paginator->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination-list">
            <li class="pagination-item">
                @if ($paginator->onFirstPage())
                    <span class="disabled">« Начало</span>
                @else
                    <a href="{{ $paginator->url(1) }}">« Начало</a>
                @endif
            </li>

            @for ($i = $startPage; $i <= $endPage; $i++)
                <li class="pagination-item {{ $paginator->currentPage() == $i ? 'active' : '' }}">
                    <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            <li class="pagination-item">
                @if ($paginator->currentPage() == $paginator->lastPage())
                    <span class="disabled">Конец »</span>
                @else
                    <a href="{{ $paginator->url($paginator->lastPage()) }}">Конец »</a>
                @endif
            </li>
        </ul>
    </nav>
@endif
