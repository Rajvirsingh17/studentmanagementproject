<!--Insertion Code-->
<?php
include "database.php";?>
<?php
error_reporting(E_ERROR | E_PARSE);
if($_SERVER["REQUEST_METHOD"]=="POST"){
   
$facname=$_POST["facname"];
$facaddress=$_POST["facaddress"];
$facemail=$_POST["facemail"];
$pass=password_hash($_POST["pass"], PASSWORD_DEFAULT);
$facphone=$_POST["facphone"];





$sql="INSERT INTO faculty(facname,facaddress,facemail,pass,facphone,courses) values(?,?,?,?,?,?)";
$qrun=$conn->prepare($sql);
if($qrun->execute([$facname,$facaddress,$facemail,$pass,$facphone,NULL])){



  header("Location: faculties.php?success=1");
  exit(); // Make sure to exit to prevent further execution
} else {
  // Redirect back to add_student.php with error parameter
  header("Location: faculties.php?error=1");
  exit();
}

// Close statement
$qrun->close();
}

// Close connection
$conn->close();

?>