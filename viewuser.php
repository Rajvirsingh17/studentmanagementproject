<!--Session code-->
<?php
session_start();
include "database.php";?>
<?php
if (!isset($_SESSION['id'])) {         
  header('location: login.php');
}
?>
<!--logout code-->
<?php
if (isset($_POST['signout'])) {
    session_destroy(); 
    echo '<script>alert("Session Ended")</script>';           
    header('refresh:0','location: login.php');
  }
  ?>



<!--selection of data-->
<?php
error_reporting(E_ERROR | E_PARSE);
include "database.php";
if(isset($_POST['search'])){
try{
$searchvalue=$_POST["searchvalue"];
$sql= "SELECT * from student_details where CONCAT(`id`, `student_name`, `father_name`, `email`, `phone`, `s_address`)
like '%$searchvalue%'";
$q=$conn->prepare($sql);
$q-> execute();
$result=$q->fetchAll();
}
catch(PDOException $e){
  echo "Could not show";
}}
else{
    $sql= 'SELECT * from student_details';
    $q=$conn->prepare($sql);
    $q-> execute();
    $result=$q->fetchAll();
}   
?>



<!--html code-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboardstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>

  <!--Navbar container-->
    <div class="container-fluid" id="navbar-container">
        
    <nav class="dashboard-nav">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="adduser.php" id="add-user-btn">Add User</a></li>
            <li><a href="viewuser.php" id="view-user-btn">View User</a></li>
            <li>
                <a href="#">More</a>
                   
            </li>
            <form class="logout" id="logout" method="POST">
            <li><button type="submit" name="signout" id="signout" class="signout-btn">Log Out</button></li></form>
        </ul>
    </nav>
</div>



<!--Show User-->
<div id="show_user" class="container">
<h1 class="table-heading">Students</h1>
<form method="POST" id="searchbar">
    <input type="search" name="searchvalue" placeholder="Search">
    <button input type="submit" name="search" id="search"><i class="fa fa-search"></i></button>
</form>
<table class="table table-bordered table-condensed">
<?php
if($result){?>
  <thead>
    <tr>
      <th>Name</th>
      <th>Father's Name</th>
      <th>Gender</th>
      <th>Email Address</th>
      <th>Mobile Number</th>
      <th>Address</th>
      <th>Grade 10</th>
      <th>Grade 12</th>
      <th>Course</th>
      <th>Enrollment Year</th>
      <th>Graduation Year</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  
    foreach($result as $row){?>
                        <tr>
                            
                            <td><?php echo $row['student_name'];?></td>
                            <td><?php echo $row['father_name'];?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['s_address']; ?></td>
                            <td><?php echo $row['grade10']; ?></td>
                            <td><?php echo $row['grade12']; ?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['year_entry']; ?></td>
                            <td><?php echo $row['year_grad']; ?></td>
                            <td class="edit-btn"><a href="edit.php?id=<?php echo $row["id"]; ?>"><button class="table-change" id="edit">
                            <i class="fa fa-pencil-square-o" ></i>
                            Edit</button></td>
                            <td class="delete-btn"><a href="delete.php?id=<?php echo $row["id"]; ?>"><button class="table-change" id="delete">
                            <i class="fa fa-trash"></i>
                             Delete</button></td>  
                        </tr>
                        <?php }
                        }
                        else{
                          $nf= "no students found";}?>
                          <div id="nf"><?php echo $nf;?>
                        
                </tbody>
                
            </table>

</div>