<div class="sidebar__menu js-sidebar__menu">
    <ul>
        @foreach($categories as $category)
            <li data-menu="menu_{{ $category->term_id }}" class="js-sidebar__menu__li">
                <a href="{{ get_term_link($category) }}" class="arrow">
                    {{ $category->name }}
                    @if($category->has_children)
                        <i class="ic-arrow_right"></i>
                    @endif
                </a>

                @if(count($category->children) > 0)
                    <span class="js-sidebar__menu__count">{{ count($category->children) }}</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
