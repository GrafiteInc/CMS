@extends('cms::layouts.dashboard')

@section('pageTitle') Menus @stop

@section('content')

    <div class="modal fade" id="deleteModal" tabindex="-3" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteModalLabel">Delete Menu</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this menu?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="deleteBtn" class="btn btn-danger" href="#">Confirm Delete</a>
                </div>
            </div>
        </div>
    </div>

    @include('cms::layouts.module-header', [ 'module' => 'menus' ])

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                @if ($menus->count() === 0)
                    @include('cms::layouts.module-search', [ 'module' => 'menus' ])
                @else
                    <table class="table table-striped">
                        <thead>
                            <th>{!! sortable('Name', 'name') !!}</th>
                            <th>{!! sortable('Slug', 'slug') !!}</th>
                            <th width="170px" class="text-right">Actions</th>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td><a href="{!! route(cms()->route('menus.edit'), [$menu->id]) !!}">{!! $menu->name !!}</a></td>
                                    <td>{!! $menu->slug !!}</td>
                                    <td class="text-right">
                                         <div class="btn-toolbar justify-content-between">
                                            <a class="btn btn-sm btn-secondary mr-2" href="{!! route(cms()->route('menus.edit'), [$menu->id]) !!}"><i class="fa fa-edit"></i> Edit</a>
                                            <form method="post" action="{!! cms()->url('menus/'.$menu->id) !!}">
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
        </div>
    </div>
    <div class="text-center">
        {!! $pagination !!}
    </div>

@endsection
