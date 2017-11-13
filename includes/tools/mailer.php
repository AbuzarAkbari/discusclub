<?php
$url = 'https://us17.api.mailchimp.com/3.0/lists/d2917eb993/members/' . md5(strtolower("shadew69@gmail.com"));
$data = array('email_address' => 'shadew69@gmail.com', 'status' => "subscribed", 'status_if_new' => "subscribed");

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'method'  => 'PUT',
        'header'  => "Content-type: application/json\r\nAuthorization: apikey dfc849ee3d8f11035667a7b6921f214a-us17\r\n",
        'content' => json_encode($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) {

}
echo "<pre>";
var_dump(json_decode($result));
echo "</pre>";
