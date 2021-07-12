<?php
	include("config.php");
	define('OAUTH2_CLIENT_ID', $clientid); //Your client Id
	define('OAUTH2_CLIENT_SECRET', $clientsecret); //Your secret client code

	$authorizeURL = 'https://discordapp.com/api/oauth2/authorize';
	$tokenURL = 'https://discordapp.com/api/oauth2/token';
	$apiURLBase = 'https://discordapp.com/api/users/@me';

	session_start();

	if (isset($_POST['logout'])) {
	  	error_reporting(0);
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		session_regenerate_id(true);
		header('Location: '.$domain);
	}

	$paramsdefault = array(
        'cmd' => '_cart',
        'upload' => '1',
        'business' => $paypal,
        'notify_url' => $domain.'/cart/notify.php',
        'cancel_return' => $domain.'/cart?action=cancel',
        'return' => $domain.'/cart?action=return',
    );

	$_SESSION['params'] = array(
        'cmd' => '_cart',
        'upload' => '1',
        'business' => $paypal,
        'notify_url' => $domain.'/cart/notify.php',
        'cancel_return' => $domain.'/cart?action=cancel',
        'return' => $domain.'/cart?action=return',
        'custom' => $_SESSION['id'],
    );

    foreach ($_SESSION['items'] as $identifier => $number) {
    	global $db;
    	$select = "SELECT * FROM shop WHERE id=".$number;
		$query = mysqli_query($db, $select);
		$products = mysqli_fetch_array($query);

		$minus = $products['price']*$_SESSION['promocode'];
		$total = $products['price']-$minus;
		if (strpos($total, '.') === "false") {
			$total = $total."00";
		}

    	$identifier = $identifier + 1;
		$addtoarray = array(
    		"item_name_".$identifier => $products['name'],
    		"item_number_".$identifier => $products['id'],
    		'amount_'.$identifier => $total,
    	);

    	$_SESSION['params'] = array_merge($addtoarray, $_SESSION['params']);
    }

	if (empty($_SESSION['items'])) {
		$_SESSION['purchase'] = "no";
	}

	if ($basename == "shop" || $basename == "cart" && $_SESSION['purchase'] == "no" && $_SESSION['purchase'] !== "yes") {
	}

	elseif ($basename == "cart" && $_SESSION['purchase'] == "yes" && $_SESSION['username'] == "" or null || $basename == "clientarea" || $_GET['code'] !== "") {
		if ($basename == "" or null) {
			$basename = $_GET['basename'];
		}
		// After Discord redirect, grab the information
		if(get('code')) {
		  	// Exchange the auth code for a token
		  	$token = apiRequest($tokenURL, array(
		    	"grant_type" => "authorization_code",
		    	'client_id' => OAUTH2_CLIENT_ID,
		    	'client_secret' => OAUTH2_CLIENT_SECRET,
		    	'redirect_uri' => $domain.'/'.$basename,
		    	'code' => get('code')
		  	));
		  	$logout_token = $token->access_token;
		  	$_SESSION['access_token'] = $token->access_token;


		  	header('Location: ' . $_SERVER['PHP_SELF']);
		}

		// If the access token exists for Discord
		else if(session('access_token')) {
		  	$user = apiRequest($apiURLBase);

		  	$_SESSION['username'] = $user->username;
		  	$_SESSION['avatar'] = "https://cdn.discordapp.com/avatars/".$user->id."/".$user->avatar;
		  	$_SESSION['id'] = $user->id;
		  	//echo '<pre>';
		    //print_r($user);
		  	//echo '</pre>';

		  	$customadd = array(
		        'custom' => $user->id,
		    );
		        
		    $_SESSION['params'] = array_merge($customadd, array_filter($_SESSION['params']));
		}

		else if(!isset($_SESSION['username'])) {
			$params = array(
			    'client_id' => OAUTH2_CLIENT_ID,
			    'redirect_uri' => $domain.'/'.$basename,
			    'response_type' => 'code',
			    'scope' => 'identify guilds'
		  	);

		  	// Redirect the user to Discord's authorization page
		  	header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params));
		  	die();
		}
	}

				// API function
	function apiRequest($url, $post=FALSE, $headers=array()) {
	  	$ch = curl_init($url);
	 	curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
	  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	  	$response = curl_exec($ch);


	  	if($post)
	    	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

	  	$headers[] = 'Accept: application/json';

	  	if(session('access_token'))
	    	$headers[] = 'Authorization: Bearer ' . session('access_token');

	  	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	  	$response = curl_exec($ch);
	  	return json_decode($response);
	}

	// Get function
	function get($key, $default=NULL) {
	  	return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
	}

	// Session function
	function session($key, $default=NULL) {
	  	return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
	}
?>