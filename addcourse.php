<!--Insertion Code-->
<?php
include "database.php";?>
<?php
error_reporting(E_ERROR | E_PARSE);
if($_SERVER["REQUEST_METHOD"]=="POST"){
   
$subcode=$_POST["subcode"];
$subname=$_POST["subname"];
$faculty=$_POST["faculty"];
$course=$_POST["course"];
$curriculum=$_POST["curriculum"];




$sql="INSERT INTO courses(subcode,subname,faculty,course,curriculum) values(?,?,?,?,?)";
$qrun=$conn->prepare($sql);
if($qrun->execute([$subcode,$subname,$faculty,$course,$curriculum])){



  header("Location: courses.php?success=1");
  exit(); // Make sure to exit to prevent further execution
} else {
  // Redirect back to add_student.php with error parameter
  header("Location: courses.php?error=1");
  exit();
}

// Close statement
$qrun->close();
}

// Close connection
$conn->close();

?>