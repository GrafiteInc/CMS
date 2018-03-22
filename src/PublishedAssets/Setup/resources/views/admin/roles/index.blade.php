@extends('cms::layouts.dashboard')

@section('pageTitle') Roles @stop

@section('content')

    <div class="col-md-12">
        <nav class="navbar px-0 navbar-light justify-content-between">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="btn btn-primary" href="{{ url('admin/roles/create') }}">Create New Role</a>
                </li>
            </ul>
            {!! Form::open(['url' => 'admin/users/search', 'method' => 'post', 'class' => 'form-inline mt-2']) !!}
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            {!! Form::close() !!}
        </nav>
    </div>

    <div class="col-md-12">
        @if ($roles->count() === 0)
            <div class="card card-dark text-center mt-4">
                @if (request('search'))
                    <div class="card-header">Searched for "{{ request('search') }}"</div>
                @endif
                <div class="card-body">No roles found.</div>
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <th>Name</th>
                    <th>Label</th>
                    <th width="170px" class="text-right">Actions</th>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->label }}</td>
                            <td class="text-right">
                                <div class="btn-toolbar justify-content-between">
                                    <a class="btn btn-outline-primary btn-sm mr-2" href="{{ url('admin/roles/'.$role->id.'/edit') }}"><span class="fa fa-edit"></span> Edit</a>
                                    <form method="post" action="{!! url('admin/roles/'.$role->id) !!}">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this role?')"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

@stop
