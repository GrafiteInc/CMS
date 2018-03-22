
<div class="modal fade" id="deleteLinkModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteModalLabel">Delete Link</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this link?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a id="deleteLinkBtn" class="btn btn-danger" href="#">Confirm Delete</a>
            </div>
        </div>
    </div>
</div>

@if ($links->count() === 0)
    <div class="card card-dark text-center mt-4">
        <div class="card-body">No links found.</div>
    </div>
@else
    <table class="table table-striped mt-4">
        <thead>
            <th>Name</th>
            <th class="m-hidden">Links To</th>
            <th width="170px" class="text-right">Actions</th>
        </thead>
        <tbody id="linkList">

            @foreach($links as $link)
                <tr data-id="{{ $link->id }}">
                    <td>
                        <i class="fa fa-bars mr-4"></i>
                        <a href="{!! route(cms()->route('links.edit'), [$link->id]) !!}">{!! $link->name !!}</a>
                    </td>
                    @if ($link->external)
                    <td class="m-hidden">{!! $link->external_url !!}</td>
                    @else
                    <td class="m-hidden">{!! PageService::pageName($link->page_id) !!}</td>
                    @endif
                    <td>
                        <div class="btn-toolbar justify-content-between">
                            <a class="btn btn-sm btn-outline-primary mr-2" href="{!! route(cms()->route('links.edit'), [$link->id]) !!}"><i class="fa fa-edit"></i> Edit</a>
                            <form method="post" action="{!! cms()->url('links/'.$link->id) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button class="delete-link-btn btn btn-sm btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

