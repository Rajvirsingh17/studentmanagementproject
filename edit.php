<!-- getting data-->
<?php
include "database.php";
$id=$_REQUEST["id"];
$sql="SELECT * from student_details where id=:id";
$q=$conn->prepare($sql);
$q-> bindParam(':id', $id);
$q->execute();
$row=$q->fetch(PDO::FETCH_ASSOC);
?>

<!--Updating the data-->
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$student_name=$_POST["name"];
$father_name=$_POST["father-name"];
$gender=$_POST["gender"];
$email=$_POST["email"];
$phone=$_POST["phone"];
$s_address=$_POST["address"];
$grade10=$_POST["grade10"];
$grade12=$_POST["grade12"];
$course=$_POST["course"];
$year_entry=$_POST["entry-year"];
$year_graduation=$_POST["graduate-year"];
$sql="update student_details set student_name=?,
father_name=?,gender=?, email=?,
phone=?,s_address=?,grade10=?,grade12=?,course=?,year_entry=?,year_grad=? where id=?";
$q=$conn->prepare($sql);
$q->execute([$student_name,$father_name,$gender,$email,$phone,$s_address,$grade10,$grade12,$course,$year_entry,$year_graduation,$id]);

$status = "Record Updated Successfully. </br>
<a href='viewuser.php'>View Updated Records</a>";
}
?>



<!--HTML Document-->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Record</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/editstyle.css" />
</head>
<body>
<!--Navbar container-->
<div class="container" id="navbar-container">
        
        <nav class="dashboard-nav">
            <ul>
                <li><a href="dashboard.php">Home</a></li>
            </ul>
        </nav>
    </div>
    
    <!-- Form for updation-->
<div id="update">
<form id="update-form" name="form" method="post" action="">
<h1>UPDATE RECORD</h1> 
<input type="hidden" name="new" value="1" />
<div class="row">
            <div class="mb-3 col">
                <label for="name" class="form-label">Name<span class="required">*</span></label>
                <input type="text" value="<?php echo $row['student_name'];?>" class="form-control" id="name" name="name" required>
                <div class="invalid-feedback" id="name-error"></div></div>
            <div class="mb-3 col">
                <label for="father-name" class="form-label">Father's Name<span class="required">*</span></label>
                <input type="text" value="<?php echo $row['father_name'];?>" class="form-control" id="father-name" name="father-name" required>
                <div class="invalid-feedback" id="father-name-error"></div>
            </div>
            <div class="mb-3 col">
            <fieldset>
                    <legend>Gender<span class="required">*</span></legend>
                    <hidden input type="radio"  value="<?php echo $results["gender"];?>" class="form-control"  name="gender" selected>
                <input type="radio" id="male" value="male" name="gender" required>
                <label for="male" class="form-label">Male</label>
                <input type="radio" id="female" value="female" name="gender">
                <label for="female" class="form-label">Female</label>
                <input type="radio"  id="others" value="others" name="gender">
                <label for="others" class="form-label">Others</label>
                <div class="invalid-feedback" id="gender-error"></div>
                </fieldset>
            </div>
</div>
            <div class="row">
            <div class="mb-3 col">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" value="<?php echo $row['email'];?>" class="form-control" id="email" name="email">
                <div class="invalid-feedback" id="email-error"></div>
            </div>
            <div class="mb-3 col">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" value="<?php echo $row['phone'];?>" class="form-control" minlength=10 maxlength=10 id="phone" name="phone" pattern="[0-9]{10}" placeholder="10 digits">
                <div class="invalid-feedback" id="phone-error"></div>
            </div>

            <div class="mb-3 col">
                <label for="address" class="form-label">Address<span class="required">*</span></label>
                <input type="text" value="<?php echo $row['s_address'];?>" class="form-control" id="address" name="address" required>
                <div class="invalid-feedback" id="address-error"></div>
            </div>
            </div>
            <div class="row">
            <div class="mb-3 col">
                <label for="grade10" class="form-label">Grade 10 score<span class="required">*</span></label>
                <input type="number" value="<?php echo $row['grade10'];?>" step="0.01" class="form-control" placeholder="Enter 10th percentage" id="grade10" name="grade10" required>
                <div class="invalid-feedback" id="grade10-error"></div>
                </div>
                <div class="mb-3 col">
                <label for="grade12" class="form-label">Grade 12 score<span class="required">*</span></label>
                <input type="number" step="0.01"value="<?php echo $row['grade12'];?>" placeholder="Enter 12th percentage" class="form-control" id="grade12" name="grade12" required>
                <div class="invalid-feedback" id="grade12-error"></div>
                </div>
                <div class="mb-3 col">
                <label for="course" class="form-label">Course opted<span class="required">*</span></label>
                <select class="form-control" id="course" name="course" required>
                <option hidden value=<?php echo $row['course'];?> selected><?php echo $row['course'];?></option>
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
                <select class="form-control" value="<?php echo $row['year_entry'];?>" id="entry-year" name="entry-year" required>
                <option hidden value=<?php echo $row['year_entry'];?> selected><?php echo $row['year_entry'];?></option>
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
    <select class="form-control" value="<?php echo $row['year_grad'];?>" id="graduate-year" name="graduate-year" required>
    <option hidden value=<?php echo $row['year_grad'];?> selected><?php echo $row['year_grad'];?></option>
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
            <button type="submit" id="updatebtn" value="Update" class="end-btn">Update</button>
            <button type="reset" id="resetbtn" value="reset" class="end-btn">Reset</button>

</form>
<div id="success"><?php echo $status;?></div>

<?phpelse { } ?>
</body>
</html>
