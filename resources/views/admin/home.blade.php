@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="admin-dashboard">
        <h1>Dashboard</h1>
        <form action="{{route('home.save')}}" method="POST">
            @csrf
            <div class="add-block">
                <span class="plus-icon">
                    @include('svg.plus')
                </span>
                <span>Add block</span>
            </div>
            @include('admin.blocks.text_and_image')
            <div class="form-field">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection