
<?php
  $errors = array();
if(isset($_GET['$error_arr'])){
  $errors= explode("," , $_GET['$error_arr']);
}
?>


<html>
<head>
  <link rel="stylesheet" href="index.css"/>
</head>
<body>

<div id="login-box">
  <div class="left">
    <h1>Sign up</h1>
    <form method='post' action='process.php'>
    
    <input type="text" id="username" name="username" placeholder="Username" />
    <?php if(in_array("username",$errors)) echo "*enter your name";?><br/>
    <input type="text" name="mail" placeholder="E-mail" />
    <?php if(in_array("email",$errors))echo "enter valid email";?><br/>
    <input type="password" name="password" placeholder="Password" />
    <?php if(in_array("password",$errors))echo "enter password<6";?><br/>
    
    
    <input type="submit" name="signup_submit" value="Sign me up" />
      </form>
  </div>

</div>
</body>
</html>