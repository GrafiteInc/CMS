@extends('quarx::layouts.blank')

@section('content')

<div class="container raw-margin-bottom-48">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Account Admin</h1>
            <div class="col-md-12 text-center">
                @include('partials.navigation')
            </div>

            <div class="col-md-12">
                @include('partials.errors')
                @include('partials.message')

                <table class="table table-striped raw-margin-top-24">

                    <thead>
                        <th>Email</th>
                        <th class="text-right">Actions</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)

                            @if ($user->id !== Auth::id())
                                <tr>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a class="btn btn-danger btn-xs raw-margin-left-16 pull-right" href="{{ url('admin/users/'.$user->id.'/delete') }}" onclick="return confirm('Are you sure you want to delete this user?')"><span class="fa fa-edit"></span> Delete</a>
                                        <a class="btn btn-warning btn-xs pull-right" href="{{ url('admin/users/'.$user->id.'/edit') }}"><span class="fa fa-edit"></span> Edit</a>
                                    </td>
                                </tr>
                            @endif

                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@stop
