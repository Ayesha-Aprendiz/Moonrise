<?php 
    include '../Components/connect.php';

    if(isset($_POST['submit'])){
        
        $email = $_POST['email'];
        // $email =  htmlspecialchars($email);

        $pass = sha1($_POST['pass']);
        // $pass = htmlspecialchars($pass);

        $select_faculty = $conn->prepare("SELECT * FROM `faculties` WHERE email = ? AND passwd = ? LIMIT 1");
        $select_faculty->execute(array($email, $pass));

        $row = $select_faculty->fetch(PDO::FETCH_ASSOC);
        
        if($select_faculty->rowCount() > 0){
            setcookie('faculty_id', $row['faculty_id'], time() + 60*60*24*30, '/' );
            echo "<script>console.log('Login Successful. faculty_id: " . $row['faculty_id'] . "');</script>"; // Debugging
            header('location:dashboard.php');
        }else{
            echo "<script>alert('Incorrect Email or Password');</script>";
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

    <body  >
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
        <header class="header">
            <section class="flex">
                <img src="../images/logofinal.png"  width="130px" class= 'reg-logo' > 
            </section>
        </header>
        <!-- <img src='../images/logofinal.png'  class="logo"  > -->
        <div class='form-container'>
            <form action="" method="post" enctype="multipart/form-data" class="login">
                <h3>Login Now</h3>
                    <p>Your Email <span>*</span></p>
                    <input type="email" name="email" placeholder="Enter your Email" maxlength="50" 
                    required class="box">
                    <p>Password <span>*</span></p>
                    <input type="password" name="pass" placeholder="Enter Your Password" maxlength="20"
                    required class="box">
                    <p class="link">Don't Have an Account ? <a href="register.php">Register Now</a></p>
                    <input type="submit" name="submit" class="btn" value="Submit">
            </form>
        </div>
    </body>
</html>