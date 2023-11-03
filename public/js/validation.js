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
});