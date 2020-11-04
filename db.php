

<?php
  $conn =  mysqli_connect("localhost","root","root","blog");
  if(! $conn){
      echo  "mysqli_connect_error";
      exit;

  }
  $query = "SELECT * FROM users";

   $result = mysqli_query($conn,$query);

   while($row = mysqli_fetch_assoc($result)){
       echo "id:" .$row['id']."<br/>";
       echo "Name:" .$row['name']."<br/>";
       echo "Email:" .$row['email']."<br/>";
   }

   mysqli_free_result($result);
   mysqli_close($conn);



?>

