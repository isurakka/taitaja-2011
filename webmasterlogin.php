<?php
  session_start();
  $errormsg = "";

	require_once('connectvars.php');
  
  if (!isset($_SESSION['username'])) {
    if (isset($_POST['submit'])) {
		  // Connect to the database
		$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASS)
			or die("Error connecting to the MYSQL server. Please contact the administrator");
		mysql_select_db(DB_NAME);

		$user_username = mysql_real_escape_string(trim($_POST['username']));
		$user_password = mysql_real_escape_string(trim($_POST['password']));
		$pwhash =  hash('sha256', $user_password);

		if (!empty($user_username) && !empty($user_password)) {
        $query = "SELECT username FROM admin WHERE username='$user_username' AND password='" . $pwhash . "'";
		$data = mysql_query($query);
		if (mysql_num_rows($data) == 1) {
		  $row = mysql_fetch_array($data);
		  echo $_SESSION['username'];
		  $_SESSION['username'] = $row['username'];
		  $whatsonurl = "http://" . $_SERVER['HTTP_HOST'] . REDIRECT_LINK . "/whatson.php";
		  header('Location: ' . $whatsonurl);
		  mysql_close($dbc);
		}
		else {
		  $errormsg = 'Invalid Username or Password.';
		}
      }
      else {
        $errormsg = 'Sorry, you must enter your username and password to log in.';
      }
    }
  }
?>

<?php include("includes/doctype.php");?>
<html>
<head>
<?php include("includes/metadata.php");?>
<script type="text/javascript" src="jquery.js"></script>

<title>Login</title>

</head>
<body>
	<table class="siteframe">
		<?php include("includes/header_p1.php");?>
		<img src="images/whatson/whatson_banner.jpg" class="banner"/>
		<?php include("includes/header_p2.php");?>
		<div class="bannertext" align="right">Login</div>
		<?php include("includes/header_p3.php");?>
		<?php include("includes/navigation.php");?>
		<td class="content">
			<table class="contenttable">
				<tr>
					<td>
						<h1 class="contenttitle" id="requesttitle">Login with your credentials</h1>
						<table class="requesttable">
							<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="loginform">
								<tr>		
									<td>
										<label for="username" class="requestlabel">Username:</label>
									</td>
									<td>
										<input type="text" id="username" name="username"/>
									</td>
								</tr>
								<tr>
									<td>
										<label for="password" class="requestlabel">Password:</label>
									</td>
									<td>
										<input type="password" id="password" name="password"/>
									</td>
								</tr>
								<tr>
									<td rowspan="2" valign="top">
										<input type="submit" value="Login" name="submit" id="login" class="button"/>
									</td>
								</tr>
								<tr rowspan="2">
									<td rowspan="2">
										<p class="loginerror">
										<?php  
											if (empty($_SESSION['username']))
											{
												echo $errormsg;
											}
											else
											{
												echo ('You are logged in as ' . $_SESSION['username']);
											}
										?>
										</p>
									</td>
								</tr>
							</form>						
						</table>
					</td>
				</tr>
			</table>
		<?php include("includes/footer_p1.php");?>
		</td>
		<?php include("includes/footer_p2.php");?>
	</table>
	<script type = "text/javascript" src="requestvalidation.js"></script>
</body>
</html>