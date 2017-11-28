
<?php 
    session_start();
    if (isset($_SESSION["user"])) {
        header("Location: home.php");
        exit();
    }
    // $_SESSION
    $error_message = null;
    $successfull_message = null;

    if(isset($_POST["email"]) && !empty($_POST["password"])){
        include_once "DBC.php";

        $email = $_POST["email"]; 
        $name = $_POST["name"]; 
        $password = $_POST["password"]; 
        $password_again = $_POST["password_again"];


        $query = "SELECT * FROM `thong-tin-di-dong`.`user` WHERE `user_email` = '$email';";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0){
            if ($password_again == $password){
                $sql = "INSERT INTO `thong-tin-di-dong`.`user` (`user_email`, `user_password`, `user_name`) VALUES ('$email', '$password', '$name');";
                $ketqua = mysqli_query($conn, $sql);

                if (!empty($ketqua) ){
                    $successfull_message = "You have registered successfully!";
                }else{
                    $error_message = "Problem in registration. Try Again!"; 
                }
            }else $error_message = "Password does not match ";
        }else {
            $error_message = "Your email is used ... ";
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/dangki.css">
    <title>Đăng kí</title>
</head>
<style>
   
</style>
<body>
    
    <div class="dangki">
        <div style="width: 100%;float: left;color: blue;font-weight: bold;text-align: center;">
        <h2> ĐĂNG KÍ </h2>
        </div>
        <form action="dangki.php" method="post">
            <div class="container">
                <label style="width: 100%;float: left;color: blue;font-weight: bold;"><b> EMAL </b></label><br>
                <input style="width: 95%" type="text" placeholder="EMAIL" name="email" required><br>
                <label style="width: 100%;float: left;color: blue;font-weight: bold;"><b> TÊN NGƯỜI DÙNG </b></label><br>
                <input style="width: 95%"type="text" placeholder="TÊN" name="name" required><br>
                <label style="width: 100%;float: left;color: blue;font-weight: bold;"><b>MẬT KHẨU</b></label><br>
                <input style="width: 95%"type="password" placeholder="MẬT KHẨU" name="password" required><br>
                <label style="width: 100%;float: left;color: blue;font-weight: bold;"><b> NHẬP LẠI MẬT KHẨU</b></label><br>
                <input style="width: 95%"type="password" placeholder="NHẬP LẠI MẬT KHẨU" name="password_again" required><br>
                <button style="width: 95%"type="submit"> ĐĂNG KÝ </button>
            </div>
            <div class="container" style="background-color:#f1f1f1">
            <a href="login.php" style="text-decoration: none; color: white;"> <button type="button" class="cancelbtn">Log in</button></a>

            </div>
            
            <p style="color: red; font-size: 18px; font-style: bold;"><?php if($error_message != null)  echo $error_message; ?></p>

            <p style="color: green; font-size: 18px; font-style: bold;"><?php if($successfull_message != null)  echo $successfull_message; ?></p>
            
    </div>

    <script type="text/javascript">
                
    </script>

</form>
</body>
</html>