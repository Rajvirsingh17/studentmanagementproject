<?php
require('database.php');

$id=$_REQUEST['id'];
$query = "DELETE FROM student_details WHERE id=?"; 
$q=$conn->prepare($query);
$q->execute([$id]);

?>
<!DOCTYPE html>
<html>
<head>
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

    <script src="js/scriptdelete.js"></script>
</body>
</html>

