<div class="modal fade" id="deleteBlockModal" tabindex="-3" role="dialog" aria-labelledby="deleteBlockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBlockModalLabel">Delete Block</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this block?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="deleteBlockBtn" class="btn btn-danger">Confirm Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addBlockModal" tabindex="-3" role="dialog" aria-labelledby="addBlockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBlockModalLabel">Add Block</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input id="blockName" type="text" class="form-control" placeholder="Slug">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="addBlockBtn" class="btn btn-primary">Add Block</button>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h3>Blocks
            <button type="button" class="btn btn-outline-primary float-right btn-sm add-block-btn mt-2">Add Block</button>
        </h3>
        <hr>
    </div>
    <div class="blocks col-md-12">
        <div class="row">
            @if (!is_null($item))
                @foreach ($item->blocks as $slug => $block)
                    <div id="block_container_{{ $slug }}" class="col-md-6">
                        <div class="form-group">
                            <h4>
                                {{ ucfirst($slug) }}
                                <button type="button" class="btn btn-sm btn-danger delete-block-btn float-right" data-slug="block_container_{{ $slug }}"><span class="fa fa-trash"></span></button>
                            </h4>
                            <textarea id="block_{{ $slug }}" name="block_{{ $slug }}" class="form-control redactor">{{ $block }}</textarea>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
