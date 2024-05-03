<!-- getting data-->
<?php
include "database.php";
$id=$_REQUEST["id"];
$sql="SELECT * from courses where id=:id";
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
    $subcode=$_POST["subcode"];
    $subname=$_POST["subname"];
    $faculty=$_POST["faculty"];
    $course=$_POST["course"];
    $curriculum=$_POST["curriculum"];
$sql="update courses set subcode=?,subname=?,faculty=?,course=?,curriculum=? where id=?";
$q=$conn->prepare($sql);
$q->execute([$subcode,$subname,$faculty,$course,$curriculum,$id]);

$status = "Record Updated Successfully. </br>
<a href='courses.php'>View Updated Records</a>";
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
    <div id="success"><?php echo $status;?></div>
<div id="update">
<form id="update-form" name="form" method="post" action="">
<h1>UPDATE RECORD</h1> 
<input type="hidden" name="new" value="1" />
<div class="mb-3">
                <label for="subcode" class="form-label">Subject Code<span class="required">*</span></label>
                <input type="text"  value="<?php echo $row['subcode'];?>" class="form-control" id="subcode" name="subcode" required>
                <div class="invalid-feedback" id="subcode-error"></div>
            </div>
            <div class="mb-3">
                <label for="subname" class="form-label">Subject name<span class="required">*</span></label>
                <input type="text"  value="<?php echo $row['subname'];?>" class="form-control" id="subname" name="subname" required>
                <div class="invalid-feedback" id="subname-error"></div>
            </div>
            <div class="mb-3">
                <label for="faculty" class="form-label">Faculty<span class="required">*</span></label>
                <input type="text"  value="<?php echo $row['faculty'];?>" class="form-control" id="faculty" name="faculty" required>
                <div class="invalid-feedback" id="faculty-error"></div>
            </div>
            
 <div class="mb-3 ">
                <label for="course" class="form-label">Course<span class="required">*</span></label>
                <select class="form-control" id="course" name="course" required>
                <option hidden disabled>Select an Option</option>
                <optgroup label="Computer Science Engineering">
        <option value="CSE Core" <?php if ($row['course'] === "CSE Core") echo 'selected'; ?>>CSE Core</option>
        <option value="CSE Data Science" <?php if ($row['course'] === "CSE Data Science") echo 'selected'; ?>>CSE Data Science</option>
        <option value="CSE Information Security" <?php if ($row['course'] === "CSE Information Security") echo 'selected'; ?>>CSE Information Security</option>
        <option value="CSE Blockchain" <?php if ($row['course'] === "CSE Blockchain") echo 'selected'; ?>>CSE Blockchain</option>
        <option value="CSE Business Systems" <?php if ($row['course'] === "CSE Business Systems") echo 'selected'; ?>>CSE Business Systems</option>
        <option value="CSE Bioinformatics" <?php if ($row['course'] === "CSE Bioinformatics") echo 'selected'; ?>>CSE Bioinformatics</option>
    </optgroup>
    <option value="Mechanical Engineering" <?php if ($row['course'] === "Mechanical Engineering") echo 'selected'; ?>>Mechanical Engineering</option>
    <option value="Electrical Engineering" <?php if ($row['course'] === "Electrical Engineering") echo 'selected'; ?>>Electrical Engineering</option>
    <option value="Electronic Engineering" <?php if ($row['course'] === "Electronic Engineering") echo 'selected'; ?>>Electronic Engineering</option>
    <option value="Civil Engineering" <?php if ($row['course'] === "Civil Engineering") echo 'selected'; ?>>Civil Engineering</option>
</select>
                <div class="invalid-feedback" id="course-error"></div>
</div>
<div class="mb-3">
                <label for="curriculum" class="form-label">Curriculum<span class="required">*</span></label>
                <input type="text"  value="<?php echo $row['curriculum'];?>" class="form-control" id="curriculum" name="curriculum" required><span class="requirements">Enter link to curriculum</span>
                <div class="invalid-feedback" id="curriculum-error"></div>
            </div>
            <button type="submit" id="updatebtn" value="Update" class="end-btn">Update</button>
            <button type="reset" id="resetbtn" value="reset" class="end-btn">Reset</button>

</form>


</body>
</html>