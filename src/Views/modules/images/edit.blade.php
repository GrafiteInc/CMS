@extends('cms::layouts.dashboard')

@section('pageTitle') Images @stop

@section('content')

    <div class="col-md-12 mt-2">
        @include('cms::modules.images.breadcrumbs', ['location' => ['edit']])
    </div>

    <div class="col-md-12 mt-2">
        <div class="row">
            <div class="col-md-6 col-md-offset-4">
                <img class="img-fluid img-thumbnail" src="{!! $images->url !!}" />
            </div>
            <div class="col-md-6">
                <h2 class="raw-margin-top-0 raw-margin-bottom-24">Blade Tags</h2>
<pre><br>&#64;image({{ $images->id }})
&#64;image_link({{ $images->id }})
@foreach(explode(',', $images->tags) as $key => $tag)
&#64;images({{ trim($tag) }})<br>
@endforeach
</pre>
                @if (!is_null($images->entity_id))
                    <h2 class="raw-margin-top-24 raw-margin-bottom-8">Linked Entity</h2>
                    <a href="{{ url(config('cms.backend-route-prefix', 'cms').'/'.$images->entity_type.'s/'.$images->entity_id.'/edit') }}">{{ ucfirst($images->entity_type) }}</a>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mt-4">
                {!! Form::model($images, ['route' => [config('cms.backend-route-prefix', 'cms').'.images.update', $images->id], 'method' => 'patch', 'files' => true, 'class' => 'edit']) !!}

                    {!! FormMaker::setColumns(2)->fromObject($images, Config::get('cms.forms.images-edit')) !!}

                    <div class="form-group text-right">
                        <a href="{!! url(config('cms.backend-route-prefix', 'cms').'/images') !!}" class="btn btn-secondary float-left">Cancel</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
