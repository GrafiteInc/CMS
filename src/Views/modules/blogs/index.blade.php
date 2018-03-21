@extends('cms::layouts.dashboard')

@section('pageTitle') Blog @stop

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteModalLabel">Delete Blog</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this blog?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" class="btn btn-warning" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <nav class="navbar px-0 navbar-light justify-content-between">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-primary" href="{!! route(config('cms.backend-route-prefix', 'cms').'.blog.create') !!}">Add New</a>
                </li>
            </ul>
            {!! Form::open(['url' => 'cms/blog/search', 'class' => 'form-inline mt-2']) !!}
                <input class="form-control mr-sm-2" name="term" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            {!! Form::close() !!}
        </nav>
    </div>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                @if ($blogs->count() === 0)
                    <div class="card card-dark text-center mt-4">
                        @if (request('term'))
                            <div class="card-header">Searched for "{!! $term !!}"</div>
                        @endif
                        <div class="card-body">No blogs found.</div>
                    </div>
                @else
                    <table class="table table-striped">
                        <thead>
                            <th>{!! sortable('Title', 'title') !!}</th>
                            <th class="m-hidden">{!! sortable('Url', 'url') !!}</th>
                            <th class="m-hidden">{!! sortable('Published', 'is_published') !!}</th>
                            <th width="170px" class="text-right">Actions</th>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td><a href="{!! route(config('cms.backend-route-prefix', 'cms').'.blog.edit', [$blog->id]) !!}">{!! $blog->title !!}</a></td>
                                    <td class="m-hidden">{!! $blog->url !!}</td>
                                    <td class="m-hidden">
                                        @if ($blog->is_published)
                                            <span class="fa fa-check"></span>
                                        @else
                                            <span class="fa fa-close"></span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-toolbar justify-content-between">
                                            <a class="btn btn-sm btn-outline-primary mr-2" href="{!! route(config('cms.backend-route-prefix', 'cms').'.blog.edit', [$blog->id]) !!}"><i class="fa fa-edit"></i> Edit</a>
                                            <form method="post" action="{!! url(config('cms.backend-route-prefix', 'cms').'/blog/'.$blog->id) !!}">
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
