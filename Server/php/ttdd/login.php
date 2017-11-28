<?php 
    session_start();

    if (isset($_SESSION["user"])) {
      header("Location: home.php");
      exit();
    }

    if (isset($_POST["uname"]) && isset($_POST["psw"])) {
      include_once "DBC.php";
      $user = $_POST["uname"];
      $password = $_POST["psw"];
      $query = "SELECT * FROM `thong-tin-di-dong`.user where user_email = '$user';";
      $result = mysqli_query($conn, $query);
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          if($password == $row["user_password"]) {
            $_SESSION["user"] = $user;
            header("Location: home.php");
            exit();
          }
        }
      }
    }
?>

<!DOCTYPE html>
<html>
<style>
  form {
    border: 3px solid #f1f1f1;
  }
  input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }
  button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
  }
  button:hover {
    opacity: 0.8;
  }
  .cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
  }
  .imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
  }
  img.avatar {
    width: 10%;
    border-radius: 50%;
  }
  .container {
    padding: 16px;
  }
  span.psw {
    float: right;
    padding-top: 16px;
  }
  @media screen and (max-width: 300px) {
    span.psw {
      display: block;
      float: none;
    }
    .cancelbtn {
      width: 100%;
    }
  }
  .login {
    width: 1200px;
    margin: 0 auto;
  }
</style>
<body>
  <div class="login"><div style="width: 20%;float: left;color: blue;font-weight: bold;text-align: center;">
    <h2> ĐĂNG NHẬP </h2>
  </div>
    <form action="login.php" method="post">
      <div class="imgcontainer">
        <img src="image/icon_user_top.png" alt="Avatar" class="avatar">
      </div>
      <div class="container">
        <label style="width: 100%;float: left;color: blue;font-weight: bold;"><b> TÊN </b></label>
        <input style="width: 95%;" type="text" placeholder="TÊN" name="uname" required>
        <label style="width: 100%;float: left;color: blue;font-weight: bold;"><b>MẬT KHẨU</b></label>
        <input style="width: 95%" type="password" placeholder="MẬT KHẨU" name="psw" required>
        <button style="width: 95%" type="submit"> ĐĂNG NHẬP </button><br>
        <input style="float: left;" type="checkbox" checked="checked"> Remember me
      </div>
      <div class="container" style="background-color:#f1f1f1">
      <a href="dangki.php"><button type="button" class="cancelbtn">Đăng Ký</button></a>
      </div>
  </div>

</form>
</body>
</html>