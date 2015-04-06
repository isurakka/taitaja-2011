<?php
  // If the user is logged in, delete the session vars to log them out
  session_start();
  if (isset($_SESSION['username'])) {
	// Delete the session vars by clearing the $_SESSION array
	$_SESSION = array();
	require_once('connectvars.php');
	// Delete the session cookie by setting its expiration to an hour ago (3600)
	if (isset($_COOKIE[session_name()])) {
	  setcookie(session_name(), "", time() - 36000);
	}

	// Destroy the session
	session_destroy();
  }
  // Redirect to the home page
  $whatsonurl = 'http://' . $_SERVER['HTTP_HOST'] . REDIRECT_LINK . '/whatson.php';
  header('Location: ' . $whatsonurl);
?>

<?php include("includes/doctype.php");?>
<html>
<head>
<?php include("includes/metadata.php");?>
<script type="text/javascript" src="jquery.js"></script>

<title>Logout</title>

</head>
<body>
	<table class="siteframe">
		<?php include("includes/header_p1.php");?>
		<img src="images/whatson/whatson_banner.jpg" class="banner"/>
		<?php include("includes/header_p2.php");?>
		<div class="bannertext" align="right">Logout</div>
		<?php include("includes/header_p3.php");?>
		<?php include("includes/navigation.php");?>
		<td class="content">
			<table class="contenttable">
				<tr>
					<td>
						<h1 class="contenttitle" id="requesttitle">Logging you out...</h1>
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