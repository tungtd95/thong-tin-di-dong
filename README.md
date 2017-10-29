# Bài tập lớn thông tin di động

-----------------------------Nội dung-------------------------------------
- client: C# (Mạnh thực hiện)
- server: Java EE (Tùng thực hiện) (cơ bản hoàn thành)
- database: MySQL (Mạnh, Tùng, Đạt thực hiện) (cơ bản hoàn thành)
- website: HTML, CSS, JavaScript (Phúc, Đạt, Hải bàn với nhau để làm) (hạn cuối 20/10)
- viết báo cáo và slide: 2 người làm ít việc nhất trong các nhiệm vụ trên sẽ làm (hạn cuối 30/10)

-----------------------------Chức năng------------------------------------
- client: tạo dữ liệu random để gửi về server
- server: + nhận dữ liệu người dùng tải lên
          + xác nhận tài khoản
          + truy vấn thông tin
- database: lưu thông tin về admin, người dùng và dữ liệu từ module SIM
- website: + đăng nhập, đăng ký tài khoản
           + xem thông tin bằng biểu đồ trực quan

-----------------------------Cách setup server----------------------------
- Tải Java SE Development Kit 8u144: http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html
- Tải MySQL: https://dev.mysql.com/get/Downloads/MySQLInstaller/mysql-installer-community-5.7.19.0.msi
- Tải Netbeans (tải bản all): https://netbeans.org/downloads/
- Tải source code: https://github.com/tungtd95/thong-tin-di-dong/archive/master.zip
- Giải nén source code sau đó dùng Netbean để mở thư mục project "server"
- Tạo cơ sở dữ liệu (đã có model trong file vừa tải) và thay đổi link kết nối đến database trong source code (file DBHelper.java)
- Chạy chương trình vừa mở
