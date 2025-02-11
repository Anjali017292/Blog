<?php 
include('header.php'); 
include('config.php');
session_start(); 

if(isset($_SESSION['user_data'])){
    header("location:http://localhost/blog/admin/index.php");
    exit();
}
?>
<div class="container">
    <div class="row">
        <div class="col-xl-5 col-md-4 m-auto p-5 mt-5 bg-info">
            <form action="" method="post">
                <p class="text-center">Blog! Login Your Account</p>
            <div class="mb-3">
                <input type="email" name="email" placeholder="Email" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" placeholder="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <input type="submit" name="login_btn" class="btn btn-primary" value="login">
            </div>
            <?php
            if(isset($_SESSION['error'])){
                $error = $_SESSION['error'];
                echo "<p class='bg-danger p-2 text-white'>" . $error . "</p>";
                unset($_SESSION['error']);
            }
            ?>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['login_btn'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    
    $sql = "SELECT * FROM user WHERE email='{$email}' AND password='{$pass}'";
    $query = mysqli_query($config, $sql);
    $data = mysqli_num_rows($query);
    
    if($data){
        $result = mysqli_fetch_assoc($query);
        $user_data = array($result['user_id'], $result['username'], $result['role']);
        $_SESSION['user_data'] = $user_data;
        header('Location: admin/index.php');
        exit(); 
    } else {
        $_SESSION['error'] = "Invalid email/password";
        header('Location: login.php');
        exit(); 
    }
}

include('footer.php');
?>
