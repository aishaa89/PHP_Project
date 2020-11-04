<?php

$error_arr =array();
if(!(isset($_POST['username']) && !empty($_POST['username']))){
    $error_arr[] = "username";
}
if(!(isset($_POST['mail']) && filter_input(INPUT_POST,'mail',FILTER_VALIDATE_EMAIL))){
    $error_arr[] = "mail";
}

if(!(isset($_POST['password']) && strlen($_POST['password'])>5)){
    $error_arr[] = "password";
}

if($error_arr){

    header("Location: index.php?error_arr=" .implode(",",$error_arr));
    exit;
}


$conn =  mysqli_connect("localhost","root","root","blog");
if(! $conn){
    echo  "mysqli_connect_error";
    exit;

}

  // escape any special character to avoid  sql injection 
  $name = mysqli_escape_string($conn,$_POST['username']);
  $email = mysqli_escape_string($conn,$_POST['mail']);
  $pass = mysqli_escape_string($conn,$_POST['password']);

  $query = "INSERT INTO users (name,email,password) VALUES ('".$name."' , '" .$email. "' , '" .$pass. "')";

  if(mysqli_query($conn,$query)){
      echo "success saving";
    header("Location: login.php");
  }
  else{
      echo mysqli_error($conn);


  }


      mysqli_close($conn);

?>