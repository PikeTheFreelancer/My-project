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
})