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

<?php

error_reporting(E_ERROR | E_PARSE);
include "database.php";
//for search button
if(isset($_POST['search'])){
try{
$searchvalue=$_POST["searchvalue"];
$sql= "SELECT * from courses where subcode like '%$searchvalue%' or subname like '%$searchvalue%' or
 faculty like '%$searchvalue%' or course like '%$searchvalue%' or curriculum like '%$searchvalue%'";
$q=$conn->prepare($sql);
$q-> execute();
$result=$q->fetchAll();
}
catch(PDOException $e){
  echo "Could not show";
}}
if(isset($_POST['go'])){
  $coursevalue=$_POST["course-filter"];
  $sql="SELECT * from courses where course like '%$coursevalue%'";
  $q=$conn->prepare($sql);
$q-> execute();
$result=$q->fetchAll();
}
else{
    $sql= 'SELECT * from courses';
    $q=$conn->prepare($sql);
    $q-> execute();
    $result=$q->fetchAll();
}  
?>

<!-- Course add-->
<?php

if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="success-message" id="success-message">Record has been successfully added!</div>';
}
?>


<!--html code-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="css/courses.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
</head>
<body>
  <!--Navbar container-->
    <div class="container-fluid" id="navbar-container">
        
    <nav class="dashboard-nav">
        <ul>
            <li><a href="dashboard.php" class="navbar-link"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="faculties.php" class="navbar-link"><i class="fa fa-ravelry"></i>Faculty</a></li>
            <li><a href="adduser.php" id="add-user-btn" class="navbar-link"><i class="fa fa-plus"></i>Add Student</a></li>
            <li><a href="viewuser.php" id="view-user-btn" class="navbar-link"><i class="fa fa-graduation-cap"></i>View Students</a></li>
            <li>
                <a href="courses.php" class="navbar-link active"><i class="fa fa-book"></i>Courses</a>
                   
            </li>
            <form class="logout" id="logout" method="POST">
            <li><button type="submit" name="signout" id="signout" class="signout-btn">Log Out</button></li></form>
        </ul>
    </nav>
</div>


<!--Insertion of new course-->
<div class="new-course-form" id="popupnew-course-form">
        <h1 class="text-center">Add Course</h1>
        <form id="courseadd-form" method="POST" class="needs-validation border p-4" action="addcourse.php">
            <div class="mb-3">
                <label for="subcode" class="form-label">Subject Code<span class="required">*</span></label>
                <input type="text" class="form-control" id="subcode" name="subcode" required>
                <div class="invalid-feedback" id="subcode-error"></div>
            </div>
            <div class="mb-3">
                <label for="subname" class="form-label">Subject name<span class="required">*</span></label>
                <input type="text" class="form-control" id="subname" name="subname" required>
                <div class="invalid-feedback" id="subname-error"></div>
            </div>
            <div class="mb-3">
                <label for="faculty" class="form-label">Faculty<span class="required">*</span></label>
                <input type="text" class="form-control" id="faculty" name="faculty" required>
                <div class="invalid-feedback" id="faculty-error"></div>
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course<span class="required">*</span></label>
                <select class="form-control" id="course" name="course" required>
                    <optgroup label="Computer Science Engineering">
                        <option value="CSE Core">CSE Core</option>
                        <option value="CSE Data Science">CSE Data Science</option>
                        <option value="CSE Information Security">CSE Information Security</option>
                        <option value="CSE Blockchain">CSE Blockchain</option>
                        <option value="CSE Business Systems">CSE Business Systems</option>
                        <option value="CSE Bioinformatics">CSE Bioinformatics</option>
                    </optgroup>
                <option value="Mechanical Engineering">Mechanical Engineering</option>
                <option value="Electrical Engineering">Electrical Engineering</option>
                <option value="Electronic Engineering">Electronic Engineering</option>
                <option value="Civil Engineering">Civil Engineering</option>
</select>
                <div class="invalid-feedback" id="course-error"></div>
                </div>
            <div class="mb-3">
                <label for="curriculum" class="form-label">Curriculum<span class="required">*</span></label>
                <input type="text" class="form-control" id="curriculum" name="curriculum" required><span class="requirements">Enter link to curriculum</span>
                <div class="invalid-feedback" id="curriculum-error"></div>
            </div>
            <button type="submit" name="addcourse" id="add-course" class="btn btn-primary">Add</button>
            <button type="reset" class="btn btn-secondary">Reset</button>

        </form>
