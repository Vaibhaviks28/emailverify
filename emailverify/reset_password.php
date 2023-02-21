<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) 
{
    if(isset($_GET['token']))
    {
        $token = $_GET['token'];

	$newpassword = ($_POST['password']);
	$cpassword = ($_POST['cpassword']);

	if ($newpassword == $cpassword) 
    {
        $sql = " UPDATE registration SET password='$newpassword' WHERE token= '$token' ";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $_SESSION['msg'] = " Your Password has been Updated";
            header('location:index.php');


				$_POST['password'] = "";
				$_POST['cpassword'] = "";
		} 
        else 
        {
            $_SESSION['passmsg'] = " Your Password is not Updated";
            header('location:reset_password.php');

		}
	} 
    else 
    {
        $_SESSION['passmsg'] = " Password not Matched";
		//echo "<script>alert('Password Not Matched.')</script>";
	}
    }else{
        echo "<script>alert('No Token Found.')</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="style.css">

	<title>Register Form</title>
</head>
<body>
	<div class="container">

        <p> <?php 
        if(isset($_SESSION['passmsg'])){
            echo $_SESSION['passmsg'];
        }else{
            echo $_SESSION['passmsg'] = " "; 
        }

        ?>  </p>
        

		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Update Password</p>
			<div class="input-group">
				<input type="password" placeholder="New Password" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Update</button>
			</div>
			<p class="login-register-text">Have an account? <a href="index.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>