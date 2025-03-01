<?php

    if(isset($message))
    {
        foreach ($message as $message)
        {
            echo '
            <div class="message">
                <span>'.$message.'</span>
                <i class="bx bx-x" onclick="this.parentElement.remove()"> </i>
            </div>
            
            ';
        }
    }
    if(isset($_COOKIE['faculty_id'])){
     
        $faculty_id = $_COOKIE['faculty_id'];
        echo "<script>console.log('Retrieved faculty_id from cookie: " . $faculty_id . "');</script>"; // Debugging
    } else {
        $faculty_id = '';
    }
?>
<header class="header">
    <section class="flex">
        <a href="dashboard.php">
            <img src="../images/logofinal.png"  width="130px"  > 
        </a>
        <form action="search_page.php" method="post" class="search-form">
            <input type="text" name="search" placeholder="search here.."
            required maxlength="100">
            <button type="submit" class="bx bx-search-alt-2" name="search-btn"></button>
        </form>
        <div class="icons">
            <div id="menu-btn" class="bx bx-list-plus"> </div>
            <div id="search-btn" class="bx bx-search-alt-2"></div>
            <div id="user-btn" class="bx bxs-user"></div>
        </div>

        <div class="profile">
            <?php
            
                $select_profile = $conn->prepare("SELECT * From `faculties` WHERE faculty_id = ? ");
                $select_profile->execute(array($faculty_id));

                

                if($select_profile->rowCount() > 0){ 
                $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

                echo "<script>console.log('Retrieved faculty_id from cookie: " . $fetch_profile['faculty_name'] . "');</script>"; // Debugging

            ?>
            <img src="../uploaded_files/<?php echo $fetch_profile['profile_image']; ?>">
            <h3><?php echo $fetch_profile['faculty_name']; ?>  <br/>
            <?php echo $fetch_profile['profession']; ?></h3> <br/>

            <div id="flex-btn">
                <a href="profile.php" class="btn"> View Profile</a>
                <a href="../Components/admin_logout.php" onclick="return confirm('logout from this website?');" class="btn"> Logout </a>
            </div>
            <?php
                }
                else{
            ?>
            <h3> Please Login or Register!!</h3>
            <div id="flex-btn">
                <a href="login.php" class="btn"> Login </a>
                <a href="register.php" class="btn"> Register </a>
            </div>
            <?php
                }
            ?>
        </div>
        
    </section>
</header>
<div class="side-bar">
    <div class="profile">
        <?php
        $select_profile = $conn->prepare("SELECT * From `faculties` WHERE faculty_id = ? ");
        $select_profile->execute(array($faculty_id));
        if($select_profile->rowCount() > 0) { 
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);        
        ?>

            <img src="../uploaded_files/<?php echo $fetch_profile['profile_image']; ?>">
            <h3><?php echo $fetch_profile['faculty_name']; ?>  <br/>
            <?php echo $fetch_profile['profession']; ?></h3> <br/>

            <a href="profile.php" class="btn" > View Profile </a>

        <?php }
        else { ?>
        <h3> Please Login or Register!!</h3>
            <div id="flex-btn">
                <a href="login.php" class="btn"> Login </a>
                <a href="register.php" class="btn"> Register </a>
            </div>
            <?php
                }
            ?>
    </div>
    <nav class="navbar">
        <a href="dashboard.php"><i class = "bx bxs-home-heart" ></i> <span> Home </span></a>
        <a href="playlists.php"><i class = "bx bxs-receipt" ></i> <span> Playlist </span></a>
        <a href="contents.php"><i class = "bx bxs-graduation" ></i> <span> Contents </span></a>
        <a href="comments.php"><i class = "bx bxs-home-heart" ></i> <span> Home </span></a>
        <a href="../Components/admin_logout.php" onclick="return confirm('Logout from this wesbite?');">
            <i class = "bx bxs-log-in-circle" ></i> <span> Logout </span></a>

    </nav>
</div>