</div>








<!--Show User-->
<div id="show_user" class="container">
<h1 class="table-heading">Courses</h1>
<button id="filter-btn" onclick="displayfilter()">Filter</button>
<form id="filter-form" method="POST">
<div class="mb-3">        
                <select class="form-control" id="course-filter" name="course-filter">
                <option label=""></option>
                    <optgroup label="Computer Science Engineering">
                        <option value="CSE Core">CSE Core</option>
                        <option value="CSE Data Science">CSE Data Science</option>
                        <option value="CSE Information Securit">CSE Information Security</option>
                        <option value="CSE Blockchain">CSE Blockchain</option>
                        <option value="CSE Business Systems">CSE Business Systems</option>
                        <option value="CSE Bioinformatics">CSE Bioinformatics</option>
                    </optgroup>
                <option value="Mechanical Engineering">Mechanical Engineering</option>
                <option value="Electrical Engineering">Electrical Engineering</option>
                <option value="Electronic Engineering">Electronic Engineering</option>
                <option value="Civil Engineering">Civil Engineering</option>
</select>
                <div class="invalid-feedback" id="course-error"></div>
                <button input type="submit" name="go" id="go">
      <i class="fa fa-binoculars"></i></button>
    
  </div>

  
</form>
<form id="search-form" method="POST">
<div class="mb-3">        
  <input type="search" id="search-bar" name="searchvalue" class="form-control" placeholder="Search">
    <button input type="submit" name="search" id="search">
      <i class="fa fa-search"></i>
    </button>
  </div>
</form>
<div id="newcourse"><button name="new-course" id="new-course-button" onclick="showhideaddcourse()"><i class="fa fa-plus"></i>New Course</button>
            </div>
<div class="table-display">
<table class="table table-bordered table-condensed">
<?php
if($result){?>
  <thead>
    <tr>
      <th>S.no.</th>
      <th>Subject Code</th>
      <th>Subject Name</th>
      <th>Course</th>
      <th>Faculty</th>
      <th>Curriculum</th>
      <th>Edit</th>
      <th>Delete</th>

    </tr>
  </thead>
  <tbody>
  <?php 
  $i=1;
    foreach($result as $row){?>
                        <tr>
                            <td><?php echo $i++;?></td>
                            <td><?php echo $row['subcode'];?></td>
                            <td><?php echo $row['subname'];?></td>
                            <td><?php echo $row['course']; ?></td>
                            <td><?php echo $row['faculty'];?></td>
                            <td><a href=<?php echo $row['curriculum']; ?>>Curriculum </a></td>
                           
                            <td class="edit-btn"><a href="editcourse.php?id=<?php echo $row["id"]; ?>"><button class="table-change" id="edit">
                            <i class="fa fa-pencil-square-o" ></i>
                            Edit</button></td>
                            <td class="delete-btn"><a href="deletecourse.php?id=<?php echo $row["id"]; ?>"><button class="table-change" id="delete">
                            <i class="fa fa-trash"></i>
                             Delete</button></td>  
                        </tr>
                        <?php }
                        }
                        else{
                          $nf= "no courses found";}?>
                          <div id="nf"><?php echo $nf;?>
                        
                </tbody>
                
            </table>
            </div>

</div>
<script src="js/addcourse.js"></script>
                        </body>
                        </html>

                      <?php  $q = $conn->query("SELECT id, course FROM student_details");
    $students = $q->fetchAll(PDO::FETCH_ASSOC);

    foreach ($students as $student) {
        $coursesub = $student['course'];
        $q = $conn->prepare("SELECT subname FROM courses WHERE course = :course");
        $q->bindParam(':course', $coursesub);
        $q->execute();
        $subjects = $q->fetchAll(PDO::FETCH_ASSOC);

        // Extract subject names
        $subjectNames = [];
        foreach ($subjects as $subject) {
            $subjectNames[] = $subject['subname'];
        }

        // Encode subject names as JSON
        $jsonSubjects = json_encode($subjectNames);

        $q = $conn->prepare("UPDATE student_details SET subjects_json = :jsonSubjects WHERE id = :Id");
        $q->bindParam(':jsonSubjects', $jsonSubjects);
        $q->bindParam(':Id', $student['id']);
        $q->execute();
    }
    ?>