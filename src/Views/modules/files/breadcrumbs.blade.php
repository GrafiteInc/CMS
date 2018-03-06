<div class="row">
    <ol class="breadcrumb">
        <li><a href="{!! url(config('cabin.backend-route-prefix', 'cabin').'/files') !!}">Files</a></li>

        @foreach($location as $local)

            <li>{!! ucfirst($local) !!}</li>

        @endforeach
        <li class="active"></li>
    </ol>
</div>