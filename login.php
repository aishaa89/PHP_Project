<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $conn =  mysqli_connect("localhost","root","root","blog");
        if(! $conn){
            echo  mysqli_connect_error();
            exit;

        }



        $email = mysqli_escape_string($conn,$_POST['mail']);
        $pass = mysqli_escape_string($conn,$_POST['password']);



        $query = "SELECT * FROM users WHERE email='".$email."' and password='".$pass."' LIMIT 1 ";

        $result = mysqli_query($conn,$query);
        if($row = mysqli_fetch_assoc( $result)){
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            header("Location: admin/list.php");
            exit;
        }else{
            $error="Invali email or Password";
        }
        mysqli_free_result($result);
        mysqli_close($conn);
    }


?>

<html>
<head> 
<title> Login </title>
<link rel="stylesheet" href="index.css"/>
</head>

<body>
 
<div id="login-box">
  <div class="left">
    <h1>Login</h1>
    <?php if(isset($error)) echo $error; ?>
        <form method="post">
        <input type="text" name="mail" placeholder="E-mail" value = "<?= (isset($_POST['email'])) ? $_POST['email']:''  ?>" />

        <input type="password" name="password" placeholder="Password" />
        <input type="submit" name="submit" value="Login" />

        <form>
</div>
</div>
</body>



<html>