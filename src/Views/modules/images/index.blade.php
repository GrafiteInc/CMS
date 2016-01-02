@extends('quarx::layouts.dashboard')

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="deleteModalLabel">Delete Images</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this image?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" type="button" class="btn btn-warning" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <a class="btn btn-primary pull-right" href="{!! route('quarx.images.create') !!}">Add New</a>
        <h1 class="page-header">Images</h1>
    </div>

    <div class="row">
        @if($images->isEmpty())
            <div class="well text-center">No Images found.</div>
        @else

            @foreach($images as $image)

            <div class="col-md-3 panel raw-margin-top-24">
                <div class="thumbnail">
                    <div class="img" style="background-image: url('{!! FileService::filePreview($image->location) !!}')"></div>
                </div>
                <div class="well pull-down">
                    <p>{!! $image->name !!}</p>
                    <p class="raw-margin-bottom-24">
                        @if ($image->is_published)
                            <span class="pull-left fa fa-check"></span>
                        @endif
                        <a class="pull-right" href="#" onclick="confirmDelete('{!! route('quarx.images.delete', [CryptoService::encrypt($image->id)]) !!}')"><i class="text-danger glyphicon glyphicon-remove"></i></a>
                        <a class="pull-right raw-margin-right-8" href="{!! route('quarx.images.edit', [CryptoService::encrypt($image->id)]) !!}"><i class="text-info glyphicon glyphicon-edit"></i></a>
                    </p>
                </div>
            </div>

            @endforeach

        @endif
    </div>

    <div class="text-center">
        {!! $pagination !!}
    </div>

@endsection

<script type="text/javascript">

    function confirmDelete (url) {
        $('#deleteBtn').attr('href', url);
        $('#deleteModal').modal('toggle');
    }

</script>