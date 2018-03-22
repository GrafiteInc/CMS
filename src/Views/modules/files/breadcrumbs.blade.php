<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{!! url(config('cms.backend-route-prefix', 'cms').'/files') !!}">Files</a></li>
        @foreach($location as $local)
            <li class="breadcrumb-item">{!! ucfirst($local) !!}</li>
        @endforeach
        <li class="active"></li>
    </ol>
</nav>