@extends('layouts.app')

@section('content')
<div class="section-container">
    <div class="newsfeed-page page">
        <div class="card">
            <div class="card-header">{{ __('Newsfeed') }}</div>

            <div class="card-body">
                <form method="post">
                    <textarea id="mytextarea">Hello, World!</textarea>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
