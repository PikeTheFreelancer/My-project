$(document).ready(function(){
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      })

    $('.accordion-box').on('click', function() {
        $('#add-merchandise').slideToggle();
    })
    $('.image-uploader input').on('change', function() {
        const fileInput = this;
        const imagePreview = $(this).siblings('img');
        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.attr('src', e.target.result);
                imagePreview.show();
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.attr('src', '');
            imagePreview.hide();
        }
    });
    $(document).on('click', '.currently-sale .item', function() {
        var merchandise_id = $(this).data('id');
        console.log(merchandise_id);
        var this_merchandise = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/my-store/get-merchandise-fields',
            method: 'POST',
            data: { merchandise_id: merchandise_id },
            success: function(response) {
                // Handle the success response from the controller
                console.log(response);
                $('#merchandise_id').val(response.id);
                $('#item_name').val(response.name);
                $('#item_image').attr('src',response.image);
                $('#item_description').val(response.description);
                $('#item_price').val(response.price);
            },
            error: function(error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    })
});