<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Элементы</title>
    @vite('resources/css/app.css')
</head>
<body>
<div class="container">
    <h1>Список элементов</h1>

    <div class="items-grid">
        @forelse ($items as $item)
            <div class="item-card">
                <h2>Элемент #{{ $item['id'] }}</h2>
                <p>{{ $item['about'] }}</p>
            </div>
        @empty
            <p class="no-items">Нет данных.</p>
        @endforelse
    </div>

    @if ($items->hasPages())
        <div class="pagination">
            {{ $items->links('vendor.pagination.custom') }}
        </div>
    @endif
</div>
</body>
</html>
