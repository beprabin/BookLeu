<?php
    include 'config.php';

    if(isset($_POST['submit'])){
        $name= mysqli_real_escape_string($conn,$_POST['name']);
        $email= mysqli_real_escape_string($conn,$_POST['email']);
        $pass= mysqli_real_escape_string($conn,md5($_POST['password']));
        $cpass= mysqli_real_escape_string($conn,md5($_POST['cpassword']));
        $user_type=$_POST['user_type'];

        $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email='$email' AND password='$pass'") or die('query failed');
        
        if(0< mysqli_num_rows($select_users)){
            $message[]= 'User alerady exist';
        }else{
            if($pass!=$cpass){
                $message[]= 'Confirm password not matched!';
            }else{
                mysqli_query($conn,"INSERT INTO `users` (name,email,password,user_type) VALUES ('$name','$email','$cpass','$user_type')") or die('query failed');
                $message[]= 'Registered Succsssfully!';
                
            }
        }
    }   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Font awesome cnd link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom file for css-->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
        <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '
                    <div class="message">
                        <span>'.$message.'</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                    </div>
                    ';
                }
            }
        ?>
        <div class="form-container">
            <form action="" method="post">
                <h3>Register Now</h3>
                <input type="text" name="name" placeholder="Your Name" required class="box">
                <input type="emaial" name="email" placeholder="Your Email" required class="box">
                <input type="password" name="password" placeholder="Your Password" required class="box">
                <input type="password" name="cpassword" placeholder="Confirm Password" required class="box">
                <select name="user_type" id="" class="box">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <input type="submit" name="submit" value="register now" class="btn">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
</body>
</html>