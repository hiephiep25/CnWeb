# Blog 

# Các chức năng:
## Đăng nhập: 
- có thể đăng kí, đăng nhập bằng tài khoản đã đăng ký
- đăng nhập bằng gmail
## Change Profile: 
- đổi avatar, username, email
- change password
## CRUD My blog: 
- Blog chấp nhận text, hình ảnh, âm thanh, sử dụng ck-editor
- Pagination
## Dashboard:
- Xem blogs của mọi người, hiển thị tác giả của blog, pagination
- Xem chi tiết blog
- Khi xem chi tiết blog có thể comment vào blog
- Xóa comment (bởi người tạo comment hoặc người tạo blog)

# Cài đặt 
## Version:
- node: 18.16.0
- php: 8.1
- composer: 2.5.1
- laravel: 9.52.10

## Chạy code:
- clone src code về máy
- khởi động xampp, start apache và mysql
- mở src code
- composer install
- npm install
- cp .env.example .env (sau đó cấu hình lại file .env)
- php artisan key:generate
- php artisan migrate để tạo DB
- npm run dev
- php artisan serve để khởi động project trên trình duyệt
