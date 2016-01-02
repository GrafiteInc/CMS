@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <h1 class="page-header">Links</h1>
    </div>

    @include('quarx::modules.links.breadcrumbs', ['location' => ['create']])

    {!! Form::open(['route' => 'quarx.links.store']) !!}

        {!! FormMaker::fromTable('links', Quarx::config('forms.link')) !!}

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
        $("#Menu_id").val('{!! $menu_id !!}');
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
