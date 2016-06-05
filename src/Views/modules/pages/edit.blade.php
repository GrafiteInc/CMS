@extends('quarx::layouts.dashboard')

@section('content')

        <div class="row">
            @if ($page->is_published)
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('page/'.$page->url) !!}">Live</a>
            @else
            <a class="btn btn-default pull-right raw-margin-left-8" href="{!! URL::to('quarx/preview/page/'.$page->id) !!}">Preview</a>
            @endif
            <a class="btn btn-warning pull-right raw-margin-left-8" href="{!! URL::to('quarx/rollback/page/'.$page->id) !!}">Rollback</a>
            <h1 class="page-header">Pages</h1>
        </div>

        @include('quarx::modules.pages.breadcrumbs', ['location' => ['edit']])

        {!! Form::model($page, ['route' => ['quarx.pages.update', $page->id], 'method' => 'patch', 'class' => 'edit']) !!}

            <div class="form-group">
                <label for="Template">Template</label>
                <select class="form-control" id="Template" name="template">
                    @foreach (PageService::getTemplatesAsOptions() as $template)
                        <option @if($template === $page->template) selected  @endif value="{!! $template !!}">{!! ucfirst(str_replace('-template', '', $template)) !!}</option>
                    @endforeach
                </select>
            </div>

            {!! FormMaker::fromObject($page, Config::get('quarx.forms.page')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::to('quarx/pages') !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>
@endsection
