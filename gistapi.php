#!/usr/bin/php

<?php
    require("github-creds.php");  // get access token for github

    $content_obj = new stdClass();
    $content_obj->content = 'even more riveting text';

    $files_obj = new stdClass();
    $files_obj->{'text.txt'} = $content_obj;

    $data_obj = new stdClass();
    $data_obj->description = 'Gist OBJECT created by a restful API';
    $data_obj->public = 'true';
    $data_obj->files = $files_obj;
    $json_data = json_encode($data_obj);

    $url = "https://api.github.com/gists";
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
    ['Content-Type: application/javascript',
	'Authorization: token ' . $access_token,
	'User-Agent: php-curl']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    $gist = json_decode($result, true);
    if($gist) {
        echo "Your gist is located at: " . $gist['html_url'] . "\n";
    }
?>
