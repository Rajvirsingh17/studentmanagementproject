<!--Session code-->
<?php
session_start();
include "database.php";?>
<?php
if (!isset($_SESSION['id'])) {         
  header(' location: login.php');
}
?>

<?php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="success-message" id="success-message">Record has been successfully added!</div>';
}
?>
<!--Insertion Code-->





<!--html code-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="css/adduser.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
<!--navbar-->
<div class="container-fluid" id="navbar-container">
        
    <nav class="dashboard-nav">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="adduser.php">Add User</a></li>
            <li><a href="viewuser.php">View User</a></li>
            <li>
                <a href="#">More</a>
                   
            </li>
            <li><a href="logout.php"  name="signout" id="signout" class="signout-btn">Log Out</a></li>
        </ul>
    </nav>
</div>

<!-- Registration_page-->

<h1 class="form-head">Student details</h1>
    <!--<div class="detailsaved"><?php// echo $status;?></div>-->
    <form id="addstudent-form" method="POST" action="addnewstudent.php" class="needs-validation border p-4">

        <div class="row">
            <div class="mb-3 col">
                <label for="name" class="form-label">Name<span class="required">*</span></label>
                <input type="text" class="form-control" id="name" name="name" required>
                <div class="invalid-feedback" id="name-error"></div></div>
            <div class="mb-3 col">
                <label for="father-name" class="form-label">Father's Name<span class="required">*</span></label>
                <input type="text" class="form-control" id="father-name" name="father-name" required>
                <div class="invalid-feedback" id="father-name-error"></div>
                
            <div class="mb-3 col">
            <fieldset>
                    <legend>Gender<span class="required">*</span></legend>
                <input type="radio" class="form-control" id="male" name="gender" required>
                <label for="male" class="form-label">Male</label>
                <input type="radio" class="form-control" id="female" name="gender">
                <label for="female" class="form-label">Female</label>
                <input type="radio" class="form-control" id="others" name="gender">
                <label for="others" class="form-label">Others</label>
                <div class="invalid-feedback" id="gender-error"></div>
                </fieldset>
            </div>
</div>
            <div class="row">
            <div class="mb-3 col">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email">
                <div class="invalid-feedback" id="email-error"></div>
            </div>
            <div class="mb-3 col">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" minlength=10 maxlength=10 id="phone" name="phone" pattern="[0-9]{10}" placeholder="10 digits">
                <div class="invalid-feedback" id="phone-error"></div>
            </div>

            <div class="mb-3 col">
                <label for="address" class="form-label">Address<span class="required">*</span></label>
                <input type="text" class="form-control" id="address" name="address" required>
                <div class="invalid-feedback" id="address-error"></div>
            </div>
            </div>
            <div class="row">
            <div class="mb-3 col">
                <label for="grade10" class="form-label">Grade 10 score<span class="required">*</span></label>
                <input type="number" step="0.01" class="form-control" placeholder="Enter 10th percentage" id="grade10" name="grade10" required>
                <div class="invalid-feedback" id="grade10-error"></div>
                </div>
                <div class="mb-3 col">
                <label for="grade12" class="form-label">Grade 12 score<span class="required">*</span></label>
                <input type="number" step="0.01" placeholder="Enter 12th percentage" class="form-control" id="grade12" name="grade12" required>
                <div class="invalid-feedback" id="grade12-error"></div>
                </div>
                <div class="mb-3 col">
                <label for="course" class="form-label">Course opted<span class="required">*</span></label>
                <select class="form-control" id="course" name="course" required>
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
                </div>
                </div>
                <div class="row">
                <div class="mb-3 col">
                <label for="entry-year" class="form-label">Year of Admission<span class="required">*</span></label>
                <select class="form-control" id="entry-year" name="entry-year" required>
                <?php
                $currentYear = date("Y");
                for ($i = $currentYear; $i >= $currentYear - 50; $i--) {
                    echo "<option value='$i'>$i</option>";
                }
                ?></select>
<div class="invalid-feedback" id="entryyear-error"></div>               
 </div>
<div class="mb-3 col">
    <label for="graduate-year" class="form-label">Year of Graduation<span class="required">*</span></label>
    <select class="form-control" id="graduate-year" name="graduate-year" required>
    <?php
                $currentYear = date("Y");
                for ($i = $currentYear; $i <= $currentYear + 50; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>

</select>
<div class="invalid-feedback" id="graduate-year-error"></div>
</div>
</div>

            <button type="submit" id="submit" name="submit" class="btn btn-primary">Submit</button>
    
            <button type="reset" id="reset" class="btn btn-secondary">Reset</button>
</form>
<script src="js/adduser.js"></script>


</body>
</html>
