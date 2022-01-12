<?php
ob_start();
include "header.php";
include "db.php";
//include "left.php";
session_start();

$errors = [];
if (isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['password']) && !empty($_POST['password'])) {
    $user = "select * from user where username = :username";
    $state = $conn->prepare($user);
    $state->bindParam(":username", $_POST['username']);
    $state->execute();
    $result = $state->fetch(PDO::FETCH_ASSOC);
//var_dump($result[0]['password']);die();
    if (!$result) {
        $errors['user_exists'] = "Bunday user yo`q";
    } else {
        if ($result['password'] == md5($_POST['password'])){
            $_SESSION['logged'] = true;
            $_SESSION['username'] = $_POST['username'];
            header("Location: index.php");
            exit();
        }else{
            $errors['user_exists'] = "Bunday user yo`q";
        }
    }
}

?>
<html>
<header>
    <style>
        <?php include "css/registration.css"?>
    </style>
</header>

<div class="login">
    <?php
    if (count($errors) > 0){
        echo "<pre>";
        print_r($errors);
    }
    ?>
    <div class="login-triangle"></div>

    <h2 class="login-header">Login</h2>

    <form class="login-container" method="post">
        <p><input name="username" type="text" placeholder="Username"></p>
        <h5><?php echo $errors['user_exists']?? '';?></h5>
        <p><input name="password" type="password" placeholder="Password"></p>
        <p><input type="submit" value="Login"></p>
    </form>
</div>
</html>