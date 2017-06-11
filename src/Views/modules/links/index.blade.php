
<div class="modal fade" id="deleteLinkModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="deleteModalLabel">Delete Link</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this link?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a id="deleteLinkBtn" type="button" class="btn btn-warning" href="#">Confirm Delete</a>
            </div>
        </div>
    </div>
</div>

@if($links->count() === 0)
    <div class="well text-center">No links found.</div>
@else
    <table class="table table-striped">
        <thead>
            <th>Name</th>
            <th class="raw-m-hide">Links To</th>
            <th width="200px" class="text-right">Actions</th>
        </thead>
        <tbody id="linkList">

            @foreach($links as $link)
                <tr data-id="{{ $link->id }}">
                    <td><a href="{!! route(config('quarx.backend-route-prefix', 'quarx').'.links.edit', [$link->id]) !!}">{!! $link->name !!}</a></td>
                    @if ($link->external)
                    <td class="raw-m-hide">{!! $link->external_url !!}</td>
                    @else
                    <td class="raw-m-hide">{!! PageService::pageName($link->page_id) !!}</td>
                    @endif
                    <td>
                        <form method="post" action="{!! url(config('quarx.backend-route-prefix', 'quarx').'/links/'.$link->id) !!}">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button class="delete-link-btn btn btn-xs btn-danger pull-right" type="submit"><i class="fa fa-trash"></i> Delete</button>
                        </form>
                        <a class="btn btn-xs btn-default pull-right raw-margin-right-8" href="{!! route(config('quarx.backend-route-prefix', 'quarx').'.links.edit', [$link->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

