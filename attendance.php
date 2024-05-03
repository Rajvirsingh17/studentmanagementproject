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
$sql="select courses from faculty where id=?";
$q=$conn->prepare($sql);
$q->execute([$_SESSION['id']]);
$result1=$q->fetch(PDO::FETCH_ASSOC);
?>

<?php
if(isset($_POST['submit1'])){
$courset=$_POST["subject"];
$sql="SELECT student_name FROM student_details WHERE JSON_CONTAINS(subjects_json, ?)";
$q=$conn->prepare($sql);
$q->execute(['["' . $courset . '"]']);
$result2=$q->fetchAll(PDO::FETCH_COLUMN);}
?>


<?php

if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="success-message" id="success-message">Attendance has been successfully updated!</div>';
}
?>


<?php

error_reporting(E_ERROR | E_PARSE);
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
$coursev=$_POST["subjectview"];
echo $datec;
$present='present';
$absent='absent';
$qt=$conn->prepare($sqlt);
$q=$conn->prepare($sql);
$q2=$conn->prepare($sql2);
$q3=$conn->prepare($sql3);
$qt->execute([$coursev,$datec]);
$q->execute([$coursev,$datec]);
$q2->execute([$coursev,$datec,$present]);
$q3->execute([$coursev,$datec,$absent]);
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





<!--html code-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="css/attendance.css">
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
            <li><a href='teacherdashboard.php' class="navbar-link"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="attendance.php" class="navbar-link  active"><i class="fa fa-ravelry"></i>Attendance</a></li>
            <li><a href="marks.php" id="add-user-btn" class="navbar-link"><i class="fa fa-plus"></i>Marks</a></li>
            <li>
                <a href="teachercourses.php"><i class="fa fa-book"></i>Courses</a>
                   
            </li>
            <form class="logout" id="logout" method="POST">
            <li><button type="submit" name="signout" id="signout" class="signout-btn">Log Out</button></li></form>
        </ul>
    </nav>
</div>


<div class="attendance-tab" id="attendance-take">
    <h1>Take Attendance</h1>
    <div class="courseslinks" id="coursesfortake">
    <form class="courseform" id="attendance_take" method=POST>
        <label for="courseattendancetake" class="form-label">Course:</label>
        <select class="form-control" id="courseattendancetake" name="subject">
            <option default></option>
    <?php
    $courses_array = json_decode($result1["courses"], true);
    foreach ($courses_array as $course) {  ?>
      <option><?php echo $course;?></option> <br>

      <?php } ?>
    </select>
    <button type="submit" class="btn btn-primary" id="submit1" name="submit1"><i class="fa fa-book"></i></button>
    </form><br>
    <?php if($result2){?>
        <div class="attendance-form" id="attendance-form">
         
        <h2><?php echo $_POST["subject"];?></h2>
        <form action="process_attendance.php" method="POST">
            <label hidden for="course">Course:</label>
            <input hidden type="text" id="course" name="course" value="<?php echo $_POST["subject"];?>" readonly>
            <label for="date" class="form-label">Date:</label>
            <input type="date" class="form-control" id="date" name="date" value="<?php echo date("Y-m-d");?>" required>
            <br>
            
            <table>
                <thead>
                    <th>Student Name</th>
                    <th style="color:green;">Present</th>
                    
                    <th style="color:red;">Absent</th>
                </thead>
            
                <?php foreach($result2 as $studname){
                    ?><tr>
    <td style="color:#232323;"><label for="<?php echo $studname;?>"><?php echo $studname;?></label></td>
    <td style="color:green; font-weight:600;"><input type="radio" name="attendance[<?php echo $studname;?>]" value='present' required> Present</td>
    <td style="color:red; font-weight:600;"><input type="radio" name="attendance[<?php echo $studname;?>]" value='absent'> Absent<br></td></tr>
                    <?php } ?>
            
            <input type="submit" class="btn btn-primary" id="submitattendance" value="Submit">
            </table>
            
        </form>
    </div>
    <?php } ?>
</div>
</div>
    


<div class="showattendance" id="attendance_table">
    <h1 center>View Attendance</h1>
    <h2 center>Date shown: <?php echo $datec;?></h2>
    <form id="dateform" method="POST">
        <div class="row">
            <div class="mb-3 col">
    <label for="courseattendanceview" class="form-label">Course:</label>
    <select  id="courseattendanceview" class="form-control" name="subjectview">
        <option></option>
    <?php
    $courses_array = json_decode($result1["courses"], true);
    foreach ($courses_array as $coursea) {  ?>
      <option><?php echo $coursea;?></option> <br>

      <?php } ?>
    </select></div>
    <div class="mb-3 col">
        <label for="dateview" class="form-label">Date:</label>
            <input type="date" class="form-control" id="dateview" name="dateview" value="<?php echo date("Y-m-d");?>" required></div></div>
        <button type="submit" name="show" id="show">Show <i class="fa fa-binoculars"></i></button>
    </form>
    <div class="courseviewshown" style="font-weight:600; align:center; font-size:30px; left:250px;"><?php echo $coursev;?></div>
    <div class="attendancemetrics">
    <div class="card-studentst" id="studt"><p class="nos" id="ttl"><?php echo $allstud["nost"];?> </p><p>Total Students</p></div>
    <div class="card-studentst" id="studp"><p class="nos" id="pst"><?php echo $presentstudents["nopt"];?> </p><p>Students Present</p></div>
    <div class="card-studentst" id="studa"><p class="nos" id="abt"><?php echo $absentstudents["noab"];?> </p><p>Students Absent</p></div>
    </div>
    <table>
        <?php
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
            <?php 
            if($row["statusofpresence"]==='present'){
                $classname='present';
            }
            else{
                $classname='absent';
            }?>
            
            <td><?php echo $row["student_name"];?></td>
            <td><div class="<?php echo $classname;?>"><?php echo $row["statusofpresence"];?></div></td>
           </tr>
           <?php
           }
        }
        ?>

        </tbody>
       
    </table>
    
</div>
    <script src="js/attendance.js"></script>
    </body>
    </html>