@if($pagination)
    <ul class="pagination"><span>Страница:</span>
        @foreach($pagination as $page)
            <li class="page-item pagination__item {{ ($page['isCurrent']) ? 'active' : null }}">
                <a class="page-link pagination__link" href="{{ $page['url'] }}">{{ $page['num'] }}</a>
            </li>
        @endforeach
    </ul>
@endif