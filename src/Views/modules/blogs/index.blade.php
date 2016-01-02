@extends('quarx::layouts.dashboard')

@section('content')

        <div class="modal fade" id="deleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="deleteModalLabel">Delete Blog</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete this Blog?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <a id="deleteBtn" type="button" class="btn btn-warning" href="#">Confirm Delete</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <a class="btn btn-primary pull-right" href="{!! route('quarx.blog.create') !!}">Add New</a>
            <div class="raw-m-hide pull-right">
                {!! Form::open(['url' => 'quarx/blog/search']) !!}
                <input class="form-control header-input pull-right raw-margin-right-24" name="term" placeholder="Search">
                {!! Form::close() !!}
            </div>
            <h1 class="page-header">Blog</h1>
        </div>

        <div class="row">

            @if (isset($term))
            <div class="well text-center">Searched for "{!! $term !!}".</div>
            @endif

            @if($blogs->count() === 0)
                <div class="well text-center">No Blogs found.</div>
            @else
                <table class="table table-striped">
                    <thead>
                        <th>Title</th>
                        <th class="raw-m-hide">Url</th>
                        <th class="raw-m-hide">Published</th>
                        <th width="50px">Action</th>
                    </thead>
                    <tbody>

                    @foreach($blogs as $blog)
                        <tr>
                            <td>{!! $blog->title !!}</td>
                            <td class="raw-m-hide">{!! $blog->url !!}</td>
                            <td class="raw-m-hide">@if ($blog->is_published) <span class="fa fa-check"></span> @endif </td>
                            <td>
                                <a href="{!! route('quarx.blog.edit', [CryptoService::encrypt($blog->id)]) !!}"><i class="text-info glyphicon glyphicon-edit"></i></a>
                                <a href="#" onclick="confirmDelete('{!! route('quarx.blog.delete', [CryptoService::encrypt($blog->id)]) !!}')"><i class="text-danger glyphicon glyphicon-remove"></i></a>
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

@endsection

<script type="text/javascript">

    function confirmDelete (url) {
        $('#deleteBtn').attr('href', url);
        $('#deleteModal').modal('toggle');
    }

</script>