<?php
	// Database Information
	$db_host = 'localhost';
	$db_user = ''; // Change this line
	$db_pass = ''; // Change this line
	$db_name = ''; // Change this line
	$db = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

	// General Site Information
	$clientid = ""; // Put your OAuth 2 client ID here
	$clientsecret = ""; // Put your OAuth2 client secret here
	$paypal = ""; // Put your PayPal email here
	$ownerids = [
		"XXXXX",
		"XXXXX",
	]; // Put the Discord IDs of the owners
	$downloadfoldername = "renameme"; // Put the name of the folder that you want people to download their files from inside of /clientarea
	$filetype = "rar"; // The filetype of your downloads
	$tabs = [
		"Home" => "",
		"Shop" => "shop",
		"Team" => "team",
		"Reviews" => "reviews",
		"Contact" => "contact",
		"Client Area" => "clientarea",
		"Discord" => "discord"
	];
	$navbar_tab_enable = [
		"Home" => "yes",
		"Shop" => "yes",
		"Team" => "yes",
		"Reviews" => "yes",
		"Contact" => "yes",
		"Client Area" => "yes",
		"Discord" => "yes",
	];
	$tos = "https://yourdomain.tld/tos"; // Replace yourdomain.tld with your domain (Ex. youtube.com)


	// This is important. Don't remove it.
	$select = "SELECT * FROM siteinfo";
	$query = mysqli_query($db, $select);
	$row = mysqli_fetch_array($query);
	$name = $row["name"];
	$domain = $row['domain'];
	$logo = $row['logo'];
	$color = $row['color'];
	$description = $row["description"];
	$twitter = $row['twitter'];
	$backgroundimage = $row['backgroundimage'];
	$sitekey = $row['sitekey'];
	$secretkey = $row['secretkey'];
	unset($select, $query, $row);
?>