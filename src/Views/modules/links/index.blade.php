
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
            <div class="well text-center">No Links found.</div>
        @else
            <table class="table table-striped">
                <thead>
                <th>Name</th>
                <th class="raw-m-hide">Links To</th>
                <th width="50px">Action</th>
                </thead>
                <tbody>

                @foreach($links as $links)
                    <tr>
                        <td>{!! $links->name !!}</td>
                        @if ($links->external)
                        <td class="raw-m-hide">{!! $links->external_url !!}</td>
                        @else
                        <td class="raw-m-hide">{!! PageService::pageName($links->page_id) !!}</td>
                        @endif
                        <td>
                            <a href="{!! route('quarx.links.edit', [CryptoService::encrypt($links->id)]) !!}"><i class="text-info glyphicon glyphicon-edit"></i></a>
                            <a href="#" onclick="confirmLinkDelete('{!! route('quarx.links.delete', [CryptoService::encrypt($links->id)]) !!}')"><i class="text-danger glyphicon glyphicon-remove"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

