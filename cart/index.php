<?php
	$page = "Cart";
	$basename = basename(__DIR__);
	$dir = $basename;
	include("../config.php");
	include("../session.php");

	if ($_POST['removeitem']) {
		unset($_SESSION['items'][$_POST["id"]]);
	}

	if ($_GET['action'] == "return") {
		header('Location: '.$domain.'/clientarea');
	}

	if ($_POST['discountcodesubmit']) {
		$select = "SELECT * FROM discountcodes WHERE code = '".mysqli_real_escape_string($db, $_POST['discountcode'])."'";
		$query = mysqli_query($db, $select);
		$row = mysqli_fetch_array($query);
		$currentdate = date("m-d-Y");

		if (mysqli_num_rows($query) <= 0) {
		}

		elseif (mysqli_num_rows($query) > 0) {
			if ($currentdate > $row['expiry']) {
			}

			elseif ($currentdate <= $row['expiry']) {
			    $_SESSION['promocode'] = percentToDecimal($row['percent']);
			}
		}
	}

	function percentToDecimal($percent): float {
	    $percent = str_replace('%', '', $percent);
	    return $percent / 100.00;
	}

	if($_SESSION['promocode'] == "" or null) {
		$_SESSION['promocode'] = "0";
	}

	if ($_POST['checkout']) {
		$_SESSION['purchase'] = "yes";
		$purchase = "yes";
		if ($_SESSION['username'] == "" or null) {
			header("location: ".$domain."/session.php?basename=cart");
		}
	}

	if ($_SESSION['purchase'] == "yes" && isset($_SESSION['username'])) {
		$params = $_SESSION['params'];
	    //header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?'.http_build_query($params));
	    header('Location: https://www.paypal.com/cgi-bin/webscr?'.http_build_query($params));
	    $_SESSION['purchase'] = "no";
	    $_SESSION['items'] = "";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cart - <?php echo $name ?></title>
	<link rel="icon" type="image/png" href="<?php echo $logo ?>" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-0c38nfCMzF8w8DBI+9nTWzApOpr1z0WuyswL4y6x/2ZTtmj/Ki5TedKeUcFusC/k" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="<?php echo $domain ?>/css/main.css">
	<link rel="stylesheet" href="<?php echo $domain ?>/css/subpages.css">
	<meta name="theme-color" content="#<?php echo $color ?>">
	<meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@<?php echo $twitter ?>">
	<meta name="twitter:creator" content="@jekeltor">
	<meta property="og:url" content="<?php echo $domain ?>/cart">
	<meta property="og:title" content="Cart - <?php echo $name ?>">
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
			--main-color: #<?php echo $color ?>;
		}

		.body .area {
			background-color: #1c1c1c;
			width: 70%;
			padding: 6vh 5%;
			height: 50vh;
			margin: -55vh 10% 0vh 10%;
			text-align: left;
			border-radius: .5vh;
			display: flex;
			position: relative;
			overflow: auto;
		}

		.body .area h1 {
			font-size: 3vh;
			color: #fff;
			padding: 0;
			margin: 0;
			padding-bottom: 1.5vh;
			border-bottom: .1vh solid #fff;
			margin-bottom: 3vh;
		}

		.body .area .emptyproducts {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100%;
			width: 100%;
			text-align: center;
		}

		.body .area .emptyproducts h3 {
			font-size: 3vh;
			color: #fff;
		}

		.body .area .emptyproducts p {
			font-size: 1.75vh;
			color: #fff;
		}

		.body .area .emptyproducts p a {
			color: var(--main-color);
		}

		.body .area .l {
			width: 65%;
			margin-right: 10%;
			overflow-y: auto;
		}

		.body .area .l .item {
			display: flex;
			width: 100%;
			margin-bottom: 4vh;
			align-items: center;
		}

		.body .area .l .item .background {
			width: 11vw;
			height: 5.54vw;
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
			margin-right: 5%;
		}

		.body .area .l .item .information {
			display: flex;
			flex-grow: 100;
		}

		.body .area .l .item .information .name {
			font-size: 2vh;
			color: #fff;
			margin: 0;
			font-weight: 600;
			margin-bottom: 1vh;
		}

		.body .area .l .item .information .price {
			font-size: 1.6vh;
			color: #fff;
			margin: 0;
		}

		.body .area .l .item .information .ri {
			flex-grow: 100;
			text-align: right;
		}

		.body .area .l .item .information input {
			font-size: 4vh;
			color: #fff;
			margin: 0;
			border: none;
			outline: none;
			background-color: transparent;
			cursor: pointer;
		}

		.body .area .r {
			width: 25%;
		}

		.body .area .r .subtotal {
			display: flex;
			font-size: 2vh;
			color: #fff;
			font-weight: 600;
			margin: 0;
			margin-bottom: 2vh;
		}

		.body .area .r .subleft, .body .area .r .subright {
			display: block;
			width: 50%;
		}

		.body .area .r .subright {
			text-align: right;
		}

		.body .area .r .itemized {
			display: flex;
			font-size: 1.75vh;
			font-weight: 400;
			width: 90%;
			margin: 0;
			margin-bottom: 1vh;
			margin-left: 10%;
			color: #fff;
		}

		.body .area .r .itemized .subleft {
			width: 75%;
		}

		.body .area .r .itemized .subright {
			width: 25%;
		}

		.body .area .r .itemized i {
			transform: rotate(90deg);
			margin-right: 6%;
		}

		.body .area .r .discountcodes {
			display: flex;
			width: 100%;
			margin-top: 5vh;
		}

		.body .area .r .discountcodes input[type=text] {
			background-color: #212121;
			font-size: 1.75vh;
			color: #fff;
			flex-grow: 100;
			border: none;
			outline: none;
			padding: .75vh 3%;
		}

		.body .area .r .discountcodes input[type=text]::placeholder {
			opacity: 1;
		}

		.body .area .r .discountcodes input[type=submit] {
			display: inline-block;
			cursor: pointer;
			margin: 0;
			padding: 0;
			width: auto !important;
			font-size: 1.75vh;
			background-color: var(--theme-color);
			color: #fff;
			padding: 0 5%;
			border-radius: none;
		}

		.body .area .r .termsofservice {
			text-align: center;
			margin-top: 2vh;
		}

		.body .area .r .termsofservice input {
			display: inline-block;
			cursor: pointer;
			margin: 0;
			padding: 0;
			font-size: 1.5vh;
			width: auto;
			margin-right: 2%;
		}

		.body .area .r .termsofservice label {
			display: inline-block;
			font-size: 1.5vh;
			color: #fff;
		}

		.body .area .r .termsofservice label a {
			color: var(--theme-color);
		}

		.body .area .r input[type=submit] {
			font-size: 2vh;
			color: #fff;
			background-color: var(--main-color);
			text-decoration: none;
			padding: 1vh 5%;
			border-radius: .5vh;
			outline: none;
			border: none;
			transition: border-radius .4s ease;
			transition: .5s ease;
			cursor: pointer;
			width: 100%;
			margin-top: 1.5vh;
		}

		.body .area .r input[type=submit]:hover {
			border-radius: .75vh;
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

			.body .area .l {
				width: 100%;
			}

			.body .area .r {
				width: 100%;
				margin-top: 7.5vh;
			}
		}
	</style>
