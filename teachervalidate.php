<?php
session_start();
?>
<?php
include "database.php";
if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);

    if (empty($email)) {
        echo '<script>alert("Email is required")</script>';
        header('refresh:0','url: teacherlogin.php');
        exit();
    }else if(empty($pass)){
        echo '<script>alert("Password is required")</script>';
        header('refresh:0','url: teacherlogin.php');
        exit();
    }else{

        $sql = "SELECT id,facname,facemail,pass FROM faculty WHERE facemail=:email";
        $query= $conn -> prepare($sql);
        $query-> bindParam(':email', $email);
        $query-> execute();
        $results=$query->fetch(PDO::FETCH_ASSOC);
        if($results===false){
            echo "<script>alert('Invalid email ID')
            window.setTimeout(function() {
                window.location = 'teacherlogin.php';
              }, 5);</script>";
            exit();    
        }
        else{ 
            $verifypass=password_verify($pass, $results["pass"]);
          
            if(!$verifypass){
                echo "<script>alert('Invalid Password.')
                window.setTimeout(function() {
                    window.location = 'teacherlogin.php';
                  }, 5);</script>";
                exit();
            }
            else{
                $_SESSION["id"]=$results["id"];
                $_SESSION["name"]= $results["facname"];
                $_SESSION["email"]=$results["facemail"];
                header('location: teacherdashboard.php');
                exit();
            }
        }
    }
}
?>