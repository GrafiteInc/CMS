@extends('cms::layouts.dashboard')

@section('pageTitle') Endorsements @stop

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6 mt-2">
                @include('cms::modules.endorsements.breadcrumbs', ['location' => ['edit']])
            </div>
            <div class="col-md-6">
                <div class="btn-toolbar float-right mt-2">
                    @if (! cms()->isDefaultLanguage() && $endorsement->translationData(request('lang')))
                        <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($endorsement->translation(request('lang'))) !!}">Rollback</a>
                    @elseif (is_null(request('lang')))
                        <a class="btn btn-warning ml-1" href="{!! Cms::rollbackUrl($endorsement) !!}">Rollback</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row mb-4">
            <div class="col-md-12">
                <ul class="nav nav-tabs">
                    @include('cms::layouts.tabs', [ 'module' => 'endorsements', 'item' => $endorsement ])
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="@if (config('cms.live-preview', false)) col-md-6 @else col-md-12 @endif">
                {!! Form::model($endorsement, ['route' => [cms()->route('endorsements.update'), $endorsement->id], 'method' => 'patch', 'class' => 'edit']) !!}

                    <input type="hidden" name="lang" value="{{ request('lang') }}">

                    {!! FormMaker::setColumns(3)->fromObject($endorsement->asObject(), config('cms.forms.endorsement.identity')) !!}
                    {!! FormMaker::setColumns(1)->fromObject($endorsement->asObject(), config('cms.forms.endorsement.content')) !!}

                    <div class="form-group text-right">
                        <a href="{!! cms()->url('endorsements') !!}" class="btn btn-secondary float-left">Cancel</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>

                {!! Form::close() !!}
            </div>
            @if (config('cms.live-preview', false))
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div id="wrap">
                        @if (! cms()->isDefaultLanguage())
                            <iframe id="frame" src="{!! cms()->url('preview/endorsement/'.$endorsement->id.'?lang='.request('lang')) !!}"></iframe>
                        @else
                            <iframe id="frame" src="{{ cms()->url('preview/endorsement/'.$endorsement->id) }}"></iframe>
                        @endif
                    </div>
                    <div id="frameButtons" class="raw-margin-top-16">
                        <button class="btn btn-secondary preview-toggle" data-platform="desktop">Desktop</button>
                        <button class="btn btn-secondary preview-toggle" data-platform="mobile">Mobile</button>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
