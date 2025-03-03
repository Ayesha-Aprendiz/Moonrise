<?php
    include '../Components/connect.php';

    if(isset($_COOKIE['faculty_id'])){
        $faculty_id =  $_COOKIE['faculty_id'];
    }else{
        $faculty_id='';
        header('location: login.php');
    }

    $select_contents =  $conn->prepare("SELECT * FROM `videos` WHERE faculty_id = ?");
    $select_contents->execute(array($faculty_id));
    $total_contents = $select_contents->rowCount();

    $select_playlists = $conn->prepare("SELECT * FROM `courses` WHERE faculty_id = ?");
    $select_playlists->execute([$faculty_id]);
    $total_playlists = $select_playlists->rowCount();

    $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE faculty_id = ?");
    $select_likes->execute([$faculty_id]);
    $total_likes = $select_likes->rowCount();

    $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE faculty_id = ?");
    $select_comments->execute([$faculty_id]);
    $total_comments = $select_comments->rowCount();
?>
<style type="text/css">
    <?php include '../css/admin_style.css'; ?>
</style>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>faculty profile</title>
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
        <section class="faculty-profile" style="min-height: calc(100vh - 19rem);">
            <h1 class="heading"> Profile Details </h1>

            <div class="details">
                <div class="faculty">
                    <img src="../uploaded_files/<?= $fetch_profile['profile_image']; ?>">
                    <h3> <?= $fetch_profile['faculty_name']?></h3>
                    <span> <?= $fetch_profile['profession']?></span>
                    <a href="update.php" class="btn">Update Profile</a>
                </div>
                <div class="flex">
                    <div class="box">
                        <span> <?= $total_playlists; ?></span>
                        <p>Total Courses</p>
                        <a href="playlists.php" class="btn">View Playlists</a>
                    </div>
                    <div class="box">
                        <span> <?= $total_contents; ?></span>
                        <p>Total Videos</p>
                        <a href="contents.php" class="btn">View Contents</a>
                    </div>
                    <div class="box">
                        <span> <?= $total_likes; ?></span>
                        <p>Total Likes</p>
                        <a href="contents.php" class="btn">View Contents</a>
                    </div>
                    <div class="box">
                        <span> <?= $total_comments; ?></span>
                        <p>Total Comments</p>
                        <a href="comments.php" class="btn">View Comments</a>
                    </div>

                </div>
            </div>

            
        </section>
        <?php include '../Components/footer.php'; ?>
        <script type="text/javascript" >
            <?php include '../js/admin_script.js'; ?>
        </script>  
    </body>
</html>