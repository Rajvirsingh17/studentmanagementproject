<!--Insertion Code-->
<?php
include "database.php";?>
<?php
error_reporting(E_ERROR | E_PARSE);
if($_SERVER["REQUEST_METHOD"]=="POST"){
   
$student_name=$_POST["name"];
$fathername=$_POST["father-name"];
$gender=$_POST["gender"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$s_address=$_POST["address"];
$grade10=$_POST["grade10"];
$grade12=$_POST["grade12"];
$course=$_POST["course"];
$year_entry=$_POST["entry-year"];
$year_graduation=$_POST["graduate-year"];



$sql="INSERT INTO student_details(student_name,father_name,email,phone,s_address,grade10,grade12,course,year_entry,year_grad) values(?,?,?,?,?,?,?,?,?,?)";
$qrun=$conn->prepare($sql);
if($qrun->execute([$student_name,$fathername,$gender,$email,$phone,$s_address,$grade10,$grade12,$course,$year_entry,$year_graduation])){



  header("Location: adduser.php?success=1");
  exit(); // Make sure to exit to prevent further execution
} else {
  // Redirect back to add_student.php with error parameter
  header("Location: adduser.php?error=1");
  exit();
}

// Close statement
$qrun->close();
}

// Close connection
$conn->close();

?>