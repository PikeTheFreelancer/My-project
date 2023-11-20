@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-dashboard">
        <h1>Users</h1>
        <table>
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Create at</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                @foreach ($users as $user)
                    <tr class="userData">
                        <td class="userId">{{$user->id}}</td>
                        <td class="userName">{{$user->name}}</td>
                        <td class="userEmail">{{$user->email}}</td>
                        <td class="userCreatedAt">{{$user->created_at}}</td>
                        <td class="text-center userStatus">{{$user->status}}</td>
                        <td>
                            @if ($user->status)
                                <a data-id="{{$user->id}}" class="ban" href="#">Ban</a>
                            @else
                                <a data-id="{{$user->id}}" class="ban" href="#">Unban</a>
                            @endif
                             / <a data-id="{{$user->id}}" class="delete" href="#">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection