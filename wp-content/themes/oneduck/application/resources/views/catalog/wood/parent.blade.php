<a href="{{ get_term_link($child) }}">{{ $child->name }}</a>

<ul>
    @foreach($child->children as $child2)
        @if(count($child2->children) && $child2->active)
            @include('catalog.wood.children', ['child' => $child2])
        @else
            <li class="{{ $child2->active ? 'active' : '' }}">
                <a href="{{ get_term_link($child2) }}">
                    {{ $child2->name }}
                </a>
            </li>
        @endif
    @endforeach
</ul>
