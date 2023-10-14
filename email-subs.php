<?php 

if(isset($_POST['submit'])){


    $host      =      's71.edcviit.com';
    $dbname    =      'nyuvbmwh_subscribers';
    $dbuser    =      'nyuvbmwh_admin20';
    $dbpass    =      'A8-kJBS)7-6^';
    $tbname    =      'email_list';


	$conn = mysqli_connect($host,$dbuser,$dbpass,$dbname);
	$name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
 
	//Email
	$query_email = "SELECT * FROM `$tbname` WHERE email ='$email' ";

	$result_email = $conn->query($query_email);

	$client_email = $result_email->fetch_array();

	if($client_email)
	{
	$msg='<div class="msg-mailsb msg-mail-red">Your email '.$email.' already exists. Please check email</div> ';

	}else { 
	$sql = "INSERT INTO `email_list` (`id`, `name`, `email`) VALUES (NULL, '$name', '$email')";

	$conn->query($sql);
	
	$msg= '<div class="msg-mailsb msg-mail-green">
						Thanks '.$name.' for Share Your Email '.$email.' .<br>
						Please wait we send a special offer for you.<br>
						<span class="mailsub-goback-btn"><a href="javascript:window.history.go(-1);">Click here</a></span>  return to the recent page you were browsing.
					</div> ';
}
}


?>
<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Email Subs </title>

		<body>

			<h2>Email Subs Form</h2>

			<p><?php if(isset($_POST['submit'])){  echo $msg; } ?></p>

			<form action="" method="POST" accept-charset="utf-8">

				<input type="text" name="name" required>

				<input type="email" name="email" required>

				<input type="submit" name="submit" value="submit">
				
			</form>


		</body>
</html>