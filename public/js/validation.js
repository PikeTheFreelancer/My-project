$(document).ready(function() {
    //form comment
    $(".form-comment").each(function() {
        $(this).validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "comment": {
                    required: true
                }
            }
        });
    })

    //form edit comment
    $('.edit-comment-form').each(function () {
        $(this).validate({
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            rules: {
                "comment": {
                    required: true
                }
            }
        });
    });

    //form add new merchandise
    $('#add-merchandise').validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "price": {
                required: true,
            },
            "name": {
                required: true,
            },
            "image": {
                required: true,
            }
        },
        messages: {
            "price": {
                required: "Please enter price.",
            },
            "name": {
                required: "Please enter merchandise name."
            },
            "image": {
                required: "Please provide merchandise image."
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "image") {
                error.insertAfter(".image-uploader");
            } else {
                error.insertAfter(element);
            }
        }
    })

    //form edit merchandise
    $('.edit-merchandise').validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "price": {
                required: true,
            },
            "name": {
                required: true,
            }
        },
        messages: {
            "price": {
                required: "Please enter price.",
            },
            "name": {
                required: "Please enter merchandise name."
            }
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "image") {
                error.insertAfter(".image-uploader");
            } else {
                error.insertAfter(element);
            }
        }
    })

    $('.add-post').validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "title": {
                required: true,
            },
            "content": {
                required: true,
            }
        },
    })
    $('.add-post').submit(function(event) {
        // Ngăn chặn việc submit mặc định của form
        event.preventDefault();
    
        // Kiểm tra và xác thực nội dung từ trình soạn thảo TinyMCE
        var content = tinymce.get('mce_0').getContent();
        if (content.trim() === '') {
            console.log(content);
            // Xử lý khi nội dung không hợp lệ
            $(this).find('.error-tinymce').text('This field is required.').show();
            $(this).find('.tox-tinymce').css('border', 'solid 1px #ec1818');
        } else {
            // Nếu dữ liệu hợp lệ, tiến hành submit form
            this.submit();
        }
    });
});