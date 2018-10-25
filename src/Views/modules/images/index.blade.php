@extends('cms::layouts.dashboard')

@section('pageTitle') Images @stop

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteModalLabel">Delete Images</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this image?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" class="btn btn-danger" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bulkImageDeleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteModalLabel">Bulk Image Delete</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete these images?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="bulkImageDelete" class="btn btn-danger" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <nav class="navbar px-0 navbar-light justify-content-between">
            <div class="navbar-nav navbar-expand-md mr-auto justify-content-between">
                <a class="nav-item btn btn-primary mr-1 mt-2" href="{!! route(cms()->route('images.create')) !!}">Add New</a>
                <button class="nav-item btn btn-danger bulk-image-delete mt-2"><span class="fa fa-trash"></span> Bulk Delete</button>
            </div>
            {!! Form::open(['url' => cms()->url('images/search'), 'class' => 'form-inline mt-2']) !!}
                <input class="form-control mr-sm-2" name="term" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            {!! Form::close() !!}
        </nav>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @if ($images->count() === 0)
                        <div class="col-md-12">
                            @include('cms::layouts.module-search', [ 'module' => 'images' ])
                        </div>
                    @else
                        @foreach($images as $image)
                            <div class="col-md-4 col-xl-3 image-panel raw-margin-top-24">
                                <div class="thumbnail">
                                    <a href="{!! route(cms()->route('images.edit'), [$image->id]) !!}">
                                        <div class="img" style="background-image: url('{!! $image->url !!}')"></div>
                                    </a>
                                </div>
                                <div data-id="{{ $image->id }}" class="well pull-down overflow-hidden selectable">
                                    <div class="row">
                                        <div class="col-6">
                                            @if ($image->is_published)
                                                <span clas="pull-left"><span class="pull-left fa fa-check"></span> Published</span>
                                            @else
                                                <span clas="pull-left"><span class="pull-left fa fa-times"></span> Published</span>
                                            @endif
                                        </div>
                                        <div class="col-6">
                                            <div class="btn-toolbar float-right">
                                                <a class="btn btn-sm btn-secondary img-alter-btn mr-2" href="{!! route(cms()->route('images.edit'), [$image->id]) !!}"><i class="fa fa-edit"></i></a>
                                                <form method="post" action="{!! cms()->url('images/'.$image->id) !!}">
                                                    {!! csrf_field() !!}
                                                    {!! method_field('DELETE') !!}
                                                    <button class="delete-btn btn btn-sm img-alter-btn btn-danger" type="submit"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="text-center">
        {!! $pagination !!}
    </div>

@endsection

@section('pre_javascript')

    @parent
    var _cmsUrl = "{{ cms()->url('/') }}";

@stop
