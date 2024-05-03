<!-- getting data-->
<?php
include "database.php";
$id=$_REQUEST["id"];
$sql="SELECT * from faculty where id=:id";
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
    $facname=$_POST["facname"];
    $facaddress=$_POST["facaddress"];
    $facemail=$_POST["facemail"];
    $facphone=$_POST["facphone"];
$sql="update faculty set facname=?,
facaddress=?,facemail=?, facphone=? where id=?";
$q=$conn->prepare($sql);
$q->execute([$facname,
$facaddress,
$facemail,
$facphone,$id]);

$status = "Record Updated Successfully. </br>
<a href='faculties.php'>View Updated Records</a>";
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
                <label for="facname" class="form-label">Name<span class="required">*</span></label>
                <input type="text" value="<?php echo $row['facname'];?>" class="form-control" id="facname" name="facname" required>
                <div class="invalid-feedback" id="facname-error"></div></div>
            <div class="mb-3">
                <label for="facaddress" class="form-label">Address<span class="required">*</span></label>
                <input type="text" value="<?php echo $row['facaddress'];?>" class="form-control" id="facaddress" name="facaddress" required>
                <div class="invalid-feedback" id="facaddress-error"></div>
            </div>
            
            
            <div class="mb-3 col">
                <label for="facemail" class="form-label">Email Address</label>
                <input type="email" value="<?php echo $row['facemail'];?>" class="form-control" id="facemail" name="facemail">
                <div class="invalid-feedback" id="facemail-error"></div>
            </div>
            <div class="mb-3 col">
                <label for="facphone" class="form-label">Phone Number</label>
                <input type="tel" value="<?php echo $row['facphone'];?>" class="form-control" minlength=10 maxlength=10 id="facphone" name="facphone" pattern="[0-9]{10}" placeholder="10 digits">
                <div class="invalid-feedback" id="facphone-error"></div>
            </div>
            <button type="submit" id="updatebtn" value="Update" class="end-btn">Update</button>
            <button type="reset" id="resetbtn" value="reset" class="end-btn">Reset</button>

</form>


<?php ?>
</body>
</html>
