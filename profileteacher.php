<!--Session code-->
<?php
session_start();
include "database.php";?>
<?php
if (!isset($_SESSION['id'])) {         
  header('location: teacherlogin.php');
}
?>
<?php
if (isset($_POST['signout'])) {
    session_destroy(); 
    echo '<script>alert("Session Ended")</script>';           
    header('refresh:0','url: teacherlogin.php');
  }
  ?>

<?php
$id=$_SESSION['id'];
$sql="select * from faculty where id=:id";
$query=$conn->prepare($sql);
$query-> bindParam(':id', $id);

$query-> execute();
$result=$query->fetch(PDO::FETCH_ASSOC);
?>

<!--html code-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profilestyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
  <!--Navbar container-->
  <div class="container-fluid" id="navbar-container">
        
        <nav class="dashboard-nav">
            <ul>
                <li><a href='teacherdashboard.php' class="navbar-link active"><i class="fa fa-home"></i>Home</a></li>
                <li><a href="attendance.php" class="navbar-link"><i class="fa fa-ravelry"></i>Attendance</a></li>
                <li><a href="marks.php" id="add-user-btn" class="navbar-link"><i class="fa fa-plus"></i>Marks</a></li>
                <li>
                    <a href="teachercourses.php"><i class="fa fa-book"></i>Courses</a>
                       
                </li>
                <form class="logout" id="logout" method="POST">
                <li><button type="submit" name="signout" id="signout" class="signout-btn">Log Out</button></li></form>
            </ul>
        </nav>
    </div>
<div class="card bg-light">

        <img src="images/<?php echo $result["facemail"].".jpeg";?>" alt="user-image" class="card_img">
        <!--<button class="edit-btn"><i class="fa fa-pencil-square-o"></i></button>-->

        <div class="profile-name"><?php if($result){ echo $result['facname']?></div>
        <div class="profile-email"><?php echo $result["facemail"];?></div>
        <div class="profile-phone"><?php echo $result["facphone"];?></div>
        <div class="profile-address"><?php echo $result["facaddress"];}?></div>

</div>
        </body>
        </html>

