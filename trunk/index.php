<!DOCTYPE html>
<html>
<head>
	<title>Page Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/jquery.mobile-1.4.4.min.css" />
	<script src="js/jquery-2.1.1.js"></script>
	<script src="js/jquery.mobile-1.4.4.min.js"></script>
	<script src="js/jquery.mobile-1.4.4.min.map"></script>
</head>
<body>
	<div data-role="page">
		<div data-role="header">
			<h1>FAST App - Login</h1>
			<div style="position: absolute; right:0; top: 0;">
				<img src="img/logo-fit.png" alt="logo" width="100px" />
			</div>
		</div>
		<div style="text-align: center; padding-top: 10px;">
			<img src="img/big-logo.jpg" alt="image" style=" width:50%;"/>
		</div>
		<div data-role="content">
			<p>
				<form action="home.php" method="post">

					<div data-role="fieldcontain">
						<label for="username">Username:</label>
						<input type="text" name="username" id="username"  />
					</div>	

					<div data-role="fieldcontain">
						<label for="password">Password:</label>
						<input type="password" name="password" id="password" />
					</div>	

					<input type="submit" name="login" data-transition="slidefade" class="ui-btn ui-corner-all ui-shadow ui-btn-inline" value="Login" />
				</form>
			</p>		
		</div>
		<div data-role="footer">
			<h4>
				Visi&oacute;n Mundial Guatemala, <?php echo date("Y"); ?> <img src="img/logo-fit.png" style="width:76px; height:25px; padding-left:10px;"/>
			</h4>
		</div><!-- /footer -->
	</div><!-- /page -->
</body>
</html>