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
<script>
    var infoNode1 = document.getElementById('info1');
    var ic1 = new ICropper(
        'cropperContainer1'
        ,{
            ratio: 1
            ,image: '{{ asset('images/demo.png') }}'
            ,onChange: function(info){	//onChange must be set when constructing.
                infoNode1.innerHTML = 'Left: ' + info.l + 'px, Top: '+info.t
                    + 'px, Width: ' + info.w + 'px, Height: ' + info.h+'px';
            }
            ,preview: [
                'previewSmall1'
            ]
        });
    //use bindPreview to dynamically add preview nodes
    ic1.bindPreview('previewBig1');
</script>
@endsection