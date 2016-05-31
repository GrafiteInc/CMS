@extends('quarx::layouts.dashboard')

@section('content')

    <div class="row">
        <form id="" class="pull-right raw-margin-left-24" method="post" action="/admin/roles/search">
            {!! csrf_field() !!}
            <input class="form-control" name="search" placeholder="Search">
        </form>
        <a class="btn btn-default pull-right" href="{{ url('admin/roles/create') }}">Create New Role</a>
        <h1 class="page-header">Roles</h1>
    </div>
    <div class="row">
        <table class="table table-striped raw-margin-top-24">

            <thead>
                <th>Name</th>
                <th>Label</th>
                <th class="text-right">Actions</th>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->label }}</td>
                        <td>
                            <form method="post" action="{!! url('admin/roles/'.$role->id) !!}">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}
                                <button class="btn btn-danger btn-xs pull-right" type="submit" onclick="return confirm('Are you sure you want to delete this role?')"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                            <a class="btn btn-warning btn-xs pull-right raw-margin-right-16" href="{{ url('admin/roles/'.$role->id.'/edit') }}"><span class="fa fa-edit"></span> Edit</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>

@stop
