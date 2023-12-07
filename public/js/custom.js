$(document).ready(function(){
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
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

    $(document).on("click", ".btn-delete", function() {
        $(this).parents('.actions-box').siblings('.confirm-delete').slideToggle();
    });

    $(document).on('click', '.btn-cancel-delete', function() {
        $(this).parents('.confirm-delete').slideToggle();
    })

    $(document).on('click', '.btn-confirm-delete', function() {
        var merchandise_id = $(this).parents('.item').data('id');
        var thisItem =  $(this).parents('.item');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/my-store/delete',
            method: 'POST',
            data: { merchandise_id: merchandise_id },
            success: function(response) {
                // Handle the success response from the controller
                thisItem.fadeOut();
            },
            error: function(error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    })

    //crop image
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;

    $("body").on("change", ".avatar", function(e){
        var files = e.target.files;
        var done = function (url) {
            image.src = url;
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
            reader.readAsDataURL(file);
            }
        }
    });

    // Show Model Event
    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview'
        });

    }).on('hidden.bs.modal', function () {

        cropper.destroy();

        cropper = null;

    });

    // Crop Button Click Event
    $("#crop").click(function(){
        canvas = cropper.getCroppedCanvas({
            width: 160,
            height: 160,
        });

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                $("input[name='image_base64']").val(base64data);
                $(".show-image").show();
                $(".show-image").attr("src",base64data);
                $("#modal").modal('toggle');
            }
        });
    });

    //auto increase height of textarea
    let height;
    $('textarea').each(function () {
        this.style.height = (this.scrollHeight-20) + 'px';
        height = this.style.height;
      }).on('input', function () {
        const lineHeight = parseFloat($(this).css("line-height"));
        const totalHeight = this.scrollHeight;
        const numberOfLines = totalHeight / lineHeight;

        if (Math.floor(numberOfLines) == 2) {
            this.style.height = height;
        } else {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        }
    });
    //thumbnail avatar
    $(document).on('click', '.thumbnail-avatar', function(e) {
        e.preventDefault();
        $('.dropdown-actions').slideToggle();
    })
    //notification dropdown
    $(document).on('click', '.notification-box', function(e) {
        e.preventDefault();
        $('.menu-notification').slideToggle();
        $('.new-notification').hide();
    })

    // toggle notification box
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.notification-box').length) {
            $('.menu-notification').slideUp();
        }
        if (!$(e.target).closest('.mobile-navbar').length && !$(e.target).closest('.mobile-nav-links').length) {
            $('.mobile-nav-links').slideUp();
        }
        if (!$(e.target).closest('.search-bar-mobile').length && !$(e.target).closest('.search-form-mobile').length) {
            $('.search-form-mobile').slideUp();
        }
        if (!$(e.target).closest('.lang').length && !$(e.target).closest('.lang').length) {
            $('.lang-items').slideUp();
        }
        if (!$(e.target).closest('.thumbnail-avatar').length && !$(e.target).closest('.thumbnail-avatar').length) {
            $('.dropdown-actions').slideUp();
        }
    })

    // mark as read
    $(document).on('click', '.noti-item', function(e) {
        window.location.hash = '#' + $(this).attr('href').split('#')[1];
        var noti_id = $(this).data('id');
        var this_noti = $(this);
        this_noti.removeClass('noti-unread');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/notification/mark-as-read',
            method: 'POST',
            data: { noti_id: noti_id }, // Send the ID as data
            success: function(response) {
                // Handle the success response from the controller
                console.log('Marked as read:', response);
            },
            error: function(error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
        if (window.location.hash) {
            var targetElement = $(window.location.hash);
            if (targetElement.length > 0) {
                $('html, body').animate({
                    scrollTop: targetElement.offset().top
                }, 1000);
            }
        }

        targetElement.addClass('highlight-background');
        setTimeout(function() {
            targetElement.removeClass('highlight-background');
        }, 5000);
    })

    var current_url = $(location).attr('href');
    if (current_url.includes("#comment-")) {
        var hash = current_url.split("#")[1];
        $(`#${hash}`).addClass('highlight-background');
        setTimeout(function() {
            $(`#${hash}`).removeClass('highlight-background');
        }, 5000);
    }

    //header functions
    $('.mobile-navbar').on('click', function() {
        $('.mobile-nav-links').slideToggle();
    })

    $('.mobile-nav-link').on('click', function() {
        $('.sub-links').slideToggle();
    })

    $('.load-prev-comments').each(function() {
        let amount = 6;
        $(this).on('click', function(e) {
            e.preventDefault();
            var post_id = $(this).parents('.merchandise').data('post-id');
            var merchandise_id = $(this).parents('.merchandise').data('id');
            var commentList = $(this).parents('.merchandise').find('.comments-list');
            var loadCommentsBtn = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/market/load-comments',
                method: 'POST',
                data: {
                    post_id: post_id,
                    amount: amount,
                    merchandise_id: merchandise_id
                },
                success: function(response) {
                    commentList.html(response);
                    var delay = 50;

                    commentList.children().each(function (index) {
                        var element = $(this);

                        setTimeout(function () {
                            element.addClass('fade-left');
                        }, delay * index);
                    });
                    let responseJQuery = $(response);
                    if(amount < responseJQuery.data('max-amount')){
                        amount = amount + 3;
                    }else{
                        loadCommentsBtn.hide();
                    }
                },
                error: function(error) {
                    // Handle any errors that occur during the Ajax request
                    console.error('Error:', error);
                }
            });
        })
    })

    $(document).on('click', '.edit-comment', function(e) {
        e.preventDefault();
        let editBtn = $(this);
        let editForm = editBtn.parents('.comment-action').siblings('.edit-comment-form');
        let comment =  editBtn.parents('.comment-action').siblings('.comment-content');
        let commentActions = editBtn.parents('.comment-action');
        comment.hide();
        commentActions.hide();
        editForm.show();
    })
    $(document).on('click', '.cancel-edit', function(e) {
        e.preventDefault();
        let editForm = $(this).parents('.edit-comment-form');
        let comment = $(this).parents('.edit-comment-form').siblings('.comment-content');
        let commentActions = $(this).parents('.edit-comment-form').siblings('.comment-action');
        editForm.hide();
        comment.show();
        commentActions.show();
    })

    $(document).on('click', '.save-comment', function (e) {
        e.preventDefault();
        let editForm = $(this).parents('.edit-comment-form');
        editForm.submit();
    })

    $(document).on('keyup', '.edit-comment-field', function () {
        $(this).attr('value', $(this).val());
        console.log($(this).attr('value'));
    });

    $(document).on('submit', '.edit-comment-form', function (e) {
        e.preventDefault();
        let comment = $(this).children('.edit-comment-field').val();
        let commentId = $(this).parents('.comment-item').attr('id');
        let dbCommentId = parseInt(commentId.split('-')[1]);
        let thisForm = $(this);
        let commentContent = $(this).siblings('.comment-content');
        let commentAction = $(this).siblings('.comment-action');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: `/market/edit-comment/${dbCommentId}`,
            method: 'POST',
            data: {
                comment: comment
            },
            success: function(response) {
                thisForm.hide();
                commentContent.text(response);
                commentContent.show();
                commentAction.show();
            },
            error: function(error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    })

    $(document).on('click', '.delete-comment', function(e) {
        e.preventDefault();
        let thisComment = $(this).parents('.comment-item')
        let commentId = thisComment.attr('id');
        let dbCommentId = parseInt(commentId.split('-')[1]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/market/delete-comment',
            method: 'POST',
            data: {
                id: dbCommentId
            },
            success: function(response) {
                thisComment.hide();
                console.log('comment deleted');
            },
            error: function(error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    })

    //event comment
    $(document).on('submit', '.form-comment', function(e) {
        e.preventDefault();

        var merchandise_id = $(this).parents('.merchandise').data('id');
        var post_id = $(this).parents('.merchandise').data('post-id');
        var comment = $(this).find('.comment').val();
        var thisForm = $(this);
        // for comment method
        var commentsList = $(this).siblings('.comment-place').children('.comments-list');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/comment',
            method: 'POST',
            data: {
                comment: comment,
                merchandise_id: merchandise_id,
                post_id: post_id
            },
            success: function(response) {
                commentsList.append(response);

                //convert string html to jquery object
                let responseJQuery = $(response);
                //get comment id to pass to notification
                let commentId = responseJQuery.attr('id');
                let dbCommentId = parseInt(commentId.split('-')[1]);
                sendNotification(post_id, merchandise_id, comment, dbCommentId);
            },
            error: function(error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
                var message = $('<label></label>');
                message.addClass('error');
                message.text('You need to login to continue');
                thisForm.append(message);
            },
            complete: function() {
                thisForm[0].reset();
            }
        });
        //end comment method

    })

    function sendNotification(post_id, merchandise_id, comment, comment_id) {
        //for send comment notification method
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/notification/send',
            method: 'POST',
            data: {
                post_id: post_id,
                merchandise_id: merchandise_id,
                comment: comment,
                comment_id: comment_id
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                // Handle any errors that occur during the Ajax request
                console.error('Error:', error);
            }
        });
    }

    $(document).on('keyup', '.price', function () {
        var price = $(this).val().replace(/\./g, '');
        if (price === '' || isNaN(price)) {
            $(this).val(''); // Nếu rỗng hoặc không phải là số, không định dạng
        } else {
            $(this).val(parseFloat(price).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
        }
    });

    $(document).on('click', '.edit-post', function (e) {
        e.preventDefault();
        $(this).parents('.post').find('.post-title').hide();
        $(this).parents('.post').find('.post-content').hide();
        $(this).parents('.post').find('.edit-post-form').show();
    })
    $(document).on('click', '.cancel-edit-post', function(e) {
        e.preventDefault();
        $(this).parents('.post').find('.post-title').show();
        $(this).parents('.post').find('.post-content').show();
        $(this).parents('.post').find('.edit-post-form').hide();
    })

    //multi load tr
    function multiload() {
        $('tbody.multiload-right').each(function () {
            let delay = 50;
            $(this).children('tr').each(function (index) {
                var element = $(this);
        
                setTimeout(function () {
                    element.addClass('fade-left');
                }, delay * index);
            });
        })
    
        $('tbody.multiload-left').each(function () {
            let delay = 50;
            $(this).children('tr').each(function (index) {
                var element = $(this);
        
                setTimeout(function () {
                    element.addClass('fade-right');
                }, delay * index);
            });
        })
    }

    multiload();

    $(document).on('click', '.search-bar-mobile', function() {
        $('.search-form-mobile').slideToggle();
    })

    // see more/less on each post

    $('.limit-content').each(function () {
        
        var content = $(this);
        var button = $(this).siblings('.see-more-btn');
        
        var contentHeight = content.height();
        var lineHeight = parseInt(content.css('line-height'));
    
        var linesToShow = Math.floor(contentHeight / lineHeight);
        if (linesToShow >= 10) {
            button.show();
        } else {
            button.hide();
        }
    })
    $('.see-more-btn').each(function() {
        $(this).on('click', function() {
            $(this).siblings('.post-content').toggleClass('limit-content');
            $(this).siblings('.merchandise-description').toggleClass('limit-content');
            if ($(this).text() == $(this).data('more')) {
                $(this).text($(this).data('less'));
            } else {
                $(this).text($(this).data('more'));
            }
        })
    })

    $('.lang').on('click', function () {
        $('.lang-items').slideToggle();        
    })

    $('.filter-box').on('click', function() {
        $('.filter-options').slideToggle();
    })
});
