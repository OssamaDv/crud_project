<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src=”https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js” integrity=”sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl” crossorigin=”anonymous”></script>

</head>
<body>
<?php require_once 'process.php'; ?> 

<?php
if(isset($_SESSION['message'])): ?> 

<div class="alert alert-<?=$_SESSION['msg_type']?>">
<?php 
echo $_SESSION['message'];
unset($_SESSION['message']);
?>
</div>
<?php endif ?>
<div class="container">
<?php 
$mysqli = new mysqli('localhost','root','','crud') or die(mysqli_error($mysqli));
$result =$mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
//pre_r($result);
?>
<div class="row justify-content-center">
    <table class="table">
        <thead>
            <tr>
                <th>name</th>
                <th>location</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
<?php
while ($row=$result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td>
                <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
<?php endwhile ;?>        
    </table>
</div>
<?php
function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
?>
 <div class="row justify-content-center">
 <form action='process.php' method="POST">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div class="form-group">  
          <label>Name</label>  
          <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="enter your name">
      </div>
      <div class="form-group">      
          <label>Location</label>  
          <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="enter your location">
      </div>
      <div class="form-group">  
      <?php 
      if($update == true) :
      ?>
        <button type="submit" class="btn btn-info" name="update">update</button>
      <?php else: ?>  
        <button type="submit" class="btn btn-primary" name="save">Save</button>
      <?php endif; ?>  
      </div>  
    </form>
 </div>        
</body>
</html>