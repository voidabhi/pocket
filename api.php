<?php
	//require_once('config.php');
	session_start();
	require_once 'lib/Unirest.php';
	/* read the docs!
		by default, I'm just returning the 5 most recent
		pocket items.
		read more here: http://getpocket.com/developer/docs/v3/retrieve
	 */
        $config = $_SESSION['config'];
        $access_token = explode("=",$config['access_token']);
	$url = 'http://getpocket.com/v3/get?count=5';
	$data = array(
		'consumer_key' => $config['consumer_key'],
		'access_token' => $access_token[1]
	);

    $response = Unirest::post($url,
            array("Content-Type" => "application/json; charset=UTF-8",
               "X-Accept" => "application/json"),
      json_encode($data)
    );
        $pocket_links = $response->body->list;

?>

<html>
	<head>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet"/>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<ul>
			<? foreach($pocket_links as $links){
					echo $links;
			}?>
		</ul>
	</body>
</html>