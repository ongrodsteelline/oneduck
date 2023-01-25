<ul class="sidebar__menu__subMenu subMenu js-subMenu" data-menu="{{ $target }}">
    @if($flash->enabled)
        <li class="subMenu__akzii">
            <a href="{{ $flash->link }}">
                <img src="{{ asset('static/img/sidebar/subMenu/fire.png') }}" alt="">
                <span>{!! $flash->text !!}</span>
            </a>
        </li>
    @endif
    @foreach($children as $category)
        <li class="subMenu__title">
            <a href="{{ get_term_link($category) }}">{{ $category->name }}</a>
            @if(count($category->children) > 0)
                <span class="subMenu__count">{{ count($category->children) }}</span>
            @endif
        </li>
        @foreach($category->children as $child)
            <li>
                <a href="{{ get_term_link($child) }}">
                    {{ $child->name }}
                    @if($child->has_children)
                        <i class="ic-arrow_right_subMenu js-btn__arrow"></i>
                    @endif
                </a>
                @include('parts.sidebar.submenu.ul', ['children' => $child->children])
            </li>
        @endforeach
    @endforeach
</ul>
