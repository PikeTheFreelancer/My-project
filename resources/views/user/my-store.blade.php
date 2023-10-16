@extends('layouts.app')
@section('title', 'My Store')

@section('content')

@include('layouts.edit-merchandise')
<div class="container">
    <div class="row justify-content-center">
        <div class="my-store-page">
            <div class="card">
                <div class="card-header">{{ __('My Store') }}</div>

                <div class="card-body merchandise">
                    <div class="add">
                        <div class="accordion-box">
                            <span class="plus-icon">
                                @include('svg.plus')
                            </span>
                            <span>Add new merchandise</span>
                        </div>
                        <form id="add-merchandise" action="{{ route('user.my-store.save') }}" method="POST" enctype="multipart/form-data" style="display: none">
                            @csrf
                            <div class="form-field">
                                <label for="name">Merchandise</label>
                                <input type="text" name="name" id="">
                            </div>
                            <div class="form-field">
                                <label for="image">Image</label>
                                <div class="image-uploader">
                                    <input type="file" name="image" id="image_uploader">
                                    <img class="thumbnail" src="" alt="" id="item_image">
                                </div>
                            </div>
                            <div class="form-field">
                                <label for="description">Description</label>
                                <textarea name="description" id="" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-field">
                                <label for="price">Price</label>
                                <input type="text" name="price" id="">
                            </div>
                            <div class="form-field">
                                <button class="btn btn-primary" type="submit">submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="currently-sale">
                        @if (count($merchandises) > 0)
                            @foreach ($merchandises as $item)
                                <div data-id="{{ $item->id }}" class="item glass">
                                    <p class="name">{{ $item->name }}</p>
                                    <div class="image-container @if(!$item->image) no-image @endif">
                                        @if (!$item->image)
                                            No image provided
                                        @else
                                            <img src="{{ $item->image }}" alt="">
                                        @endif
                                    </div>
                                    <p class="description">{{ $item->description }}</p>
                                    <div class="price-box">
                                        <span>@include('svg.pokedollars')</span>
                                        <span class="price">{{ $item->price }}</span>
                                    </div>
                                    <div class="actions-box">
                                        <button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">edit</button>
                                        <button class="btn btn-primary btn-delete">delete</button>
                                    </div>
                                    <div class="confirm-delete" style="display:none">
                                        <div>
                                            are you sure to delete this item?
                                        </div>
                                        <div>
                                            <button class="btn btn-primary btn-confirm-delete">Yes</button>
                                            <button class="btn btn-secondary btn-cancel-delete">No</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>You haven't added any merchandise yet!</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection