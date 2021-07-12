<?php
	$page = "Reviews";
	include("../config.php");
?><!DOCTYPE html>
<html>
<head>
	<title>Reviews - <?php echo $name ?></title>
	<link rel="icon" type="image/png" href="<?php echo $logo ?>" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-0c38nfCMzF8w8DBI+9nTWzApOpr1z0WuyswL4y6x/2ZTtmj/Ki5TedKeUcFusC/k" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="<?php echo $domain ?>/css/main.css">
	<link rel="stylesheet" href="<?php echo $domain ?>/css/subpages.css">
	<link rel="stylesheet" href="<?php echo $domain ?>/css/cards.css">
	<meta name="theme-color" content="#<?php echo $color ?>">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@<?php echo $twitter ?>">
	<meta name="twitter:creator" content="@jekeltor">
	<meta property="og:url" content="<?php echo $domain ?>/reviews">
	<meta property="og:title" content="Reviews - <?php echo $name ?>">
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
				<h1>Reviews</h1>
				<p>Here are some of our most promising reviews. With such a positive overall review, how could you not buy from us?</p>
			</div>
		</div>
	</section>
	<section class="body">
		<div class="grid">
			<?php
				$select = 'SELECT * FROM reviews ORDER BY order1 ASC';
				$query = mysqli_query($db, $select);
				while ($row = mysqli_fetch_array($query)) {
			?>
			<div class="item">
				<div class="avatar" style="background-image: url(<?php echo $row['logo'] ?>)">
				</div>
				<div class="information">
					<h1><?php echo $row["name"] ?></h1>
					<h2><?php echo str_repeat("<i class='fas fa-star'></i>", $row['rating']) ?></h2>
					<p><?php echo $row["review"] ?></p>
				</div>
			</div>
			<?php } ?>
		</div>
	</section>
	<section class="footer">
		&copy; Copyright <?php echo $name." ".date("Y") ?> | All rights reserved
	</section>
	<script src="<?php echo $domain ?>/js/main.js"></script>
</body>
</html>