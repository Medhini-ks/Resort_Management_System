<html>
<style type="text/css">
body {
	background: #fcfcfc;
	color: #111;
	font-family: verdana, sans-serif;
	padding: 0;
	margin: 0;
	}
#main {
	width: 100%;
	position: relative;
	}
.container {
	padding: 1em;
	}
#menu { float: left; width: 24%;  }
#menu ul { padding: 0; border-right: 3px solid white; margin: 0; }
ul li { list-style-type: none; }
ul li a {
	display: block;
	background: #eee;
	padding: 4px 7px;
	border-top: 2px solid #fff;
	}
ul li a:hover {
background: #B6C6D7;
color: black;
	}
iframe {
	border: 0 none;
	overflow: hidden;
	width: 74%;
	height: 95%;
	padding-left: 1%;
	}
.clear-block {
	width: 100%;
	height: 1px;
	clear: both;
	}
</style>
<link rel="stylesheet" type="text/css" href="htdocs/resort management system/index.php"></script>
<body>
<div id="main">
	<div class="container">
		<div id="menu">
			<a href="/xampp"><strong>XAMPP for Windows</strong></a>
			<hr>
			<p><strong>/htdocs/index.html</strong></p>
			<ul>
			<?php
				$www = $_SERVER['DOCUMENT_ROOT'];
				$files = scandir($www);
				usort($files, 'strcasecmp');
				foreach($files as $key => $value){ 
					if($value[0] != '.' && is_dir($value))
						echo '<li><a href="/' . $value . '">' . $value . '</a></li>';
				} 
			?>
			</ul>
		</div>
		<div>
			<iframe src="http://localhost/phpmyadmin/"></iframe>
		</div>
		<div class="clear-block"></div>
	</div>
</div>
</body>
</html>