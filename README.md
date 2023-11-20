## My Project Log

## Các chức năng
1. multi-authentication: admin và user đăng nhập riêng biệt
2. user có thể  upload, sửa và xóa mặt hàng cần bán
3. user có thể chỉnh sửa thông tin cá nhân bao gồm: avatar và các thông tin trong bảng user
4. user có thể comment trên mặt hàng đang bán trên market. Thông báo sẽ được gửi (realtime) cho những user khác cũng đang comment trên post đó.
5. thông báo redirect đến comment tương ứng.
6. User có thể  vào trang cá nhân của user khác để  xem thông tin và các posts của user đó.
7. User có thể thêm/sửa/ xóa post của mình. Các posts sẽ được hiển thị trên newsfeed để  các users khác có thể  xem.
8. Tích hợp tinymce (text editor)
9. Admin có thể  xóa hoặc ban tài khoản của Users. User bị banned lập tức bị logout và không thể login vào account được nữa.
## Initial project
1. composer create-project laravel/laravel my-project
2. create db > edit .env > migrate
3. make auth
composer require laravel/ui
php artisan ui vue --auth
php artisan migrate
4. npm i > npm run dev > npm run dev
## Integrate multi-auth
1. tạo bảng admin:
- php artisan make:migration create_admins_table --create=admins
- php artisan migrate
2. Thêm code vào database\seeders\DatabaseSeeder.php để tạo seed
- php artisan db:seed
3. Make models admin + user
4. Guard
- config\auth.php > guards
- config\auth.php > providers
5. app/Providers/RouteServiceProvider.php > boot()
6. chỉnh sửa Routes, Controller và view
## install jquery
1. npm install jquery --save-dev
2. resource/js/bootstrap.js:
- window.$ = window.jQuery = require('jquery');
3. ensure that resource/js/bootstrap.js was attached in app.js
## Crop image using boostrap
- xem tại MyStoreController function save() và custom.js > //crop image

## tinymce editor - wysiwyg
1. add CDN vào header của layout: 
- <script src="https://cdn.tiny.cloud/1/q50oc5verflqnyvf6bi6py4cgqivi56zk5w6dqe2bon0wsrb/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
- chú ý: trong đoạn script trên chứa user api key của tinymce. đăng nhập vào trang chủ và lấy key trong my-account. sau đó set my-domain cho project đang chạy
- <script src="{{ asset('js/tinymce-config.js') }}"></script>
2. trong file tinymce-config: thêm các settings cho text editor.
- tham khảo các settings tại: https://www.tiny.cloud/blog/tinymce-toolbar/
- xây dựng upload image trong tinymce tại hàm file_picker_callback trong file tinymce-config.js
## Tài liệu tham khảo:
1. https://viblo.asia/p/multiple-authenticate-trong-laravel-8-oOVlYjqQ58W
2. https://github.com/PikeTheFreelancer/Multiple-Auth/tree/master
3. https://viblo.asia/p/trien-khai-repository-trong-laravel-m68Z0x6MZkG
4. https://www.tiny.cloud/blog/tinymce-toolbar/