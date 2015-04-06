<?php session_start();
  require_once('connectvars.php');
  
   if(!isset($_SESSION['username']))
  {
	$whatsonurl = "http://" . $_SERVER['HTTP_HOST'] . REDIRECT_LINK . "/whatson.php";
	header('Location: ' . $whatsonurl);
	exit;
  }

  $error_msg;
  
  if (isset($_POST['submit'])) {
    // Grab the score data from the POST
    $title = $_POST['title'];
    $text = $_POST['text'];
	$category = $_POST['category'];
    $picture = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_size = $_FILES['picture']['size']; 
	
	function validateTitle($title)
	{
		/*
		$LINELEN = 300;
		$remaintext = $text;
		$textlen = strlen($remaintext);
		$readamount = 0;
		$finaltext = "";
		
		while ($readamount < $textlen)
		{
			if ($textlen <= $LINELEN)
			{
				$nextsublen = $textlen;
			}
			else
			{
				$nextsublen = $LINELEN;
			}
			$subtext = substr($remaintext, 0, $nextsublen);
			
			if (!stristr($subtext, " "))
			{
				$finaltext = $finaltext + $subtext + " ";
			}
			else
			{
				$finaltext = $finaltext + $subtext;
			}
			$readamount = $readamount + $nextsublen;
			$remaintext = substr($remaintext, 0, $nextsublen);
		}
		return $finaltext;
		*/
		
		return substr($title, 0, 48);
	}
	
    if (!empty($title) & !empty($text) & !empty($picture)) {
      if ((($picture_type == 'image/gif') || ($picture_type == 'image/jpeg') || ($picture_type == 'image/pjpeg') || ($picture_type == 'image/png'))
        && ($picture_size > 0) && ($picture_size <= 5242880)) {
        if ($_FILES['screenshot']['error'] == 0) {
          // Move the file to the target upload folder
          $target = "images/news/" . $picture;
          if (move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
            // Connect to the database
            $dbc = mysql_connect(DB_HOST, DB_USER, DB_PASS)
				or die("Error connecting to the MYSQL server. Please contact the administrator");
			mysql_select_db(DB_NAME);
			
			$title = validateTitle($title);
			
			$title = mysql_real_escape_string($title);
			$text = mysql_real_escape_string($text);
			$category = mysql_real_escape_string($category);
			$picture = mysql_real_escape_string($picture);
			
            // Write the data to the database
            $query = "INSERT INTO newsitem (newsitemID, title, text, categoryID, picture) " .
				"VALUES (null, '$title', '$text', '$category', '$picture')";
            $result = mysql_query($query)
				or die("Error querying database. Please contact the administrator");

            mysql_close($dbc);
			$whatsonurl = "http://" . $_SERVER['HTTP_HOST'] . REDIRECT_LINK . "/whatson.php";
			header('Location: ' . $whatsonurl);
          }
          else {
            $error_msg = "Sorry, there was a problem uploading your picture.</p>";
          }
        }
      }
      else {
        $error_msg = "The picture must be a GIF, JPEG, or PNG image file no greater than " . (5242880 / 1024000) . " MB in size.";
      }
      // Try to delete the temporary screen shot image file
      @unlink($_FILES['picture']['tmp_name']);
	  mysql_close($dbc);
    }
    else {
      $error_msg = "Please enter all of the information to add news.";
    }
  }
?>

<?php include("includes/doctype.php");?>
<html>
<head>
<?php include("includes/metadata.php");?>

<title>Add News</title>

</head>
<body>
	<table class="siteframe">
		<?php include("includes/header_p1.php");?>
		<img src="images/whatson/whatson_banner.jpg" class="banner"/>
		<?php include("includes/header_p2.php");?>
		<div class="bannertext" align="right">Add News</div>
		<?php include("includes/header_p3.php");?>
		<?php include("includes/navigation.php");?>
		<td class="content">
			<table class="contenttable">
				<tr>
					<td>
						<h1 class="contenttitle" id="requesttitle">Please fill the form below to add news</h1>
						<table class="addnewstable">
							<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" id="loginform" enctype="multipart/form-data">
								<tr>				
									<td>
										<label for="title" class="requestlabel">Title:</label>
									</td>
									<td>
										<input type="text" id="title" name="title"/>
									</td>
								</tr>
								<tr valign="top">
									<td>
										<label for="text" class="requestlabel">Text:</label>
									</td>
									<td>
										<textarea rows="25" cols="80" type="text" id="text" name="text"></textarea>
									</td>
								</tr>
								<tr>
									<td>
										<label for="category" class="requestlabel">Category:</label>
									</td>
									<td>
										<select name="category" id="category">
										<option value="1">Exhibitions</option>
										<option value="2">Festivals</option>
										<option value="3">Performing Arts</option>
										<option value="4">Sports</option>
									</td>
								</tr>
								<tr>
									<td>
										<label for="picture" class="requestlabel">Picture:</label>
									</td>
									<td>
										<input type="file" id="picture" name="picture" />
									</td>
								</tr>
								<tr>
									<td valign="top">
										<input type="submit" value="Save" name="submit" id="btnSaveNews" class="button"/>
									</td>
									<td>
										<p class="loginerror">
										<?php
											echo $error_msg;
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
		<tr>
			<td class="footerbar">
				<table class="whatsonfooterbar">
					<tr>
						<td class="whatsonfooterbar" align="left">
							<?php
								if (!empty($_SESSION['username']) or isset($_SESSION['username']))
								{
									echo "<a href='addnews.php' class='webmasteraddlink'>Add News</a>";
								}
							?>
						</td>
						<td class="whatsonfooterbar" align="right">
							<?php
								if (empty($_SESSION['username']) or !isset($_SESSION['username']))
								{
									echo "<a href='webmasterlogin.php' class='webmasterloginlink'>Login</a>";
								}
								else
								{
									echo "<span class='webmastertext'>You are logged in as " . $_SESSION['username'] . " </span>";
									echo "<a href='webmasterlogout.php' class='webmasterloginlink'>Logout</a>";
								}
							?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>