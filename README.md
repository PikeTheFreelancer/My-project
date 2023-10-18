## My Project Log

## Các chức năng
1. multi-authentication: admin và user đăng nhập riêng biệt
2. user có thể  upload, sửa và xóa mặt hàng cần bán
3. user có thể chỉnh sửa thông tin cá nhân bao gồm: avatar và các thông tin trong bảng user
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

## Crop image using boostrap
- xem tại MyStoreController function save() và custom.js > //crop image

## Tài liệu tham khảo:
1. https://viblo.asia/p/multiple-authenticate-trong-laravel-8-oOVlYjqQ58W
2. https://github.com/PikeTheFreelancer/Multiple-Auth/tree/master