</head>
<body>
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
					if (empty($_SESSION['items'])) {
				?>
					<div class="emptyproducts">
						<div class="spacer">
							<h3>You have no items in your cart</h3>
							<p>Visit my <a href="<?php echo $domain ?>/shop">shop</a>.</p>
						</div>
					</h3>
				<?php
					}
					elseif (!empty($_SESSION['items'])) {
				?>
				<div class="l">
					<h1>Cart Items</h1>
					<?php 
						unset($_SESSION['subtotal']);
						foreach ($_SESSION['items'] as $identifier => $number) {
						    $select = "SELECT * FROM shop WHERE id=".$number;
							$query = mysqli_query($db, $select);
							$products = mysqli_fetch_array($query);

							if($_SESSION['promocode'] == "" or null) {
								$_SESSION['promocode'] = "0";
							}

							$minus = $products['price']*$_SESSION['promocode'];
							$_SESSION['subtotal'] = $_SESSION['subtotal'] + $products['price'] - $minus;

							$addtoarray = array(
					    		"item_name_".$identifier => $products['name'],
					    		"item_number_".$identifier => $number,
					    		'amount_'.$identifier => $products['price'].".00",
					    	);

					    	$_SESSION['params'] = array_unique(array_merge($addtoarray, $_SESSION['params']));
					    	$background = explode("; ", $products['images']);
					?>
						<div class="item">
							<div class="background" style="background-image: url(<?php echo $background[0] ?>)"></div>
							<div class="information">
								<div class="li">
									<p class="name"><?php echo $products['name'] ?></p>
									<p class="price">$<?php if($_SESSION['promocode'] == "" or null) {
								$_SESSION['promocode'] = "0";
							}
							$minus = $products['price']*$_SESSION['promocode'];

							echo $products['price']-$minus ?></p>
								</div>
								<div class="ri">
									<form method="POST">
										<input type="submit" name="removeitem" value="×">
										<input type="text" name="id" value="<?php echo $identifier ?>" hidden>
									</form>
								</div>
							</div>
						</div>
					<?php
						}
					?>
				</div>
				<div class="r">
					<h1>Checkout</h1>
					<p class="subtotal"><span class="subleft">Subtotal:</span><span class="subright">$<?php echo $_SESSION['subtotal']; ?></span></p>
					<?php 
						foreach ($_SESSION['items'] as $identifier => $number) {
							$select = "SELECT * FROM shop WHERE id=".$number;
							$query = mysqli_query($db, $select);
							$products = mysqli_fetch_array($query);

							if($_SESSION['promocode'] == "" or null) {
								$_SESSION['promocode'] = "0";
							}

							$minus = $products['price']*$_SESSION['promocode'];
					?>
						<p class="itemized"><i class="fas fa-level-up-alt"></i><span class="subleft"><?php echo $products['name'] ?></span><span class="subright">$<?php echo $products['price']-$minus ?></span></p>
					<?php 
						} 
					?>
					<form method="POST">
						<div class="discountcodes">
							<input type="text" name="discountcode" placeholder="Discount Code">
							<input type="submit" name="discountcodesubmit" value="+">
						</div>
					</form>
					<form method="POST">
						<div class="termsofservice">
							<input type="checkbox" id="termsofservice" name="termsofservice" value="yes" required="">
							<label for="termsofservice">I agree to the <a target="_blank" href="<?php echo $tos ?>">Terms of Service</a>.</label>
						</div>
						<input type="submit" name="checkout" value="Checkout with PayPal">
					</form>
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