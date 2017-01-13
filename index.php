<?php

$domain = $_SERVER['HTTP_HOST'];
$url = "http://meumobi.com/api/" . $domain;
$remote = curl_init($url);
curl_setopt($remote, CURLOPT_HEADER, 0);
curl_setopt($remote, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($remote);
curl_close($remote);

$obj = json_decode($data);
$theme = $obj->theme; #"employee";
$path = $_SERVER['REDIRECT_URL'] == '/' ? '/index.html' : $_SERVER['REDIRECT_URL'];
$ext = pathinfo($path, PATHINFO_EXTENSION);

switch ($ext) {
	case 'css':
		$type = 'text/css';
		break;
	case "js":
		$type = 'application/javascript';
		break;
	case 'ico':
		$type = 'image/vnd.microsoft.icon';
		break;
	case 'jpeg':
	case 'jpg':
		$type = 'image/jpeg';
		break;
	default:
		$type = 'text/html';	
}

header("Content-type: $type"); 
header("X-Sendfile: /home/meumobi/PROJECTS/meu-themes-repository.meumobi.com/$theme$path");

/*
foreach ($_SERVER as $name => $value) {
	echo "$name: $value</br>\n";
}
*/

?>
