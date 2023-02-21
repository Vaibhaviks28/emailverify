<?php 

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {

	$email = $_POST['email'];

		$sql = "SELECT * FROM registration WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if ($result->num_rows > 0) {
			if ($result) {

                $userdata = mysqli_fetch_array($result);

                $username = $userdata['username'];
                $token = $userdata['token'];



				$subject = "Email Reset Link";
				$body = "Hi $username,Click here to Reset your Account http://localhost/emailverify/reset_password.php?token=$token ";
				$headers = "From: kshirsagarvaibhavi28@gmail.com";
				
				if (mail($email, $subject, $body, $headers)) 
				{
					$_SESSION['msg']="Check Your Mail to Reset your Account $email";
					header('location:index.php');
				} else {
					echo "Email sending failed...";
				}

				$email = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
        }else{
            echo "<script>alert('No Email Found`.')</script>";
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

	<title>Recover email Form</title>
</head>
<body>
	<div class="container">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?> " method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Recover Email</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Send Mail</button>
			</div>
			<p class="login-register-text">Have an account? <a href="index.php">Login Here</a>.</p>
		</form>
	</div>
</body>
</html>