<?php

//initial request with login data

$ch = curl_init();
$url = "https://erp.jcs.jo/complaints/action/technical/assign/1";
$username = "antonio";
$password = "9CARACTERE";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "username=$username&password=$password");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIESESSION, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie-name');  //could be empty, but cause problems on some hosts
curl_setopt($ch, CURLOPT_COOKIEFILE, '/var/www/ip4.x/file/tmp');  //could be empty, but cause problems on some hosts
$answer = curl_exec($ch);
if (curl_error($ch)) {
   echo curl_error($ch);
}

//another request preserving the session

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, "");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //adjusted to only read and not to return
$answer = curl_exec($ch);
if (curl_error($ch)) {
    echo curl_error($ch);
}
// curl_close ($ch);

?>