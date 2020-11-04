<?php

$error_arr =array();

$conn =  mysqli_connect("localhost","root","root","blog");

if(!$conn){
    echo  "mysqli_connect_error";
    exit;
}


$id = filter_input(INPUT_GET, 'id' , FILTER_SANITIZE_NUMBER_INT);
$select = "SELECT * FROM users WHERE users.id =".$id." LIMIT 1";
$result = mysqli_query($conn,$select);
$row = mysqli_fetch_assoc($result);



if($_SERVER['REQUEST_METHOD'] == 'POST'){
if(!(isset($_POST['username']) && !empty($_POST['username']))){
    $error_arr[] = "username";
}
if(!(isset($_POST['email']) && filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL))){
    $error_arr[] = "email";
}

if(!(isset($_POST['password']) && strlen($_POST['password'])>5)){
    $error_arr[] = "password";
}


if(!$error_arr){

    $id = filter_input(INPUT_POST,'id', FILTER_SANITIZE_NUMBER_INT);
      $name = mysqli_escape_string($conn,$_POST['username']);
      $email = mysqli_escape_string($conn,$_POST['email']);
      $pass = mysqli_escape_string($conn,$_POST['password']);
      $admi = (isset($_POST['admin'])) ? 1 : 0;

        $query = "UPDATE users set name='".$name."', email ='".$email."'
        ,password ='".$pass."' ,admin = '".$admi."'  Where users.id='".$id."' ";
        
 

          if(mysqli_query($conn,$query)){
            header("Location: list.php");
            exit;
          }
          else{
            echo mysqli_error($conn);


          }

              }


    
    mysqli_close($conn);

}


?>


<html>
<head>
  <link rel="stylesheet" href="../index.css"/>
</head>
<body>

<div id="login-box">
  <div class="left">
    <h1> admin:: add user</h1>
    <form method ="POST"  >
    <input type="hidden" name="id" id="id" value = "<?= (isset($row['id'])) ? $row['id']:''  ?>" />

    <input type="text" name="username" id="username" value = "<?= (isset($row['name'])) ? $row['name']:''  ?>" />
    <?php if(in_array("username",$error_arr)) echo "*enter your name";?><br/>
    <input type="text" name="email" id="email" value = "<?= (isset($row['email'])) ? $row['email']:''  ?>"   />
    <?php if(in_array("email",$error_arr))echo "enter valid email";?><br/>
    <input type="password" name="password" id="password" placeholder="Password" />
    <?php if(in_array("password",$error_arr))echo "enter password < 6";?><br/>
    
    <input type="checkbox" name="admin" <?= ($row['admin']) ? 'checked' : '' ?>  />admin
    <br/>
    <input type="submit" name="submit" value="Edit User" />
      </form>
  </div>

</div>
</body>
</html>