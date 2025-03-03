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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap');
    </style> 
    <!-- Boxicon link -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Custom CSS link
     <link rel="stylesheet" type="text/css" href="../css/admin_style.css"> -->

    </head>
    <body>
        <?php include '../Components/admin_header.php'; ?>
        <section class="playlist-form">
            <h1 class="heading"> Create Playlist </h1>

            <form action="" method="post" enctype="multipart/form-data">
                <p>Playlist Status <span>*</span></p>
                <select name="status" class="box">
                    <option value="" selected disabled>----Select Status----</option>
                    <option value="active">active</option>
                    <option value="disable">disable</option>
                </select>
                <p>Playlist Title <span>*</span></p>
                <input type="text" name="title" maxlength="100" required placeholder="Enter Playlist's Title" class="box">
                 <p>Playlist Description <span>*</span></p>
                 <textarea name="description" class="box" placeholder="Write Description" maxlength="1000"
                 cols="30" rows="10"></textarea>
                 <p>Playlist Thumbnail <span>*</span></p>
                 <input type="file" name="image" accept="image/*" required class="box">
                 <input type="submit" name="submit" value="Create Playlist" class="btn">

            </form>

                
        </section>
        <?php include '../Components/footer.php'; ?>
        <script type="text/javascript" >
            <?php include '../js/admin_script.js'; ?>
        </script>  
    </body>
</html>