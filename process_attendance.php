
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
$facname=$_SESSION['name'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course = $_POST["course"];
    $dateofad = $_POST["date"];
    $attendanceData = $_POST["attendance"];
    $currentdate=date("Y-m-d");
    $oneWeekAgo = date("Y-m-d", strtotime("-1 week"));
    $sqlattcheck="select * from attendance where dateofad=? and course=? ";
    $q=$conn->prepare($sqlattcheck);
    $q->execute([$dateofad,$course]);
    $checkatt=$q->fetch();
    if($checkatt){
        echo '<script>alert("Attendance for this date has already been taken")
        window.setTimeout(function() {
            window.location = "attendance.php";
          }, 5);</script>';
    }
    else if($oneWeekAgo > $dateofad || $currentdate < $dateofad ){
        echo '<script>alert("Attendance for this date cannot be taken")
        window.setTimeout(function() {
            window.location = "attendance.php";
          }, 5);</script>';
    }
    else{
    try {
        

        foreach ($attendanceData as $student => $status) {
            if ($status !== "present" && $status !== "absent") {
               
                continue; 
            }

            $sql = "INSERT INTO attendance (facname,course, dateofad, student_name, statusofpresence) VALUES (?, ?, ?, ?,?)";
            $q = $conn->prepare($sql);
            $q->execute([$facname,$course, $dateofad, $student, $status]);
        }

        header("Location: attendance.php?success=1");
    } catch (PDOException $e) {
        header("Location:attendance.php?error=1");
    } finally {
        $conn = null;
    }
}
}
?>
