tinymce.init({
    selector: '.tinymce-editor',
    plugins: 'image code table autoresize link media',
    toolbar: 'undo redo | link | image media | alignleft aligncenter alignright alignjustify | code',
    media_dimensions: false,
    image_title: true,
    file_picker_types: 'image',
    
    file_picker_callback: function (cb, value, meta) {
      var input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');

      input.onchange = function () {
        var file = this.files[0];
        var formData = new FormData();
        formData.append('file', file);
        console.log(file.name);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/upload_handler');
        xhr.onload = function () {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response && response.location) {
                    cb(response.location, { title: file.name, height: 'auto' });
                } else {
                    console.error('Invalid response: ', response);
                }
            } else {
                console.error('Error: ', xhr.statusText);
            }
        };
        xhr.onerror = function () {
            console.error('Error during upload');
        };

        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

        xhr.send(formData);
    };
  
      input.click();
    },
});