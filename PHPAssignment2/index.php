<html>
   <head>
     <title>PHP Assignment2</title>
       <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
       <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
       <script src="js/bootstrap.min.js"></script>
   </head>


   <body>
   <?php require_once 'process.php';?>

   <?php
   //check if the session message has been set
   if(isset($_SESSION['message'])):
   ?>

   //alternate the alert type between success and danger in bootstrap classes.
   <div class="alert alert-<?=$_SESSION['msg_type']?>">
       <?php
       echo $_SESSION['message'];
       unset($_SESSION['message']);
       ?>
   </div>

   <?php
   endif;
   ?>

   //Style the whole form
   <div class="container">
   <?php
   $mysqli = new mysqli('localhost','root','mypass123','crud') or die(mysqli_error($mysqli));
   //pull data from database
   $result = $mysqli ->query("SELECT*FROM data") or die($mysqli->error);

   //print the $result variable with the pre_r function;
   //pre_r($result);

   //Need to fetch data from SQL;
   //Make a loop to make it keep fetching until there are no more records.

   //pre_r($result-> fetch_assoc());
   //output display
   ?>

   <div class="row justify-content-center">
       <table class="table">
           <thead>
           <tr>
               <th>Name</th>
               <th>Location</th>
               <th colspan="2">Action</th>
           </tr>
           </thead>

           <?php
           while($row = $result->fetch_assoc()):?>
           <tr>
               <td><?php echo $row['name']; ?></td>
               <td><?php echo $row['location']; ?></td>
               <td>
                   <a href="index.php?edit=<?php echo $row['id']; ?>"
                      class="btn btn-info">Edit</a>
                   <a href="process.php?delete=<?php echo $row['id']; ?>"
                      class="btn btn-danger">Delete</a>
               </td>
           </tr>

       </table>
   </div>
   <?php

   function pre_r($array){
       echo '<pre>';
       print_r($array);
       echo'</pre>';
   }
   ?>
   <div class="row justify-content-center">
   <form action="process.php" method = "POST">

       //assignemnt 2 deliverable re: hidden input fields for update function
       <input type="hidden" name="id" value="<?php echo $id; ?>"

       <div class="form-group">
       <label>Name</label>
       <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter your name">
       </div>
       <div class="form-group">
       <label>Location</label>
       <input type="text" name="location" value="<?php echo $location; ?>" placeholder="Enter your location">
       </div>
       <div class="form-group">

           //When edit button is clicked, switch the save button with UPDATE button.
           <?php
           if($update == true):
           ?>
           <button type="submit" class="btn btn-info" name="update">Update</button>
           <?php
           else:
           ?>

       <button type="submit" class="btn btn-primary" name="save">Save</button>
           <?php
           endif;
           ?>

       </div>
   </form>
   </div>
   </div>
   </body>

//followed guide at https://www.youtube.com/watch?v=3xRMUDC74Cw to supplement course knowledge to create
//update button and hidden input fields.
<?php endwhile;