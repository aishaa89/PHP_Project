<?php

$error_arr =array();
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
    $conn =  mysqli_connect("localhost","root","root","blog");

    if(!$conn){
        echo  "mysqli_connect_error";
        exit;
    }else{
   

      $name = mysqli_escape_string($conn,$_POST['username']);
      $email = mysqli_escape_string($conn,$_POST['email']);
      $pass = mysqli_escape_string($conn,$_POST['password']);
      $admi = (isset($_POST['admin'])) ? 1 : 0;



      $filename = $_FILES['myfile']['name'];
      $destination = '/uploads' . $filename;
      $extension = pathinfo($filename, PATHINFO_EXTENSION);
      $file = $_FILES['myfile']['tmp_name'];
      $size = $_FILES['myfile']['size'];
  
     if ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
          echo "File too large!";
      } else {
          if (move_uploaded_file($file, $destination)) {
                  echo "File uploaded successfully";   
          } else {
              echo "Failed to upload file.";
          }
      }




        $query = "INSERT INTO users (name,email,password,admin,img) VALUES ('".$name."' , '" .$email. "' , '" .$pass. "' , '" .$admi. "' , '".$filename."')";
 

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
    <form method ="POST" enctype="multipart/form-data"  >
    
    <input type="text" name="username" id="username" />
    <?php if(in_array("username",$error_arr)) echo "*enter your name";?><br/>
    <input type="text" name="email" id="email"   />
    <?php if(in_array("email",$error_arr))echo "enter valid email";?><br/>
    <input type="password" name="password" id="password" placeholder="Password" />
    <?php if(in_array("password",$error_arr))echo "enter password < 6";?><br/>
    
    <input type="checkbox" name="admin" <?= (isset($_POST['admin'])) ? 'checked' : '' ?>  />admin
    <br/>
    <input type="file" name="file"> <br>
    <input type="submit" name="submit" value="ADD" />
      </form>
  </div>

</div>
</body>
</html>