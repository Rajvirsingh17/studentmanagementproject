<!--Session code-->
<?php
session_start();
include "database.php";?>
<?php
if (!isset($_SESSION['id'])) {         
  header('location: login.php');
}
?>
<?php
if (isset($_POST['signout'])) {
    session_destroy(); 
    echo '<script>alert("Session Ended")</script>';           
    header('refresh:0','url: login.php');
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


<!--Dashboard display-->
<div id="dashboard-class" class="container-fluid">
    <h1 class="heading-1">Welcome <?php echo $_SESSION["name"];?>!</h1>
    <h4 class="heading-4"><i class="fa fa-user-circle"></i><?php echo  " ".$_SESSION['email']; ?></h4> 
</div>

</body>
</html>
       