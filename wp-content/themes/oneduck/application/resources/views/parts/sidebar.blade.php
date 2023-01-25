<div class="sidebar__menu js-sidebar__menu">
    
        
    <div class="sidebar_category_wrapper">    
     <h5 class="separate_sidebar_title">Категории</h5>   
    </div>
    <ul>
        @foreach($categories as $category)
            <li class="{{ $category->has_children ? 'nf__li js-sidebar__menu__li' : '' }}">
                <a href="{{ get_term_link($category) }}" class="arrow">
                    {{ $category->name }}
                </a>

                @if($category->has_children)
                    <span>{{ count($category->children) }}<i class="ic-arrow_right"></i></span>

                    <ul class="sidebar__menu__subMenu subMenu nf__subMenu js-subMenu">
                        <li class="nf__subMenu__back js-nf__subMenu__back">
                            <i></i>
                            <p>{{ $category->name }}</p>
                        </li>

                        @foreach($category->children as $child)
                            <li class="{{ $child->has_children ? 'nf__btnMenu-wrap js-nf__btnMenu-wrap' : '' }}">
                                <a href="{{ get_term_link($child) }}">
                                    {{ $child->name }}
                                </a>

                                @if($child->has_children)
                                    <span class="js-nf__btnMenu">{{ count($child->children) }}<i class=""></i></span>
                                    <ul class="nf__subMenu-Menu2">
                                        <li class="nf__subMenu__back js-nf__subMenu__back2">
                                            <i></i>
                                            <p>{{ $category->name }}</p>
                                        </li>

                                        @foreach($child->children as $child2)
                                            <li class="{{ $child->has_children ? 'nf__btnMenu-wrap2 js-nf__btnMenu-wrap' : '' }}">
                                                <a href="{{ get_term_link($child2) }}">{{ $child2->name }}</a>

                                                @if($child2->has_children)
                                                    <span class="js-nf__btnMenu">
                                                        {{ count($child2->children) }}<i></i>
                                                    </span>

                                                    <ul class="nf__subMenu-Menu3">
                                                        <li class="nf__subMenu__back js-nf__subMenu__back3"><i></i>
                                                            <p>{{ $category->name }}</p>
                                                        </li>

                                                        @foreach($child2->children as $child3)
                                                            <li>
                                                                <a href="{{ get_term_link($child3) }}">{{ $child3->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul><!-- /subMenu -->
                @endif
            </li>
        @endforeach
    </ul>
    
    
    <div class="sidebar_path_wrapper">
    <h5 class="separate_sidebar_title">Дерево</h5>
    <span>Скоро здесь будет путь<span>
    </div>   
    
    <div class="sidebar_filter_wrapper">
    <h5 class="separate_sidebar_title">Фильтр</h5>
    
    <!--<div class="main__filter__wrap js-main__filter__wrap main__filter__wrap_only_button">                
    <button class="js-filter_btn">
        <i></i><span>Свернуть фильтр</span>
        <span>Развернуть фильтр</span>
    </button>
    </div>-->
    
    @include('catalog.filter')
    </div>
        
    
</div>
