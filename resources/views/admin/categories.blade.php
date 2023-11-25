@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-dashboard">
        <h1>Categories</h1>
        
        <a class="add-categ" href="#">+ Add Category</a>
        <form id="addCategory" action="/categories/save" method="POST">
            @csrf
            <input class="categ_name input-border" type="text" name="categ_name">
            <button type="submit">Save</button>
        </form>
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
                        <td class="userName">
                            <span>{{$category->name}}</span>
                            <input style="width: auto; display:none;" class="input-border" type="text" data-trans="edit-categ-{{$category->id}}" value="{{$category->name}}">
                        </td>
                        <td class="userCreatedAt">
                            {{$category->updated_at}}
                        </td>
                        <td>
                            <span class="categ_save" data-id="{{$category->id}}" data-title="{{$category->name}}" style="display: none">
                                Save
                            </span>
                            <span class="categ_action">
                                <a data-id="{{$category->id}}" class="categ_edit" href="#">Edit</a> /
                                <a data-id="{{$category->id}}" class="categ_delete" href="{{route('admin.categories.delete',$category->id)}}">Delete</a>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
@endsection