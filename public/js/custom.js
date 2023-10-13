$(document).ready(function(){
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
      })

    $('.accordion-box').on('click', function() {
        $('#add-merchandise').slideToggle();
    })

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
                console.log('Marked as read:', response);
                this_noti.removeClass('noti-unread');
            },
            error: function(error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    })
});