$(document).ready(function () {
    $('.admin-header .right').on('click', function () {
        $('.logout-btn').slideToggle();
    })
    $('.nav-dropdown').on('click', function () {
        $(this).find('.nav-children').slideToggle();
    })
    $('.ban').on('click', function (e) {
        e.preventDefault();
        var thisBtn = $(this);
        var id = thisBtn.data('id');
        let text;
        if (thisBtn.text() == 'Ban') {
            text = "Are you sure to ban this account?";
        } else {
            text = "Are you sure to unban this account?";
        }
        if (confirm(text) == true) {
            $.ajax({
                url: `users/ban/${id}`,
                method: 'GET',
                success: function(response) {
                    if (response) {
                        thisBtn.text('Ban');
                        thisBtn.parents('.userData').find('.userStatus').text('1');
                    } else {
                        thisBtn.text('Unban');
                        thisBtn.parents('.userData').find('.userStatus').text('0');
                    }
                },
                error: function(error) {
                    // Handle any errors that occur during the Ajax request
                    console.error('Error:', error);
                }
            });
        }
    })

    $('.delete').on('click', function (e) {
        e.preventDefault();
        var thisBtn = $(this);
        var id = thisBtn.data('id');
        let text = "Are you sure to delete this account?";
        if (confirm(text) == true) {
            $.ajax({
                url: `users/delete/${id}`,
                method: 'GET',
                success: function(response) {
                    thisBtn.parents('.userData').slideUp();
                },
                error: function(error) {
                    // Handle any errors that occur during the Ajax request
                    console.error('Error:', error);
                }
            });
        }
    })

    $('#addCategory').on('submit', function (e) {
        e.preventDefault();
        thisForm = $(this);
        let categories = $(this).find('.categories');
        let categ_name = $('.categ_name').val();
        console.log(this);
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //     url: '/admin/categories/save',
        //     method: 'POST',
        //     data: {
        //         categ_name: categ_name
        //     },
        //     success: function(response) {
        //         console.log(response);
        //     },
        //     error: function(error) {
        //         // Handle any errors that occur during the Ajax request
        //         console.error('Error:', error);
        //     }
        // });
    })
})