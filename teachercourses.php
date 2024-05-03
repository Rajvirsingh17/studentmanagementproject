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
$sql="select * from courses where faculty=?";
$q=$conn->prepare($sql);
$q->execute([$_SESSION['name']]);
$results=$q->fetchAll();
?>

<!--html code-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="css/dashboardstyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #navbar-container{
            background-image:url('images/teacher.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
        }
       
    </style>
    
</head>
<body>
  <!--Navbar container-->
    <div class="container-fluid" id="navbar-container">
        
    <nav class="dashboard-nav">
        <ul>
            <li><a href='teacherdashboard.php' class="navbar-link "><i class="fa fa-home"></i>Home</a></li>
            <li><a href="attendance.php" class="navbar-link"><i class="fa fa-ravelry"></i>Attendance</a></li>
            <li><a href="marks.php" id="add-user-btn" class="navbar-link"><i class="fa fa-plus"></i>Marks</a></li>
            <li>
                <a href="teachercourses.php" class="navbar-link active"><i class="fa fa-book"></i>Courses</a>
                   
            </li>
            <form class="logout" id="logout" method="POST">
            <li><button type="submit" name="signout" id="signout" class="signout-btn">Log Out</button></li></form>
        </ul>
    </nav>
</div>



<div class="courses">
    <h1 center>Your Courses</h1>
    <?php if($results){?>
    <table>
        <thead>
            <th>S.No.</th>
            <th>SubjectID</th>
            <th>Subject Name</th>
            <th>Course</th>
            <th>Curriculum</th>
            
            <tbody>
                <?php
                $j=1;
                foreach($results as $row){?>
                <tr>
                <td><?php echo $j;?></td>
                    <td><?php echo $row['subcode'];?></td>
                    <td><?php echo $row['subname'];?></td>
                    <td><?php echo $row['course'];?></td>
                    <td><a href="<?php echo $row['curriculum'];?>">Curriculum</a></td>
                    
                </tr> 
                <?php $j++;}?>
            </tbody>
        </thead>
    </table>
    <?php } ?>
</div>




 
</body>
</html>
       