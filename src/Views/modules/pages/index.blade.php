@extends('cms::layouts.dashboard')

@section('pageTitle') Pages @stop

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this page?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" class="btn btn-danger" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-light justify-content-between">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{!! route(config('cms.backend-route-prefix', 'cms').'.pages.create') !!}">Add New</a>
                    </li>
                </ul>
                {!! Form::open(['url' => 'cms/pages/search', 'class' => 'form-inline']) !!}
                    <input class="form-control mr-sm-2" name="term" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                {!! Form::close() !!}
            </nav>
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                @if ($pages->count() === 0)
                    <div class="card card-dark text-center mt-4">
                        @if (request('term'))
                            <div class="card-header">Searched for "{!! $term !!}"</div>
                        @endif
                        <div class="card-body">No pages found.</div>
                    </div>
                @else
                    <table class="table table-striped">
                        <thead>
                            <th>{!! sortable('Title', 'title') !!}</th>
                            <th class="hidden-sm hidden-xs">{!! sortable('Url', 'url') !!}</th>
                            <th class="hidden-sm hidden-xs">{!! sortable('Is Published', 'is_published') !!}</th>
                            <th width="170px" class="text-right">Actions</th>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td><a href="{!! route(config('cms.backend-route-prefix', 'cms').'.pages.edit', [$page->id]) !!}">{!! $page->title !!}</a></td>
                                    <td class="hidden-sm hidden-xs">{!! $page->url !!}</td>
                                    <td class="hidden-sm hidden-xs">
                                        @if ($page->is_published)
                                            <span class="fa fa-check"></span>
                                        @else
                                            <span class="fa fa-close"></span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-toolbar justify-content-between">
                                            <a class="btn btn-sm btn-outline-primary mr-2" href="{!! route(config('cms.backend-route-prefix', 'cms').'.pages.edit', [$page->id]) !!}"><i class="fa fa-edit"></i> Edit</a>
                                            <form method="post" action="{!! url(config('cms.backend-route-prefix', 'cms').'/pages/'.$page->id) !!}">
                                                {!! csrf_field() !!}
                                                {!! method_field('DELETE') !!}
                                                <button class="delete-btn btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="text-center">
                {!! $pagination !!}
            </div>
        </div>
    </div>

@endsection

