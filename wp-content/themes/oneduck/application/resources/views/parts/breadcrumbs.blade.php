<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($breadcrumbs as $item)
            <li class="breadcrumb-item breadcrumb__item {{ $item['active'] ? 'active' : null }}">
                @if($item['active'])
                    <span>{{ $item['name'] }}</span>
                @else
                    <a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>