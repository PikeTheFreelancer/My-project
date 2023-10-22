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

    //notification dropdown
    $(document).on('click', '.notification-box', function(e) {
        e.preventDefault();
        $('.menu-notification').slideToggle();
        $('.new-notification').addClass('hidden');
    })
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.notification-box').length) {
            $('.menu-notification').slideUp();
        }
    })

    $(document).on('click', '.noti-item', function(e) {
        window.location.hash = '#' + $(this).attr('href').split('#')[1];
        var noti_id = $(this).data('id');
        var this_noti = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: 'notification/mark-as-read',
            method: 'POST',
            data: { noti_id: noti_id }, // Send the ID as data
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
        location.reload();
    })

    // $(window).on('hashchange', function() {
    // });
    if (window.location.hash) {
        console.log('run here');
        var targetElement = $(window.location.hash);
        if (targetElement.length > 0) {
            $('html, body').animate({
                scrollTop: targetElement.offset().top
            }, 1000);
        }

        targetElement.addClass('highlight-background');

        setTimeout(function() {
            targetElement.removeClass('highlight-background');
        }, 5000);
    }
});