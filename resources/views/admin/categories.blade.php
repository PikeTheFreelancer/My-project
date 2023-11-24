@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-dashboard">
        <h1>Categories</h1>
        
        <a class="add-categ" href="#">+ Add Category</a>
        <table style="margin-top: 40px">
            <tbody class="categories">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Create at</th>
                    <th>Actions</th>
                </tr>
                @foreach ($categories as $category)
                    <tr class="userData">
                        <td class="userId">{{$category->id}}</td>
                        <td class="userName">{{$category->name}}</td>
                        <td class="userCreatedAt">{{$category->created_at}}</td>
                        <td>
                            <a data-id="{{$category->id}}" class="categ_edit" href="#">Edit</a> /
                            <a data-id="{{$category->id}}" class="categ_delete" href="#">Delete</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <form id="addCategory" action="/categories/save" method="POST">
                        @csrf
                        <td>{{ $categories->count() ? $categories->count() : 1 }}</td>
                        <td><input class="categ_name" type="text" name="categ_name"></td>
                        <td><button type="submit">Save</button></td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
@endsection