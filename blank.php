
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="www.frebsite.nl" />
		<meta name="viewport" content="width=device-width initial-scale=1.0 maximum-scale=1.0 user-scalable=yes" />

		<title>jQuery.mmenu demo</title>
		
		<script src="js/jquery-2.1.1.js"></script>
		<script src="js/jquery.mobile-1.4.4.min.js"></script>
		<link type="text/css" rel="stylesheet" href="css/menu/demo.css" />
		<link type="text/css" rel="stylesheet" href="css/menu/jquery.mmenu.all.css" />
		<script type="text/javascript" src="js/menu/jquery.mmenu.min.all.js"></script>
		<script type="text/javascript">
			$(function() {
				$('nav#menu').mmenu();
			});
		</script>
	</head>
	<body>
		<div id="page">
			<div class="header">
				<a href="#menu"></a>
				Demo
			</div>
			<div class="content">
				<p><strong>This is a demo.</strong><br />
					Click the menu icon to open the menu.</p>
				<p>For more demos, a tutorial, documentation and support, please visit <a href="http://mmenu.frebsite.nl" target="_blank">mmenu.frebsite.nl</a></p>			
			</div>
			<nav id="menu">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#about">About us</a>
						<ul>
							<li><a href="blank2.php" data-ajax="false">History</a></li>
							<li><a href="#about/team">The team</a>
								<ul>
									<li><a href="blank.php" data-ajax="false">Development</a></li>
								</ul>
							</li>

						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</body>
</html>
