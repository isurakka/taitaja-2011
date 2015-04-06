<?php include("includes/doctype.php");?>
<html>
<head>
<?php include("includes/metadata.php");?>

<title>Request More Information</title>

</head>
<body>
	<table class="siteframe">
		<?php include("includes/header_p1.php");?>
		<img src="images/thingstodo/thingstodo_banner.jpg" class="banner"/>
		<?php include("includes/header_p2.php");?>
		<div class="bannertext" align="right">Request More Information</div>
		<?php include("includes/header_p3.php");?>
		<?php include("includes/navigation.php");?>
		<td class="content">
			<table class="contenttable">
				<tr>
					<td>
						<?php
							$name = $_POST["name"];
							$email = $_POST["email"];
							$request = $_POST["request"];
							
							require_once('connectvars.php');
							
							function checkForm($name,$email,$request)
							{
								$valid = true;
								if(strlen($name) < 2)
								{
									echo '<p class="contenttext">Your name is too short.</p>';
									$valid = false;
								}
								
								if(strlen($email) < 5)
								{
									echo '<p class="contenttext">Your email is too short.</p>';
									$valid = false;
								}
								
								if(strlen($request) < 3)
								{
									echo '<p class="contenttext">Your request is too short.</p>';
									$valid = false;
								}
								return $valid;
							}
							
							if (!checkForm($name,$email,$request))
							{
								return;
							}
							else
							{							
								$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)
									or die("Error connecting to the MYSQL server. Please contact the administrator");
									
								if(function_exists("mysqli_real_escape_string"))
								{
									$name = mysqli_real_escape_string($dbc, $name);
									$email = mysqli_real_escape_string($dbc, $email);
									$request = mysqli_real_escape_string($dbc, $request);
								}
									
								$query = "INSERT INTO request (counterID, name, email, request) " .
									"VALUES (null, '$name', '$email', '$request')";
									
								$result = mysqli_query($dbc, $query)
									or die("Error querying database. Please contact the administrator");
									
								mysqli_close($dbc);
							}
						?>
						<h1 class="contenttitle">Your request has been sent</h1>
						<p class="contenttext">Thank you for your request. We will contact you as soon as possible.</p>
					</td>
				</tr>
			</table>
		<?php include("includes/footer_p1.php");?>
		</td>
		<?php include("includes/footer_p2.php");?>
	</table>
</body>
</html>
