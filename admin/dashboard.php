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
        <section class="dashboard">
            <h1 class="heading"> Dashboard </h1>

            <div class='box-container'>
                <div class='box'>
                    <h3>Welcome!!</h3>
                    <p><?= $fetch_profile['faculty_name']; ?></p>
                    <a href="profile.php" class="btn">View Profile</a>
                </div>
                <div class='box'>
                    <h3><?= $total_contents; ?></h3>
                    <p>Total Contents</p>
                    <a href="add_content.php" class="btn">Add new Content</a>
                </div>
                <div class='box'>
                    <h3><?= $total_playlists; ?></h3>
                    <p>Total Playlists</p>
                    <a href="add_playlists.php" class="btn">Add new Playlists</a>
                </div>
                <div class='box'>
                    <h3><?= $total_likes; ?></h3>
                    <p>Total Likes</p>
                    <a href="contents.php" class="btn">View Contents</a>
                </div>
                <div class='box'>
                    <h3><?= $total_comments; ?></h3>
                    <p>Total Comments</p>
                    <a href="comments.php" class="btn">View Comments</a>
                </div>
                <div class='box'>
                    <h3>Quick Start</h3>
                    <div class="flex-btn">
                        <a href="login.php" class="btn" style="width:200px">Login Now</a>
                        <a href="register.php" class="btn" style="width:200px">Register Now</a>

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