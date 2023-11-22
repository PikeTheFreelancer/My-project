@extends('layouts.app')
@section('title', 'My Store')

@section('content')

@include('layouts.edit-merchandise')
<div class="my-store-page page">
    <div class="card-header">
        <h1>{{ __('messages.header.store') }}</h1>
    </div>

    <div class="card-body merchandise">
        <div class="add">
            <div class="accordion-box">
                <span class="plus-icon">
                    @include('svg.plus')
                </span>
                <span>{{ __('messages.merchandise.add') }}</span>
            </div>
            <form id="add-merchandise" action="{{ route('user.my-store.save') }}" method="POST" enctype="multipart/form-data" style="display: none">
                @csrf
                <div class="form-field">
                    <label for="name">{{ __('messages.merchandise') }}</label>
                    <input type="text" name="name" id="">
                </div>
                <div class="form-field">
                    <label for="image">{{ __('messages.image') }}</label>
                    <div class="image-uploader">
                        <input type="file" name="image" id="image_uploader">
                        <img class="thumbnail" src="" alt="" id="item_image">
                    </div>
                </div>
                <div class="form-field">
                    <label for="description">{{ __('messages.desc') }}</label>
                    <textarea name="description" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="form-field">
                    <label for="price">{{ __('messages.price') }}</label>
                    <input type="text" name="price" class="price">
                </div>
                <div class="form-field">
                    <button class="btn btn-primary" type="submit">{{ __('messages.submit') }}</button>
                </div>
            </form>
        </div>
        <div class="currently-sale">
            @if (count($merchandises) > 0)
                @foreach ($merchandises as $item)
                    <div data-id="{{ $item->id }}" class="item grass">
                        <p class="name">{{ $item->name }}</p>
                        <div class="image-container @if(!$item->image) no-image @endif">
                            @if (!$item->image)
                            {{ __('messages.merchandise.no_img') }}
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
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">{{ __('community.edit') }}</button>
                            <button class="btn btn-primary btn-delete">{{ __('community.delete') }}</button>
                        </div>
                        <div class="confirm-delete" style="display:none">
                            <div>
                                {{ __('messages.merchandise.confirm') }}
                            </div>
                            <div class="actions-box">
                                <button class="btn btn-primary btn-confirm-delete">{{ __('messages.yes') }}</button>
                                <button class="btn btn-secondary btn-cancel-delete">{{ __('messages.no') }}</button>
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
@endsection