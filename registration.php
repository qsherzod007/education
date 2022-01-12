<?php
ob_start();
include "header.php";
include "db.php";
//include "left.php";

$errors = [];
if (isset($_POST['username']) && !empty($_POST['username']) &&
    isset($_POST['password']) && !empty($_POST['password'])) {
    $user = "select * from user where username = :username";
    $state = $conn->prepare($user);
    $state->bindParam(":username", $_POST['username']);
    $state->execute();
    $result = $state->fetchAll(PDO::FETCH_ASSOC);
//var_dump($result);die();
    if ($result) {
        $errors['user_exists'] = "Bunday user bor";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $username = trim($username);
        $username = htmlspecialchars($username);
        $username = stripcslashes($username);
        $password = md5($password);
        $sql = "insert into user (username, password) value(:username, :password)";
        $state = $conn->prepare($sql);
        $state->bindParam(':username', $username);
        $state->bindParam(':password', $password);
        if ($state->execute()) {
            header('Location: login.php');
            exit();
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

    <h2 class="login-header">Registration</h2>

    <form class="login-container" method="post">
        <p><input name="username" type="text" placeholder="Username"></p>
        <h5><?php echo $errors['user_exists']?? '';?></h5>
        <p><input name="password" type="password" placeholder="Password"></p>
        <p><input name="repassword" type="password" placeholder="Repassword"></p>
        <p><input type="submit" value="Registration"></p>
    </form>
</div>
</html>