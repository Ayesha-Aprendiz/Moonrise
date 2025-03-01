<?php
    include '../Components/connect.php';

    if(isset($_COOKIE['faculty_id'])){
        $faculty_id =  $_COOKIE['faculty_id'];
    }else{
        $faculty_id='';
        header('location: login.php');
    }

?>
<style type="text/css">
    <?php include '../css/admin_style.css'; ?>
</style>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <!-- Boxicon link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Custom CSS link
     <link rel="stylesheet" type="text/css" href="../css/admin_style.css"> -->

    </head>
    <body>
        <?php include '../Components/admin_header.php'; 
        
        ?>
        <script type="text/javascript" >
            <?php include '../js/admin_script.js'; ?>

        </script>
        
    </body>

</html>