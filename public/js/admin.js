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
    $('.add-categ').on('click', function(e) {
        e.preventDefault();
        $('#addCategory').slideToggle();
    })
    $('#addCategory').on('submit', function (e) {
        e.preventDefault();
        thisForm = $(this);
        let categories = $('.categories');
        let categ_name = $(this).find('.categ_name').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/categories/save',
            method: 'POST',
            data: {
                categ_name: categ_name
            },
            success: function(response) {
                categories.append(response);
            },
            error: function(error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    })
    $(document).on('click', '.categ_delete', function(e) {
        e.preventDefault();
        let row = $(this).parents('tr');
        let id = $(this).data('id');
        console.log(id, row, $(this));
        $.ajax({
            url: `/admin/categories/delete/${id}`,
            method: 'GET',
            success: function(response) {
                row.slideToggle();
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    })
    $(document).on('click', '.categ_edit', function(e) {
        e.preventDefault();
        let categ_save = $(this).parent().siblings('.categ_save');
        let categ_action = $(this).parent();
        let input = $(this).parents('.userData').find('.userName input');
        let span = $(this).parents('.userData').find('.userName span');
        
        categ_save.show();
        categ_action.hide();
        span.hide();
        input.show();
})
    $(document).on('keyup', '.userName input', function() {
        let categSave = $(this).parents('.userData').find('.categ_save');
        categSave.attr('data-title', $(this).val());
    })
    $(document).on('click', '.categ_save', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        let title = $(this).attr('data-title');
        let categ_save = $(this);
        let categ_action = $(this).siblings();
        let input = $(this).parents('.userData').find('.userName input');
        let span = $(this).parents('.userData').find('.userName span');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `/admin/categories/save`,
            method: 'POST',
            data: {
                id: id,
                categ_name: title
            },
            success: function(response) {
                span.text(response);
                categ_save.hide();
                categ_action.show();
                span.show();
                input.hide();
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    })
})