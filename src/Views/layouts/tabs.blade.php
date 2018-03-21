@foreach(config('cms.languages') as $short => $language)
    <li class="nav-item">
        <a class="nav-link @if (request('lang') == $short || is_null(request('lang')) && $short == config('cms.default-language')) active @endif" href="{{ url(config('cms.backend-route-prefix', 'cms').'/'.$module.'/'.$page->id.'/edit?lang='.$short) }}">{{ ucfirst($language) }}</a>
    </li>
@endforeach
