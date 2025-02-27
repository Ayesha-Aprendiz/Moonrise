<?php 
    include '../components/connect.php';

    if(isset($_POST['submit'])){
        $id = unique_id();
        $name = $_POST['name'];
        // $name =  htmlspecialchars($name);

        $profession = $_POST['profession'];
        // $profession = htmlspecialchars($profession);

        $email = $_POST['email'];
        // $email =  htmlspecialchars($email);

        $pass = sha1($_POST['pass']);
        // $pass = htmlspecialchars($pass);

        $cpass = sha1($_POST['cpass']);
        // $cpass = htmlspecialchars($cpass);

        $image = $_FILES['image']['name'];
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        $rename = unique_id().'.'.$ext;
        $image_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = '../uploaded_files/'.$rename;

        $select_faculty = $conn->prepare("SELECT * FROM `faculties` WHERE email = ? ");
        $select_faculty->execute(array($email));

        if($select_faculty->rowCount() > 0){
            echo "<script>alert('Email Already Exists.');</script>";
        }
        else{
            if($pass != $cpass){
                echo "<script>alert('Password doesnt match.');</script>";
            }else{
                $insert_faculty = $conn->prepare("INSERT INTO `faculties`(faculty_id, faculty_name, profession, email, passwd,
                profile_image ) VALUES(?,?,?,?,?,?)");
                $insert_faculty->execute(array($id, $name, $profession, $email, $cpass, $rename));

                move_uploaded_file($tmp_name, $image_folder);
                echo "<script>alert('New Faculty Registered!! You can Login now.');</script>";
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
    <title> </title>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Font Google -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap');
    </style> 
    <!-- Boxicon link --> 
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    </head>

    <body class="reg-body" >
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
        ?>
        <img src='../images/logofinal.png'  class="logo"  >
        <div class='form-container'>
        
        
            <form action="" method="post" enctype="multipart/form-data" class="register">
                <h3>Register Now</h3>
                <div class="flex">
                    <div class="col">
                        <p>Your Name <span>*</span></p>
                        <input type="text" name="name" placeholder="Enter your Name" maxlength="50" 
                        required class="box">
                        <p>Your Password <span>*</span></p>
                        <input type="password" name="pass" placeholder="Enter Your Password" maxlength="20"
                        required class="box">
                        
                        <p>Your Profession <span>*</span></p>
                        <select name="profession" required class="box">
                            <option value="" disabled selected>--Select your Profession--</option>
                            <option value="developer">Developer</option>
                            <option value="designer">Designer</option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                        

                    </div>
                    <div class="col">
                    <p>Your Email <span>*</span></p>
                        <input type="email" name="email" placeholder="Enter your Email" maxlength="50" 
                        required class="box">
                        
                        <p>Confirm Password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="Confirm Your Password" maxlength="20"
                        required class="box">
                        <p>Profile Image <span>*</span></p>
                        <input type="file" name="image" accept="image/*"
                        required class="box">
                    </div>
                    
                </div>
                <p class="link">Already have an account ? <a href="login.php">Login Now</a></p>
                    <input type="submit" name="submit" class="btn" value="Submit">
            </form>
        </div>

    </body>

</html>