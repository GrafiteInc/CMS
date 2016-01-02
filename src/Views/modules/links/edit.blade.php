@extends('quarx::layouts.dashboard')

@section('content')

        <div class="row">
            <h1 class="page-header">Links</h1>
        </div>

        @include('quarx::modules.links.breadcrumbs', ['location' => [['Menu' => URL::to('quarx/menus/'.CryptoService::encrypt($links->menu_id).'/edit')], 'links', 'edit']])

        {!! Form::model($links, ['route' => ['quarx.links.update', CryptoService::encrypt($links->id)], 'method' => 'patch']) !!}

            {!! FormMaker::fromObject($links, Quarx::config('forms.link')) !!}

            <div class="form-group text-right">
                <a href="{!! URL::previous() !!}" class="btn btn-default raw-left">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}

@endsection

@section('javascript')

    @parent
    <script type="text/javascript">

    if ($("#External").is(':checked')) {
        $('#External_url').parent().show();
        $('#Page_id').parent().hide();
    } else {
        $('#External_url').parent().hide();
        $('#Page_id').parent().show();
    }

    $(window).ready(function(){
        $("#External").bind('click', function() {
            if ($(this).is(':checked')) {
                $('#External_url').parent().show();
                $('#Page_id').parent().hide();
            } else {
                $('#External_url').parent().hide();
                $('#Page_id').parent().show();
            }
        });

    });

    </script>

@endsection
