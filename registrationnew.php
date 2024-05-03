<?php
error_reporting(E_ERROR | E_PARSE);
if($_SERVER["REQUEST_METHOD"]=="POST"){
$fname=$_POST["first-name"];
$lname=$_POST["last-name"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$pass=password_hash($_POST["password"], PASSWORD_DEFAULT);

include "database.php";
try{

$sql="INSERT INTO accounts (first_name,last_name,email,phone,pass) values(?,?,?,?,?)";
$qrun=$conn->prepare($sql);
$qrun->execute([$fname,$lname,$email,$phone,$pass]);
$regsuccess='REGISTRATION SUCCESSFUL <br> <a href="login.php">Login Now</a>';
}catch(PDOException $e){
    echo '<script>alert("Registration unsuccessful")</script>';
    
}
}
$conn=null;
?>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style2.css">
    
</head>
<body>
    <div class="container" id="contain">
        <div class="regsuccess"><?php echo $regsuccess;?></div>
        <h1 class="text-center">Registration</h1>
        <div class="success" id="regsuccess"></div>
        <form id="registration-form" method="POST" class="needs-validation border p-4">
            <div class="mb-3">
                <label for="first-name" class="form-label">First Name<span class="required">*</span></label>
                <input type="text" class="form-control" id="first-name" name="first-name" required>
                <div class="invalid-feedback" id="first-name-error"></div>
            </div>
            <div class="mb-3">
                <label for="last-name" class="form-label">Last Name<span class="required">*</span></label>
                <input type="text" class="form-control" id="last-name" name="last-name" required>
                <div class="invalid-feedback" id="last-name-error"></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address<span class="required">*</span></label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div class="invalid-feedback" id="email-error"></div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" minlength=10 maxlength=10 id="phone" name="phone" pattern="[0-9]{10}" placeholder="10 digits">
                <div class="invalid-feedback" id="phone-error"></div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password<span class="required">*</span></label>
                <input type="password" class="form-control" id="password" name="password" required><span class="requirements">8-20 characters include atleast one lowercase,uppercase,special character and number</span>
                <div class="invalid-feedback" id="password-error"></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <div  id="login-link">Already a user? <a id="login-button"  href="login.php">Sign In</a></div>
        </form>
</div>
    
    <script src="js/script.js"></script>
</body>
</html>
