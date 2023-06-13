<?php

// Set the login credentials
$username = 'antonio';
$password = '9CARACTERE';

// Set the URL to the login page
$url = 'https://erp.jcs.jo/login/';

// Initialize cURL
$ch = curl_init();

// Set the cURL options to get the cookie
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);

// Execute the cURL request
$response = curl_exec($ch);
echo $response;

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
    exit();
}

// Extract the CSRF token from the cookie
preg_match('/csrftoken=([^;]+)/', $response, $matches);
if (isset($matches[1])) {
    $csrf_token = $matches[1];
    echo 'CSRF Token: ' . $csrf_token . PHP_EOL;
} else {
    echo 'Error: could not extract CSRF token' . PHP_EOL;
    exit();
}

// Reset the cURL options
curl_reset($ch);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Set the POST data to include the login credentials and CSRF token
$post_data = array(
    'email' => $username,
    'password' => $password,
    '_token' => $csrf_token
);

// Set the cURL options to login with the cookie and the POST data
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
curl_setopt($ch, CURLOPT_COOKIE, 'XSRF-TOKEN=' . $csrf_token . ';');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/x-www-form-urlencoded',
    'X-XSRF-TOKEN: ' . $csrf_token
));

// Execute the cURL request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
    exit();
}

// Close the cURL session
curl_close($ch);

// Output the response
echo $response;
?>