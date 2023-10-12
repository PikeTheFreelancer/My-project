@extends('layouts.app')
@section('title', 'My Store')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
                        <form action="">
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
                                <button class="btn btn-primary" type="submit">submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="currently-sale">
                        <p>You haven't added any merchandise yet!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection