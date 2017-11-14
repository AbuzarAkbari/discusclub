<?php
require("keys.php");
$sub = "subscribed";

if($_POST["news"] != "on") {
    $sub = "unsubscribed";
}

$url = 'https://us17.api.mailchimp.com/3.0/lists/d2917eb993/members/' . md5(strtolower($_POST['email']));
$data = array('email_address' => $_POST['email'], 'status' => $sub, 'status_if_new' => $sub, 'merge_fields' => ["FNAME" => isset($_POST["first_name"]) ? $_POST["first_name"] : $user_data->first_name, "LNAME" => isset($_POST["last_name"]) ? $_POST["last_name"] : $user_data->last_name]);

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'method'  => 'PUT',
        'header'  => "Content-type: application/json\r\nAuthorization: apikey $mailchimp \r\n",
        'content' => json_encode($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) {

}
