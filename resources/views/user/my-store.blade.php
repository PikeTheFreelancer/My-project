@extends('layouts.app')
@section('title', 'My Store')

@section('content')
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
                        <form action="{{ route('user.my-store.save') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-field">
                                <label for="name">Merchandise</label>
                                <input type="text" name="name" id="">
                            </div>
                            <div class="form-field">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="">
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
                                <div class="item">
                                    <p class="name">{{ $item->name }}</p>
                                    <div class="image-container">
                                        <img src="{{ $item->image }}" alt="">
                                    </div>
                                    <p class="description">{{ $item->description }}</p>
                                    <div>
                                        <span>@include('svg.pokedollars')</span>
                                        <span class="price">{{ $item->price }}</span>
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