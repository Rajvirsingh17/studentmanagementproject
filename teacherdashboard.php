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
        #dashboard-class{
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


<!--Dashboard display-->
<div id="dashboard-class" class="container-fluid">
    <h1 class="heading-1">Welcome <?php echo $_SESSION["name"];?>!</h1>
    <h4 class="heading-4"><a href="profileteacher.php?id=<?php echo $_SESSION["id"]; ?>"><i class="fa fa-user-circle"></i><?php echo  " ".$_SESSION['email']; ?></a></h4> 
</div>

<div class="notice">
<div class="card-notice" id="notice1">
<h2 center>MESSAGE FOR TEACHERS’ DAY</h2><br>
<p>In India 5th September is celebrated as Teachers' day. 5th September is the birthday of a great teacher Dr. Sarvapalli Radhakrishnan. When Dr. Radhakrishnan became the president of India in 1962, some of his students and friends approached him and requested him to allow them to celebrate 5th September, his "birthday". In reply, Dr, Radhakrishnan said, "instead of celebrating my birthday separately, it would be my proud privilege if September 5th is observed as Teachers' day". The request showed Dr.Radhakrishnan's love for the teaching profession. From then onwards, the day has been observed as Teachers' Day in India.
On Teachers’ Day, and on any other day for that matter, the basic message that a teacher needs to receive is quite simple. “We appreciate you”
Teachers mold the lives that they influence. Lessons learned from teachers remain with their students throughout life. Teachers that break down barriers and reach into the souls of the students that they are responsible for do not get the recognition or gratitude they have earned. Many teachers are exhausted from their workload and responsibilities. They have their own families, financial and life stresses that challenge them along with everyone else. We should always respect our teachers. Teachers need encouragement and support from the community to feel that their devotion to students is appreciated.
"Be all that you can be. Find your future--as a teacher."</p>
</div>
<div class="card-notice" id="notice2">
<h2 center>Faculty Meeting Notice</h2><br>
<p>No.PUC/35/Adm/2011/Dated the 9th September 2023

MEETING NOTICE

A meeting of Teaching Staff of GC University College is scheduled to be held on 11th September, 2023 (Monday) at 3:00 pm in the Teacher’s Common Room.

All Teachers are requested to attend the meeting.

( JULIANA VANRENGPUII ) P.S. to Principal, GC University College

 Copy to:

 All HODs,GC University College for information and with a request to circulate this notice among the teachers of their department.  </p>
</div>
<div class="card-notice" id="notice3">
<h2 center>'SEED STEM Masters Conclave'</h2><br>
<p style="align:center">Top-ranked US Engineering & Sciences schools
Meet Columbia University, NYU-Tandon, Boston University, GW, WPI & LMU
September 20, 2023 at 10.30 am
Dr. M. Channa Reddy Auditorium</p><p>
We are delighted to share an exclusive opportunity to meet face-to-face with senior delegates from top-ranked US Engineering & Sciences schools coming to our campus on September 20, 2023 at 10.30 am.
All third-year & fourth-year students and recent alumni who are interested in pursuing a Master's program in the USA are welcome to attend the 'SEED STEM Masters Conclave'. 
Register Now via this link: <a href="https://connect.seedglobaleducation.com/stem-ct-vit-vellore-20sept23">https://connect.seedglobaleducation.com/stem-ct-vit-vellore-20sept23</a> 
Attending schools include:
•	Boston University - Graduate School of Arts & Sciences
•	Columbia University - The Fu Foundation School of Engineering and Applied Science
•	George Washington University - School of Engineering and Applied Science
•	Loyola Marymount University - Seaver College of Science and Engineering
•	NYU - Tandon School of Engineering
•	Worcester Polytechnic Institute - School of Engineering
</p>
</div>

    </div>
 
</body>
</html>
       