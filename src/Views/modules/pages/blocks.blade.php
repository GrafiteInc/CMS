<div class="modal fade" id="deleteBlockModal" tabindex="-3" role="dialog" aria-labelledby="deleteBlockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="deleteBlockModalLabel">Delete Block</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this block?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="deleteBlockBtn" type="button" class="btn btn-danger">Confirm Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addBlockModal" tabindex="-3" role="dialog" aria-labelledby="addBlockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="addBlockModalLabel">Add Block</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input id="blockName" type="text" class="form-control" placeholder="Slug">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="addBlockBtn" type="button" class="btn btn-primary">Add Block</button>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <h2>Blocks
                <button type="button" class="btn btn-default pull-right add-block-btn">Add Block</button>
            </h2>
            <hr>
        </div>
        <div class="blocks">
            @if (!is_null($page))
                @foreach ($page->blocks as $slug => $block)
                    <div id="block_container_{{ $slug }}" class="col-md-12">
                        <div class="form-group">
                            <h4>
                                {{ ucfirst($slug) }}
                                <button type="button" class="btn btn-xs btn-danger delete-block-btn pull-right" data-slug="block_container_{{ $slug }}"><span class="fa fa-trash"></span></button>
                            </h4>
                            <textarea id="block_{{ $slug }}" name="block_{{ $slug }}" class="form-control redactor">{{ $block }}</textarea>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>