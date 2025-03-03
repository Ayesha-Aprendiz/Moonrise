<?php 
    include '../Components/connect.php';

    if(isset($_COOKIE['faculty_id'])){
        $faculty_id =  $_COOKIE['faculty_id'];
    }else{
        $faculty_id='';
        header('location: login.php');
    }

    if(isset($_POST['submit'])){
        $select_faculty = $conn->prepare("SELECT * FROM `faculties` WHERE faculty_id = ? LIMIT 1");
        $select_faculty->execute([$faculty_id]);
        $fetch_faculty = $select_faculty->fetch(PDO::FETCH_ASSOC);

        $prev_pass = $fetch_faculty['passwd'];
        $prev_prof = $fetch_faculty['profile_image'];

        $name = $_POST['name'];
        $profession = $_POST['profession'];
        $email = $_POST['email'];

        if(!empty($name)){
            $update_name = $conn->prepare("UPDATE `faculties` SET faculty_name = ? WHERE faculty_id = ?");
            $update_name->execute([$name,$faculty_id]);
            echo "<script>alert('Username Updated Successfully.');</script>";
        }
        if(!empty($profession)){
            $update_profession = $conn->prepare("UPDATE `faculties` SET profession = ? WHERE faculty_id = ?");
            $update_profession->execute([$profession,$faculty_id]);
            echo "<script>alert('User profession Updated Successfully.');</script>";
        }
        if(!empty($email)){
            $select_email = $conn->prepare("SELECT * FROM `faculties` WHERE faculty_id = ? AND email = ?");
            $select_email->execute([$faculty_id,$email]);

            if($select_email->rowCount() > 0){
                echo "<script>alert('Email Already Taken.');</script>";
            } 
            else{
                $update_email = $conn->prepare("UPDATE `faculties` SET email = ? WHERE faculty_id = ?");
                $update_email->execute([$email,$faculty_id]);
                echo "<script>alert('User email Updated Successfully.');</script>";
            }
        }
        //update profile image

        $image = $_FILES['image']['name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/'.$rename;

        if(!empty($image)){
            if($image_size > 2000000){
                echo "<script>alert('Image size too large.');</script>";      
            } 
            else{
                $update_image = $conn->prepare("UPDATE `faculties` SET `profile_image` = ? WHERE faculty_id = ? ");
                $update_image->execute([$rename, $faculty_id]);
                move_uploaded_file($tmp_name, $image_folder);
                if($prev_prof != '' AND $prev_prof != $rename){
                    unlink('../uploaded_files/'.$prev_prof);
                }
                echo "<script>alert('Image Updated Successfully.');</script>";
            }
        }
        //update password
        $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
        $old_pass = sha1($_POST['old_pass']);
       
        $new_pass = sha1($_POST['new_pass']);
       
        $cpass = sha1($_POST['c_pass']);
        

        if($old_pass != $empty_pass){
            if($old_pass != $prev_pass){
                echo "<script>alert('Old Password not Matched.');</script>";
            } elseif ($new_pass != $cpass){
                echo "<script>alert('Confirm Password not Matched.');</script>";
            } else{
                if($new_pass != $empty_pass){
                    $update_pass = $conn->prepare("UPDATE `faculties` SET passwd = ? WHERE faculty_id = ?");
                    $update_pass->execute([$cpass, $faculty_id]);
                    echo "<script>alert('Password Updated Successfully.');</script>";
                } else{
                    echo "<script>alert('Please Enter a new Password.');</script>";
                }
            }
        }
    }

?>
    <style>
        <?php include '../css/admin_style.css'; ?>
    </style>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profile </title>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap');
    </style> 
    <!-- Boxicon link --> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    </head>

    <body>
    <?php include '../Components/admin_header.php'; ?>
        <!-- <div class='form-container'> -->
        <div class='form-container' style="min-height:calc(100vh - 19rem); padding: 6rem 0;">
            <form action="" method="post" enctype="multipart/form-data" class="update">
                <h3>Update Profile</h3>
                <div class="flex">
                    <div class="col">
                        <p>Your Name <span>*</span></p>
                        <input type="text" name="name" placeholder="<?= $fetch_profile['faculty_name'] ?>" maxlength="50" 
                        required class="box">
                        <p>Old Password <span>*</span></p>
                        <input type="password" name="old_pass" placeholder="Enter Your Old Password" maxlength="20"
                        required class="box">
                        
                        <p>Your Profession <span>*</span></p>
                        <select name="profession" required class="box">
                            <option value="" disabled selected>"<?= $fetch_profile['profession'] ?>"</option>
                            <option value="Web developer">Developer</option>
                            <option value="UX/UI Designer">UX/UI Designer</option>
                            <option value="Data Analyst">Data Analyst</option>
                            <option value="Software Engineer">Software Engineer</option>
                            <option value="Full Stack Developer">Full Stack Developer</option>
                            <option value="E-commerce Specialist">E-commerce Specialist</option>
                            <option value="Network Engineer">Network Engineer</option>
                        </select>
                    </div>
                    <div class="col">
                    <p>Your Email <span>*</span></p>
                        <input type="email" name="email" placeholder="<?= $fetch_profile['email'] ?>" maxlength="50" 
                        required class="box">
                        
                        <p>New Password <span>*</span></p>
                        <input type="password" name="new_pass" placeholder="Enter Your New Password" maxlength="20"
                        required class="box">
                        <p>Confirm Password <span>*</span></p>
                        <input type="password" name="c_pass" placeholder="Confirm Your Password" maxlength="20"
                        required class="box">
                        
                    </div>
                    
                </div>
                <p>Update Profile Image <span>*</span></p>
                <input type="file" name="image" accept="image/*"
                required class="box">
                <input type="submit" name="submit" class="btn" value="Update Profile">
            </form>
        </div>
        <?php include '../Components/footer.php'; ?>
        <script type="text/javascript" >
            <?php include '../js/admin_script.js'; ?>
        </script> 
    </body>

</html>