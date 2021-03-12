<?php

include_once "../conf.php";

$sql = "SELECT id, fname, lname, email, Message FROM contact";

$result = $conn->query($sql);

if (!($result->num_rows > 0)) {
die('select query failed' . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
<?php
    
    include_once "../conf.php";

    if(isset($_POST['update'])){

      $id = $_POST['id'];
      $fname = $_POST['fname'];
      $lname = $_POST['lname'];
      $email = $_POST['email'];
      $message = $_POST['Message'];

      $query = "UPDATE contact SET fname='$fname', lname='$lname', email='$email', Message='$message' WHERE id='$id' ";
      $query_run = mysqli_query($conn, $query);

      if($query_run){
        echo '<div class="alert alert-success" role="alert">
        Updated Success
      </div>';
      }else{
        echo '<div class="alert alert-danger" role="alert">
        Error while updating
      </div>';
      }

    }
    
?>
    <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Email Address</th>
            <th scope="col">Message</th>
            <th scope="col">Edit</th>
          </tr>
        </thead>
        <tbody>
<?php


while ($row = $result->fetch_assoc())
		{
			echo '<tr>
				          	<td>'.$row['id'].'</td>
                    <td>'.$row['fname'].'</td>
                    <td>'.$row['lname'].'</td>
                    <td>'.$row['email'].'</td>
                    <td>'.$row['Message'].'</td>
                    <td> <button class="btn btn-primary etitbtn"> <i class="fa fa-edit" style="font-size: 25px;"></i> </button>
				</tr>';
			
		}?>

        </tbody>
      </table>
      <!-- Button trigger modal -->
<!-- Modal -->
<form action="index.php" method="POST">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="id">
        <input type="text" name="fname" id="fname" class="form-control">  <br>
        <input type="text" name="lname" id="lname" class="form-control"><br>
        <input type="email" name="email" id="email" class="form-control"><br>
        <textarea name="Message" id="Message" cols="30" rows="10" style="resize: none; width: 100%;" ></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="update" name="update" id="update" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>
<!------------------->
   <script>
     $(document).ready(function (){
       $('.etitbtn').on('click', function(){
       $('#exampleModal').modal('show');
      $tr = $(this).closest('tr');

      var data = $tr.children("td").map(function(){
        return $(this).text();
      }).get();
       console.log(data);

       $('#id').val(data[0]);
       $('#fname').val(data[1]);
       $('#lname').val(data[2]);
       $('#email').val(data[3]);
       $('#Message').val(data[4]);
       })
     })
   </script>

</body>
</html>