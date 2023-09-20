<?php 
session_start();
include '../db.php'; ?>

<?php

if(isset($_POST['submit'])){

$name=$_POST['name'];
$password=trim($_POST['password']);
$email=trim($_POST['email']);
$sapid=trim($_POST['sapid']);
$contact=trim($_POST['contact']);
$dept=trim($_POST['dept']);
$cgpa=trim($_POST['cgpa']);
// $file=trim($_POST['file']);
// $_SESSION['file']=$file;
//$number = 12345;
// $length = strlen((string)$contact1);

// if($length==10){
// 	$contact=$contact1;
// }else{

// }

$error=[

'name'=>'',
'email'=>'',
'password'=>'',
'sapid'=>'',
'contact'=>'',
'dept'=>'',
'cgpa'=>'',
// 'file'=>'',



];


if($name=='')	{
	$error['username']="Username is Empty";
}
if($password=='')	{
	$error['password']="Password is Empty";
}
if($email=='')	{
	$error['email']="Email is Empty";
}
if($sapid=='')	{
	$error['sapid']="SAP ID is Empty";
}
if($contact=='')	{
	$error['contact']="Contact is Empty";
}
if($dept=='')	{
	$error['dept']="Department is Empty";
}
if($cgpa=='')	{
	$error['cgpa']="CGPA is Empty";
}
// if($file=='')	{
// 	$error['file']="FILE is Empty";
// }



foreach ($error as $key => $value) {

if(empty($value)){


	unset($error[$key]);


}

}


if(!empty($error)){


?>
<script>
	alert('Incomplete Credentials');
</script>
<?php


}else{


	$cquery="SELECT * FROM student WHERE sapid='{$sapid}'";
	$cresult=mysqli_query($connection,$cquery);
	if(mysqli_num_rows($cresult)==0){

		$the_password=crypt($password,'123abc');
		$query="INSERT INTO student(name,email,contact,password,cgpa,sapid,dept) VALUES('$name','$email','$contact','$the_password','$cgpa','$sapid','$dept')";
		$result=mysqli_query($connection,$query);
		header("Location:./login.php");

		if(!$result){

				die('Query Failed '.mysqli_error($connection));
			}

  }else{
		?>
		<script>
			alert('SAP ID already Registered!!');

		</script>

		<?php
	}


}

}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<!--favicon-->
        <link rel="icon" href="../mlogo.ico" >
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Student Register</title>
        <meta name="description" content="">
        <meta name="author" content="templatemo">
	    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700' rel='stylesheet' type='text/css'>
	    <link href="css/font-awesome.min.css" rel="stylesheet">
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/templatemo-style.css" rel="stylesheet">
		<!-- Footer -->
        <link type="text/css" rel="stylesheet" href="../css/style.css">

	</head>
	<body class="light-gray-bg">

		<div class="templatemo-content-widget templatemo-login-widget white-bg">
			<header class="text-center">
	          <div class="square"></div>
	          <h1>Student Register</h1>
	        </header>
	        <form method="POST" class="templatemo-login-form" action="register.php">
	        	<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
		              	<input type="text" name="name" class="form-control" placeholder="Name" >
		          	</div>
	        	</div>
				<div class="form-group">
	        		<div class="input-group">
		        		<div class="input-group-addon">@</div>
		              	<input type="email" name="email" class="form-control" placeholder="Email" >
		          	</div>
	        	</div>

				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon">#</div>
								<input type="text" name="sapid" class="form-control" placeholder="SAP ID" >
						</div>
	       </div>

				 <div class="form-group">
 					<div class="input-group">
 						<div class="input-group-addon">%</div>
 								<input type="text" name="cgpa" class="form-control" placeholder="CGPA" >
 						</div>
 	       </div>

				 <div class="form-group">
 					<div class="input-group">
 						<div class="input-group-addon"><i class="fa fa-phone fa-fw"></i></div>
 								<input type="tel" name="contact" class="form-control" placeholder="contact"  maxlength="10" minlength="10" pattern="[0-9]+">
 						</div>
 	       </div>

				 <div class="form-group">
						<div class="input-group">
							<div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
									<input type="password" name="password" class="form-control" placeholder="******" >
							</div>
					</div>


					<div class="form-group">
					<label class="control-label templatemo-block">Department</label>
					<select class="form-control" name="dept">
						<option value="Computer">Computer Science</option>
						<option value="aeronautic">Aeronautic</option>
						<option value="mechatronic">Mechatronic</option>
						<option value="IS">IS</option>
						<option value="AI">AI</option>
						<option value="civil">Civil</option>
						<option value="Mechanical">Mechanical</option>
						<option value="Electronic">Electronic</option>
						<option value="Chemical">Chemical</option>
					</select>
				</div>
				<!-- <div class="form-group">
				<label class="control-label templatemo-block">Resume</label>
						<div class="input-group">
							 <div class="input-group-addon">Resume</div>
								<input type="file" name="file" class="form-control" placeholder="file" >
						</div>
				</div> -->

				<div class="form-group">
					<button type="submit" name="submit" class="templatemo-blue-button width-100">Register</button>
				</div>
	        </form>
		</div>

		<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
			<p>Have an Account? <strong><a href="login.php" class="blue-text">Sign in here!</a></strong></p>
		</div>
		<!--footer-->
	<?php include 'footer.php'; ?>
	</body>
</html>
