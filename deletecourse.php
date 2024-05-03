<?php
require('database.php');

$id=$_REQUEST['id'];
$query = "DELETE FROM courses WHERE id=?"; 
$q=$conn->prepare($query);
$q->execute([$id]);

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet"  href="css/stylesdelete.css">
</head>
<body>
    <div class="popup" id="popup-delete">
        <div class="popup-content">
            <span class="close" id="popup-close">&times;</span>
            <p>Deletion Successful</p>
            <button type="button" name="ok" id="ok">OK</button>
        </div>
    </div>

    <script src="js/scriptdeletecourse.js"></script>
</body>
</html>