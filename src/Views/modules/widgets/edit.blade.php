@extends('cms::layouts.dashboard')

@section('pageTitle') Widgets @stop

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 mt-2">
                @include('cms::modules.widgets.breadcrumbs', ['location' => ['edit']])
            </div>
            <div class="col-md-6">
                 <div class="btn-toolbar float-right mt-2 mb-4">
                    @if (! cms()->isDefaultLanguage() && $widget->translationData(request('lang')))
                        <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($widget->translation(request('lang'))) !!}">Rollback</a>
                    @elseif (is_null(request('lang')))
                        <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($widget) !!}">Rollback</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    @include('cms::layouts.tabs', [ 'module' => 'widgets', 'item' => $widget ])
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {!! Form::model($widget, ['route' => [cms()->route('widgets.update'), $widget->id], 'method' => 'patch', 'class' => 'edit']) !!}

                    <input type="hidden" name="lang" value="{{ request('lang') }}">

                    @if (! cms()->isDefaultLanguage())
                        <input type="hidden" name="name" value="{{ $widget->name }}">
                        <input type="hidden" name="slug" value="{{ $widget->slug }}">
                        <div class="form-group">
                            {!! FormMaker::fromObject($widget->translationData(request('lang')), ['content' => [
                                'type' => 'text',
                                'class' => 'redactor'
                            ]]) !!}
                        </div>
                    @else
                        {!! FormMaker::fromObject($widget, config('cms.forms.widget')) !!}
                    @endif

                    <div class="form-group text-right">
                        <a href="{!! cms()->url('widgets') !!}" class="btn btn-secondary float-left">Cancel</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
