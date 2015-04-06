<?php session_start(); require_once('connectvars.php');  include("includes/doctype.php");?>
<html>
<head>
<?php include("includes/metadata.php");?>
<script type="text/javascript" src="jquery.js"></script>

<title>What's On</title>

</head>
<body>
	<table class="siteframe">
		<?php include("includes/header_p1.php");?>
		<img src="images/whatson/whatson_banner.jpg" class="banner"/>
		<?php include("includes/header_p2.php");?>
		<div class="bannertext" align="right">What's On</div>
		<?php include("includes/header_p3.php");?>
		<?php include("includes/navigation.php");?>
		<td class="content">
			<table class="contenttable">
				<tr>
					<td>
						<h1 id="whatsontitle" class="contenttitle">Click the category you're interested in to see what's on</h1>
					</td>
				</tr>
				<tr>
					<td>
						<input type="submit" value="Go Back" name="ok" id="btnBack" class="button"/>
						<table class="whatson" id="whatson">
							<tr id="trExh">
								<td>
									<img src="images/whatson/whatson_button_exhibitions.png" class="whatson" id="imgExh"/>
								</td>
								<td class="whatsontextblock">
									<h1 class="contenttitle" id="titleExh">Exhibitions</h1>
									<p class="whatsontext" id="textExh">
										Australia hosts many international exhibitions and trade shows every year, in a wide range of industries from medical to manufacturing, agriculture to leisure. Attending an international trade show as an exhibitor or a buyer could provide the perfect opportunity to visit Australia. 
									</p>
								</td>
							</tr>
							<tr rowspan="2"><td class="whatsonmargin"></td></tr>
							<tr id="trFes">
								<td>
									<img src="images/whatson/whatson_button_festivals.png" class="whatson" id="imgFes"/>
								</td>
								<td class="whatsontextblock">
									<h1 class="contenttitle" id="titleFes">Festivals</h1>
									<p class="whatsontext" id="textFes">
										Australians are a nation of festival-goers, always keen to celebrate the nation's comedy and arts, food and wine, music and culture, sport and heritage.Sydney, Melbourne, Perth, Adelaide and Canberra each boast major arts festivals which spotlight the best in dance, jazz, theatre, opera and more. 
									</p>
								</td>
							</tr>
							<tr rowspan="2"><td class="whatsonmargin"></td></tr>
							<tr id="trPer">
								<td>
									<img src="images/whatson/whatson_button_performingarts.png" class="whatson" id="imgPer"/>
								</td>
								<td class="whatsontextblock">
									<h1 class="contenttitle" id="titlePer">Performing arts</h1>
									<p class="whatsontext" id="textPer">
										A vigorous and innovative landscape of performing arts covers the length and breadth of Australia. Nurtured in schools, Australian performing artists have the world as their stage, particularly in cinema. Indigenous music and dance, ballet, theatre, opera and rock 'n' roll all have their pride of place. 
									</p>
								</td>
							</tr>
							<tr rowspan="2"><td class="whatsonmargin"></td></tr>
							<tr id="trSpo">
								<td>
									<img src="images/whatson/whatson_button_sports.png" class="whatson" id="imgSpo"/>
								</td>
								<td class="whatsontextblock">
									<h1 class="contenttitle" id="titleSpo">Sports</h1>
									<p class="whatsontext" id="textSpo">
										Australians are among the most enthusiastic of participants and spectators in sport. Whether it's a casual game of beach volleyball, the emotion of an Aussie Rules football match or the excitement of the racecourse on Melbourne Cup Day, there is always an opportunity to join in the fun. 
									</p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<?php
							// Connect to the database 
							$dbc = mysql_connect(DB_HOST, DB_USER, DB_PASS)
								or die("Error connecting to the MYSQL server. Please contact the administrator");
							mysql_select_db(DB_NAME);
							
							$catQuery = "SELECT * FROM category";
							$catData = mysql_query($catQuery);
							
							while ($catRow = mysql_fetch_array($catData))
							{
								$newsQuery = "SELECT * FROM newsitem WHERE categoryID = " . $catRow['categoryID'] . " ORDER BY newsitemID DESC";
								$newsData = mysql_query($newsQuery);
								
								$newsI = 1;
								
								echo "<table class='newstable' id='newstable_" . str_replace(" ", "", $catRow['name']) . "'>";
								while ($newsRow = mysql_fetch_array($newsData))
								{
									echo "<tr>";
									echo "<td>";
									echo "<img src='images/news/" . $newsRow['picture'] . "' class='newsPicture'/>";
									echo "</td>";
									echo "<td class='newsText' valign='top'>";
									echo "<h2 class='contenttitle'>" . $newsRow['title'] . "</h2>";
									echo "<p class='newsText'>";
									echo $newsRow['text'];
									echo "</p>";
									echo "</td>";
										echo "<tr>";
											echo "<td>";
											echo "</td>";
											echo "<td>";
											if (!empty($_SESSION['username']) or isset($_SESSION['username']))
											{
												echo "<a href='removenews.php?id=" . $newsRow['newsitemID'] . "' class='webmasterremovelink'>Remove</a>";
											}
											echo "</td>";
										echo "</tr>";
									echo "</tr>";
									if ($newsI < mysql_num_rows($newsData))
									{
										echo "<tr rowspan='2'><td class='whatsonnewsmargin'></td></tr>";
									}
									$newsI++;
								}
								
								if (mysql_num_rows($newsData) <= 0)
								{
									echo "<h1 class='contenttitle' id='nonews_" . str_replace(" ", "", $catRow['name']) . "'>There are no news in this section.</h1>";
								}
								
								echo "</table>";
								

								
							}							
							mysql_close($dbc);
						  ?>
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
	<script type = "text/javascript" src="whatson.js"></script>
</body>
</html>