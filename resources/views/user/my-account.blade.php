@extends('layouts.app')
@section('title', 'My Account')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="my-account-page">
            <div class="card">
                <div class="card-header">{{ __('My Account') }}</div>

                <div class="card-body merchandise">
                    <div id="demo1" class="demoWrapper">
                        <h2>Keep crop area square</h2>
                        <div id="cropperContainer1" class="cropperContainer"></div>
                        <div class="previews">
                            <div id="previewSmall1" class="previewSmall"></div>
                            <div id="previewBig1" class="previewBig"></div>
                        </div>
                        <div id="info1" class="info"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection