
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

$course=$_POST["subjectview"];
?>
<?php
$sql="select * from attendance where course=? and dateofad=?";
$sqlt="select count(*) as nost from attendance where course=? and dateofad=?";
$sql2="select count(*) as nopt from attendance where course=? and dateofad=? and statusofpresence=?";
$sql3="select count(*) as noab from attendance where course=? and dateofad=? and statusofpresence=?";
if(isset($_POST["show"])){
    try{
$dated=$_POST["dateview"];
$datec = date("Y-m-d", strtotime($dated)); 
echo $datec;
$present='present';
$absent='absent';
$qt=$conn->prepare($sqlt);
$q=$conn->prepare($sql);
$q2=$conn->prepare($sql2);
$q3=$conn->prepare($sql3);
$qt->execute([$course,$datec]);
$q->execute([$course,$datec]);
$q2->execute([$course,$datec,$present]);
$q3->execute([$course,$datec,$absent]);
$allstud=$qt->fetch(PDO::FETCH_ASSOC);
$allresults=$q->fetchAll();
$presentstudents=$q2->fetch(PDO::FETCH_ASSOC);
$absentstudents=$q3->fetch(PDO::FETCH_ASSOC);
    }catch(PDOException $e){
        echo "Could not show";
      }
}
else{
    try{
$datec=date("Y-m-d");
$present='present';
$absent='absent';
$qt=$conn->prepare($sqlt);
$q=$conn->prepare($sql);
$q2=$conn->prepare($sql2);
$q3=$conn->prepare($sql3);
$qt->execute([$course,$datec]);
$q->execute([$course,$datec]);
$q2->execute([$course,$datec,$present]);
$q3->execute([$course,$datec,$absent]);
$allstud=$qt->fetch(PDO::FETCH_ASSOC);
$allresults=$q->fetchAll();
$presentstudents=$q2->fetch(PDO::FETCH_ASSOC);
$absentstudents=$q3->fetch(PDO::FETCH_ASSOC);
}
catch(
    PDOException $e){
        echo "Could not show";
      }
    }?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Page</title>
    <link rel="stylesheet" href="css/attendancetake.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #navbar-container{
            background-image:url('images/dashboardnavbar.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        </style>
</head>
<body>
<div class="container-fluid" id="navbar-container">
        
    <nav class="dashboard-nav">
        <ul>
            <li><a href='teacherdashboard.php?id=$_SESSION["id"]' class="navbar-link active"><i class="fa fa-home"></i>Home</a></li>
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

<div class="showattendance" id="attendance_table">
    <h1>View Attendance</h1>
    <form id="dateform" method="POST">
    <label for="course">Course:</label>
            <input type="text" id="course" name="course" value="<?php echo $course;?>" readonly>
        <label for="date">DATE</label>
            <input type="date" id="dateview" name="dateview"  required>
        <button type="submit" name="show" id="show">Show<i class="fa fa-binoculars"></i></button>
    </form>
    <div class="studentst" id="studt"><p>Total Students :</p><p class="nos" id="ttl"><?php echo $allstud["nost"];?> </p></div>
    <div class="studentst" id="studp"><p>Students Present:</p><p class="nos" id="pst"><?php echo $presentstudents["nopt"];?> </p></div>
    <div class="studentst" id="studa"><p>Students Absent:</p><p class="nos" id="abt"><?php echo $absentstudents["noab"];?> </p></div>
    
    <table>
        <?php
        print_r($allresults);
    if($allresults){       
         ?>
        <thead>
            <th>Student Name</th>
            <th>Status</th>
        </thead>
        <tbody>
            <?php
           foreach($allresults as $row){?>
           <tr>
            <td><?php echo $row["student_name"];?></td>
            <td><?php echo $row["statusofpresence"];?></td>
           </tr>
           <?php
           }
        }
        ?>

        </tbody>
       
    </table>
    
</div>
</body>
</html>