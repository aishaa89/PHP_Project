<?php

  session_start();
  if(isset($_SESSION['id'])){
      echo '<p style="float:right;"> welcome '.$_SESSION['email'].' <a style="color:red;" href="../logout.php">Logout</a></p>';
  }else{
      header("Location:../index.php");
      exit;
  }




    //connect to mySQL
  $conn =  mysqli_connect("localhost","root","root","blog");
  if(! $conn){
      echo  "mysqli_connect_error";
      exit;

  }
  $query = "SELECT * FROM users";

  if(isset($_GET['search'])){
      $search = mysqli_escape_string($conn ,$_GET['search']);
      $query.= " WHERE users . name LIKE '%".$search."%' OR users.email LIKE '%".$search."%'";
  }

   $result = mysqli_query($conn,$query);





?>
<html>
            <head>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                            <head>
<body>
   <h1 style="text-align:center"> List of users </h1>
     
      
          <form method="GET">

              <input type="text" name="search" placeholder="enter yor name or mail" />
              <input type="submit" value="search"/>
          </form>


      <table class="table table-hover">
        <thead>

            <tr class="table-primary">
                <th>ID</th>
                <th>name</th>
                <th>email</th>
                <th>admin</th>
                <th>action</th>
            </tr>
         </thead>

            <tbody>
                    <?php
                    while($row = mysqli_fetch_assoc($result)){
                    ?>

                    <tr>
                        <td><?= $row['id']?></td>
                        <td><?= $row['name']?></td>
                        <td><?= $row['email']?></td>
                        <td><?= ($row['admin']) ? 'yes': 'No'?></td>
                        <td><a href="edit.php?id=<?= $row['id']?>">Edit</a>| <a href="delete.php?id=<?= $row['id']?>">delete</a> </td>
                    </tr>

                    <?php
                    }

                    ?>

        </tbody>

        <tfoot>
                <tr>
                <td colspan="2" style="text-align:center">number of users:<?= mysqli_num_rows($result) ?></td>
                <td colspan="3" style="text-align:center"><a href="add.php">add user</a></td>

                </tr>

        </tfoot>
</table>
     
</body>
</html>

<?php
 mysqli_free_result($result);
 mysqli_close($conn);

?>