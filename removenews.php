<?php session_start();
  require_once('connectvars.php');

  if(!isset($_SESSION['username']))
  {
	$whatsonurl = "http://" . $_SERVER['HTTP_HOST'] . REDIRECT_LINK . "/whatson.php";
	header('Location: ' . $whatsonurl);
	exit;
  }
  
  if (isset($_GET['id'])) {
    // Grab the score data from the POST
    $id = $_GET['id'];
		
	// Move the file to the target upload folder
	// Connect to the database
	$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASS)
		or die("Error connecting to the MYSQL server. Please contact the administrator");
	mysql_select_db(DB_NAME);

	$id = mysql_real_escape_string($id);
	
	$fileQuery = "SELECT picture FROM newsitem WHERE newsitemID='" . $id . "'";
	$result = mysql_query($fileQuery)
		or die("Error querying database. Please contact the administrator");
	
	while ($fileRow = mysql_fetch_array($result))
	{
		$target = "images/news/" . $fileRow['picture'];
		if (file_exists($target))
		{
			unlink($target);
		}
	}

	// Write the data to the database
	$query = "DELETE FROM newsitem WHERE newsitemID='" . $id . "'";
	$result = mysql_query($query)
		or die("Error querying database. Please contact the administrator");
		
	
	$newsData = mysql_query($newsQuery);
		
	mysql_close($dbc);
	
	$whatsonurl = "http://" . $_SERVER['HTTP_HOST'] . REDIRECT_LINK . "/whatson.php";
	header('Location: ' . $whatsonurl);
	
	mysql_close($dbc);
  }
?>

<?php include("includes/doctype.php");?>
<html>
<head>
<?php include("includes/metadata.php");?>

<title>Remove News</title>

</head>
<body>
	<table class="siteframe">
		<?php include("includes/header_p1.php");?>
		<img src="images/whatson/whatson_banner.jpg" class="banner"/>
		<?php include("includes/header_p2.php");?>
		<div class="bannertext" align="right">Remove News</div>
		<?php include("includes/header_p3.php");?>
		<?php include("includes/navigation.php");?>
		<td class="content">
			<table class="contenttable">
				<tr>
					<td>
						<h1 class="contenttitle" id="requesttitle">Removing news...</h1>
					</td>
				</tr>
			</table>
		<?php include("includes/footer_p1.php");?>
		</td>
		<?php include("includes/footer_p2.php");?>
	</table>
</body>
</html>