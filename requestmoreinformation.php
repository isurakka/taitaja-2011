<?php include("includes/doctype.php");?>
<html>
<head>
<?php include("includes/metadata.php");?>
<script type="text/javascript" src="jquery.js"></script>

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
						<h1 class="contenttitle" id="requesttitle">Please fill the form below if you need to know something</h1>
						<table class="requesttable">
							<form method="post" action="request.php" id="requestform">
								<tr>				
									<td>
									<label for="name" class="requestlabel">Name</label>
									<input type="text" id="name" name="name"/>
									<p class="contenttext" id="nameVal"></p>
									<span class="requestlabel" id="nameInfo"></span>
									</td>
								</tr>
								<tr>
									<td>
									<label for="email" class="requestlabel">Email Address</label>
									<input type="text" id="email" name="email"/>
									<p class="contenttext" id="emailVal"></p>
									<span class="requestlabel" id="emailInfo"></span>
									</td>
								</tr>
									<td>
										<label for="request" class="requestlabel">Request</label>
										<span class="requestlabel" id="requestInfo"></span>
									</td>
								<tr>
									<td>
									<textarea rows="25" cols="80" type="text" id="request" name="request"></textarea>
									<p class="contenttext" id="requestVal"></p>
									</td>
								</tr>
								<tr>
									<td>
								<input type="submit" value="Save" name="submit" id="save" class="button"/>
							</form>
									<input type="submit" value="Ok" name="ok" id="ok" class="button"/>
									<input type="submit" value="Cancel" name="cancel" id="cancel" class="button"/>
									</td>
								</tr>
							
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
