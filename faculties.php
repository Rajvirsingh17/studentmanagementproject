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
$sql= "SELECT * from faculty where facname like '%$searchvalue%' or facemail like '%$searchvalue%' or
 facaddress like '%$searchvalue%' or facphone like '%$searchvalue%' or courses like '%$searchvalue%'";
$q=$conn->prepare($sql);
$q-> execute();
$result=$q->fetchAll();
}
catch(PDOException $e){
  echo "Could not show";
}}
if(isset($_POST['go'])){
  $coursevalue=$_POST["course-filter"];
  $sql="SELECT * from faculty where courses like '%$coursevalue%'";
  $q=$conn->prepare($sql);
$q-> execute();
$result=$q->fetchAll();
}
else{
    $sql= 'SELECT * from faculty';
    $q=$conn->prepare($sql);
    $q-> execute();
    $result=$q->fetchAll();
}  
?>

<?php
$q = $conn->query("SELECT id,facname FROM faculty");
    $faculties = $q->fetchAll(PDO::FETCH_ASSOC);

    foreach ($faculties as $faculty) {
        $facname = $faculty['facname'];
        $q = $conn->prepare("SELECT subname FROM courses WHERE faculty = :facname");
        $q->bindParam(':facname', $facname);
        $q->execute();
        $subjects = $q->fetchAll(PDO::FETCH_ASSOC);

        // Extract subject names
        $subjectNames = [];
        foreach ($subjects as $subject) {
            $subjectNames[] = $subject['subname'];
        }

        // Encode subject names as JSON
        $jsonSubjects = json_encode($subjectNames);

        // Update the student_details table with JSON subjects
        $q = $conn->prepare("UPDATE faculty SET courses = :jsonSubjects WHERE id = :Id");
        $q->bindParam(':jsonSubjects', $jsonSubjects);
        $q->bindParam(':Id', $faculty['id']);
        $q->execute();
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
    <link rel="stylesheet" href="css/faculties.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
</head>
<body>
  <!--Navbar container-->
    <div class="container-fluid" id="navbar-container">
        
    <nav class="dashboard-nav">
        <ul>
            <li><a href="dashboard.php" class="navbar-link"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="faculties.php" class="navbar-link active"><i class="fa fa-ravelry"></i>Faculty</a></li>
            <li><a href="adduser.php" id="add-user-btn" class="navbar-link"><i class="fa fa-plus"></i>Add Student</a></li>
            <li><a href="viewuser.php" id="view-user-btn" class="navbar-link"><i class="fa fa-graduation-cap"></i>View Students</a></li>
            <li>
                <a href="courses.php" class="navbar-link "><i class="fa fa-book"></i>Courses</a>
                   
            </li>
            <form class="logout" id="logout" method="POST">
            <li><button type="submit" name="signout" id="signout" class="signout-btn">Log Out</button></li></form>
        </ul>
    </nav>
</div>


<!--Insertion of new course-->
<div class="new-faculty-form" id="popupnew-faculty-form">
        <h1 class="text-center">Add Faculty</h1>
        <form id="courseadd-form" method="POST" class="needs-validation border p-4" action="addfaculty.php">
            <div class="mb-3">
                <label for="facname" class="form-label">Faculty Name<span class="required">*</span></label>
                <input type="text" class="form-control" id="facname" name="facname" required>
                <div class="invalid-feedback" id="facname-error"></div>
            </div>
            <div class="mb-3">
                <label for="facaddress" class="form-label">Faculty address<span class="required">*</span></label>
                <input type="text" class="form-control" id="facaddress" name="facaddress" required>
                <div class="invalid-feedback" id="facaddress-error"></div>
            </div>
            <div class="mb-3">
                <label for="facemail" class="form-label">Faculty Email<span class="required">*</span></label>
                <input type="email" class="form-control" id="facemail" name="facemail" required>
                <div class="invalid-feedback" id="facemail-error"></div>
</div>
                <div class="mb-3">
                <label for="pass" class="form-label">Faculty Password<span class="required">*</span></label>
                <input type="password" class="form-control" id="pass" name="pass" required>
                <div class="invalid-feedback" id="pass-error"></div>
            </div>
            <div class="mb-3">
                <label for="facphone" class="form-label">Phone Number<span class="required">*</span></label>
                <input type="tel" class="form-control" minlength=10 maxlength=10 pattern="[0-9]{10}" id="facphone" name="facphone" required>
                <div class="invalid-feedback" id="facphone-error"></div></div>
            
            <button type="submit" name="addfaculty" id="add-faculty" class="btn btn-primary">Add</button>
            <button type="reset" class="btn btn-secondary">Reset</button>

        </form>
</div>








<!--Show User-->
<div id="show_user" class="container">
<h1 class="table-heading">Faculties</h1>
<button id="filter-btn" onclick="displayfilter()">Filter</button>
<form id="filter-form" method="POST">
<div class="mb-3">        
                <select class="form-control" id="course-filter" name="course-filter">
                <option label=""></option><?php
                foreach($result1 as $row){
                 ?> <option><?php echo $row['subname'];?></option><?php }?>               
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
<div id="newfaculty"><button name="new-faculty" id="new-faculty-button" onclick="showhideaddfaculty()"><i class="fa fa-plus"></i>New Faculty</button>
            </div>
<div class="table-display">
<table class="table table-bordered table-condensed">
<?php
if($result){?>
  <thead>
    <tr>
      <th>S.no.</th>
      <th>Faculty Name</th>
      <th>Faculty Address</th>
      <th>Faculty Email</th>
      <th>Faculty Phone</th>
      <th>Courses</th>
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
                            <td><?php echo $row['facname'];?></td>
                            <td><?php echo $row['facaddress'];?></td>
                            <td><?php echo $row['facemail']; ?></td>
                            <td><?php echo $row['facphone'];?></td>
                            <td><?php $courses_array = json_decode($row["courses"], true);
                            $j=1;
                            foreach ($courses_array as $course) {
                              echo $j.")". $course . "<br>";
                              $j++;} ?></td>
                           
                            <td class="edit-btn"><a href="facultyedit.php?id=<?php echo $row["id"]; ?>"><button class="table-change" id="edit">
                            <i class="fa fa-pencil-square-o" ></i>
                            Edit</button></td>
                            <td class="delete-btn"><a href="deletecourse.php?id=<?php echo $row["id"]; ?>"><button class="table-change" id="delete">
                            <i class="fa fa-trash"></i>
                             Delete</button></td>  
                        </tr>
                        <?php }
                        }
                        else{
                          $nf= "no faculty found";}?>
                          <div id="nf"><?php echo $nf;?>
                        
                </tbody>
                
            </table>
            </div>

</div>
<script src="js/addfaculty.js"></script>
                        </body>
                        </html>

                      