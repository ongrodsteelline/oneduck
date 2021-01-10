<ul>
    @foreach($children as $child)
        <li>
            <a href="{{ get_term_link($child) }}">
                {{ $child->name }}
            </a>
            @if($child->has_children)
                @include('parts.sidebar.submenu.ul', ['children' => $child->children])
            @endif
        </li>
    @endforeach
</ul>