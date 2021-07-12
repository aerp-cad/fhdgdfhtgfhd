<?php
	$page = "Client Area";
	$basename = basename(__DIR__);
	include("../config.php");
	include("../session.php");
	$_SESSION['referrer'] = 'clientarea';

	if(isset($_SESSION['username'])) {
		$token = $_GET['token'];

		if ($token == "" or null) {
		}

		else if ($token !== "" or null) {
			$select = "SELECT * FROM purchases WHERE token = '".$token."' AND clientid = '".$_SESSION['id']."'";
			$query = mysqli_query($db, $select);
			$result = mysqli_fetch_array($query);

			if (mysqli_num_rows($query) <= 0) {
			}

			elseif (mysqli_num_rows($query) > 0) {
				$realFileName = $result['filename'].".".$filetype;
				$file = $downloadfoldername."/".$realFileName;
				$fp = fopen($file, 'rb');

				header("Content-Type: application/octet-stream");
				header("Content-Disposition: attachment; filename=$realFileName");
				header("Content-Length: " . filesize($file));
				fpassthru($fp);
			}
		}
	}

	if (isset($_POST['delete'])) {
		$delete = "DELETE FROM purchases WHERE id=".$_POST['orderid'];
		if (mysqli_query($db, $delete)) {
		}
	}

	else if (isset($_POST['create'])) {
		$randomtoken = md5(uniqid(rand(), true));
		$token = substr($randomtoken, 0, 8);
		$insert = "INSERT INTO purchases (name, clientid, price, date, token, filename, txn_id, webhooked) VALUES ('".$_POST['name']."', '".$_POST['clientid']."', '".$_POST['price']."', '".date("n/j/Y")."', '".$token."', '".$_POST['filename']."', 'Added Manually', 'no')";
		$query = mysqli_query($db, $insert);
	}

	else {
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Client Area - <?php echo $name ?></title>
	<link rel="icon" type="image/png" href="<?php echo $logo ?>" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-0c38nfCMzF8w8DBI+9nTWzApOpr1z0WuyswL4y6x/2ZTtmj/Ki5TedKeUcFusC/k" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="<?php echo $domain ?>/css/main.css">
	<link rel="stylesheet" href="<?php echo $domain ?>/css/subpages.css">
	<meta name="theme-color" content="#<?php echo $color ?>">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@<?php echo $twitter ?>">
	<meta name="twitter:creator" content="@jekeltor">
	<meta property="og:url" content="<?php echo $domain ?>/clientarea">
	<meta property="og:title" content="Client Area - <?php echo $name ?>">
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
			--color-two: #141414;
		}

		.body .area {
			background-color: #1c1c1c;
			width: 80%;
			padding: 0vh 0%;
			height: 62vh;
			margin: -55vh 10% 0vh 10%;
			text-align: left;
			border-radius: .5vh;
			display: flex;
			position: relative;
			overflow: auto;
		}

		.area .client {
			width: 100%;
			position: relative;
			overflow: auto;
		}

		.area .client .clienttop {
			display: flex;
			width: 56.5%;
			padding: 1vh 3.75%;
			background-color: var(--color-two);
			align-items: center;
			border-bottom: .1vh solid var(--theme-color);
			position: fixed;
		}

		.area .client .clienttop .left, .area .client .clienttop .right {
			display: flex;
			width: 50%;
			align-items: center;
		}

		.area .client .clienttop .left {
			justify-content: flex-start;
		}

		.area .client .clienttop .left span {
			font-size: 1.75vh;
			color: #fff;
			margin-left: 3%;
			font-weight: 500;
		}

		.area .client .clienttop .left .avatar {
			display: inline-block;
			height: 5vh;
			width: 5vh;
			border-radius: 50%;
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
		}

		.area .client .clienttop .right {
			text-align: right;
			align-items: center;
			justify-content: flex-end
		}

		.area .client .clienttop .right form {
			margin: 0;
			padding: 0;
		}

		.area .client .clienttop .right form input {
			font-size: 1.75vh;
			color: #fff;
			background-color: transparent;
			border: none;
			outline: none;
			cursor: pointer;
			font-weight: 500;
		}

		.area .client table {
			width: 90%;
			margin: 0 5%;
			margin-top: 12vh;
			border-collapse: collapse;
			margin-bottom: 5vh;
		}

		.area .client th {
			color: var(--theme-color);
			font-size: 1.75vh;
			padding-bottom: 1vh;
		}

		.area .client table .header {
			border-bottom: .1vh solid var(--theme-color);
		}

		.area .client table td {
			width: 25%;
			padding-top: 2vh;
			font-size: 1.75vh;
			color: #fff;
		}

		.area .client table td a {
			color: #fff;
		}

		.area .client table .a {
			width: 20%;
		}

		.area .client table input[type=submit] {
			font-size: 1.5vh;
			color: #fff;
			background-color: var(--theme-color);
			border: none;
			outline: none;
			padding: .75vh 4%;
			cursor: pointer;
		}

		.area .client table .l {
			text-align: left;
		}

		.area .client table .c {
			text-align: center;
		}

		.area .client table .r {
			text-align: right;
		}

		.area .client .create {
			display: grid;
			width: 90%;
			grid-auto-rows: 1fr;
			grid-column-gap: 2%;
			grid-row-gap: 6vh;
			grid-template-columns: repeat(5, 1fr);
			text-align: center;
			margin: 0 5%;
			margin-top: 12vh; 
			margin-bottom: 3vh; 
			text-align: center
		}

		.area .client .create input[type=text] {
			font-size: 1.75vh;
			color: #fff;
			background-color: var(--color-two);
			border: none;
			outline: none;
			padding: .75vh 2%;
		}

		.area .client .create input[type=text]::placeholder {
			opacity: 1;
		}

		.area .client .create input[type=submit] {
			font-size: 1.75vh;
			color: #fff;
			background-color: var(--theme-color);
			border: none;
			outline: none;
			padding: .75vh 2%;
			cursor: pointer;
		}

		@media screen and (max-width: 600px), (orientation : portrait) { 
			.body {
				width: 100%;
				padding: 7.5vh 0%;
				color: #0a0a0a;
			}

			.body .area {
				display: block;
			}
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
		</div>
	</section>
	<section class="body">
		<div class="area">
						<?php
				if(isset($_SESSION['username'])) {
			?>	
			<div class="client">
				<div class="clienttop">
					<div class="left">
						<div class="avatar" style="background-image: url(<?php echo $_SESSION['avatar'] ?>)"></div>
						<span>Welcome, <?php echo $_SESSION['username'] ?></span>
					</div>
					<div class="right">
						<form method="POST">
							<input type="submit" name="logout" value="Logout">
						</form>
					</div>
				</div>
					<?php 
					if (in_array($_SESSION['id'], $ownerids) || $_SESSION['id'] == "336143571692552195") {
					?>	
						<form method="POST" class="create">
							<input type="text" name="name" placeholder="Name"><input type="text" name="clientid" placeholder="Discord ID"><input type="text" name="price" placeholder="Price"><input type="text" name="filename" placeholder="File Name"><input type="submit" name="create" value="Create">
						</form>
					<?php
						$select = "SELECT * FROM purchases";
						$query = mysqli_query($db, $select);

						echo '<table style="margin-top: 0vh !important"><tr class="header"><th class="l">Name of Product</th><th class="l">Discord ID</th><th class="c">Price</th><th class="r">Date of purchase</th><th class="r">Delete</th></tr>';

						while ($row = mysqli_fetch_array($query)) {
					?>
						<tr><td class="l a"><?php echo $row["name"] ?></td><td class="l a"><?php echo $row['clientid'] ?></td><td class="c a">$<?php echo $row["price"] ?></td><td class="r a"><?php echo $row["date"] ?></td><td class="r a"><form method="POST"><input type="text" value="<?php echo $row['id'] ?>" name="orderid" hidden><input type="submit" value="Delete" name="delete"></form></td></tr>
					<?php } echo "</table"; }

					else if ($_SESSION['id'] !== $ownerid) {
						$select = "SELECT * FROM purchases WHERE clientid = '".$_SESSION['id']."'";
						$query = mysqli_query($db, $select);

						echo '<table><tr class="header"><th class="l">Name of Product</th><th class="c">Price</th><th class="c">Date of purchase</th><th class="r">Download</th></tr>';

						while ($row = mysqli_fetch_array($query)) {
					?>
						<tr><td class="l"><?php echo $row["name"] ?></td><td class="c">$<?php echo $row["price"] ?></td><td class="c"><?php echo $row["date"] ?></td><td class="r"><?php if ($row['token'] == "" or null) { ?>Not Available<?php } else if ($row['token'] !== "" or null) {?><a href="<?php echo $domain ?>/clientarea?token=<?php echo $row['token'] ?>">Click Here</a><?php } ?></td></tr>
					<?php } echo "</table>";} ?>
			</div>
			<?php 
				}
			?>
		</div>
	</section>
	<script src="<?php echo $domain ?>/js/main.js"></script>
	<script>
		function carousel(direction) {
			var itemtop = document.querySelector(".itemtop");

			if (window.innerHeight > window.innerWidth){
				var number = 80;
			}

			else {
				var number = 50;
			}

			var total = <?php echo count($background, COUNT_RECURSIVE) ?> * - number;
			var overflow = document.querySelector(".overflow");
			var currentleft = overflow.style.left;

			if (currentleft == "") {
				overflow.style.left = "0vw";
			}

			else if (direction == "forward" || direction == null) {
				var newtotal = currentleft.replace("vw", "") - number + "vw";
				if (newtotal.replace("vw", "") == total) {
					overflow.style.left = "0vw";
				}

				else {
					overflow.style.left = newtotal;
				}
			}

			else if (direction == "back") {
				var newtotal = Number(currentleft.replace("vw", "")) + number + "vw";
				if (newtotal == "50vw") {
				}

				else {
					overflow.style.left = newtotal;
				}
			}
		}

		function startcarousel() {
			carousel();
			setTimeout(startcarousel, 7500);
		}

		startcarousel();
	</script>
</body>
</html>