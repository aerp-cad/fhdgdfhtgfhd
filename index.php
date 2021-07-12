<?php
	$page = "Home";
	include("config.php");
?><!DOCTYPE html>
<html>
<head>
	<title>Home - <?php echo $name ?></title>
	<link rel="icon" type="image/png" href="<?php echo $logo ?>" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-0c38nfCMzF8w8DBI+9nTWzApOpr1z0WuyswL4y6x/2ZTtmj/Ki5TedKeUcFusC/k" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="<?php echo $domain ?>/css/main.css">
	<meta name="theme-color" content="#<?php echo $color ?>">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@<?php echo $twitter ?>">
	<meta name="twitter:creator" content="@jekeltor">
	<meta property="og:url" content="<?php echo $domain ?>">
	<meta property="og:title" content="Home - <?php echo $name ?>">
	<meta property="og:description" content="<?php echo $description ?>">
	<meta property="og:image" content="<?php echo $logo ?>">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
		$('html, body').css({
		  	'overflow': 'hidden',
		  	'height': '100vh'
		});

		window.onload = function() {
			document.querySelector(".preloader").classList.add("loaded");
			$('html, body').css({
			  	'overflow': 'auto',
			 	'height': 'auto'
			});
		}
	</script>
	<style>
		:root {
			--theme-color: #<?php echo $color ?>;
			--background-image: url(<?php echo $backgroundimage ?>);
		}
	</style>
</head>
<body>
	<section class="preloader">
	</section>
	<section class="dropdown">
		<div class="center">
			<?php
				foreach ($tabs as $tabname => $link) {
					if ($navbar_tab_enable[$tabname] == "no") {
					}

					elseif ($navbar_tab_enable[$tabname] == "yes" or "" or null) {
			?>
				<a href="<?php echo $domain."/".$link ?>" <?php if ($tabname == $page){echo "class='active'";}?>><?php echo $tabname ?></a>
			<?php
					}
				}
			?>
		</div>
	</section>
	<section class="navbar">
		<div class="left">
			<img src="<?php echo $logo ?>">
		</div>
		<div class="right">
			<div class="links">
				<?php
					foreach ($tabs as $tabname => $link) {
						if ($navbar_tab_enable[$tabname] == "no") {
						}

						elseif ($navbar_tab_enable[$tabname] == "yes" or "" or null) {
				?>
					<a href="<?php echo $domain."/".$link ?>" <?php if ($tabname == $page){echo "class='active'";}?>><?php echo $tabname ?></a>
				<?php
						}
					}
				?>
			</div>
			<a onclick="dropdown()" class="dropdownbtn"><i class="fas fa-bars"></i></a>
			<a onclick="dropdown()" class="dropdownbtnclose"><i class="fas fa-times"></i></a>
		</div>
	</section>
	<section class="top">
		<div class="screen">
			<div class="center">
				<div class="img" style="background-image: url(<?php echo $logo ?>)"></div>
				<h1>Welcome to <?php echo $name; if ($name[strlen($name)-1] == "s") {?>' <?php } else{ ?>'s<?php } ?> official site</h1>
				<p><?php echo $description ?></p>
				<div class="buttons">
					<a href="<?php echo $domain ?>/shop" class="shop">Shop Now</a>
					<a href="<?php echo $domain ?>/discord" class="discord">Join My Discord</a>
				</div>
			</div>
		</div>
	</section>
	<script src="<?php echo $domain ?>/js/main.js"></script>
</body>
</html>