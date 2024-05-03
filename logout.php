<!--logout code-->
<?php
session_start();
    session_destroy(); 
    echo "<script>alert('Session Ended');
    window.setTimeout(function() {
        window.location = 'login.php';
      }, 5);</script>";
    exit();
  ?>