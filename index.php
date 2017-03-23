<?php
$challenge = $_REQUEST['hub_challenge'];
$verify_token = $_REQUEST['hub_verify_token'];
// Set this Verify Token Value on your Facebook App 
if ($verify_token === 'testtoken') {
  echo $challenge;
}
$input = json_decode(file_get_contents('php://input'), true);
// Get the Senders Graph ID
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];
// Get the returned message
$message = $input['entry'][0]['messaging'][0]['message']['text'];
//API Url and Access Token, generate this token value on your Facebook App Page
$url = 'https://graph.facebook.com/v2.6/me/messages?access_token=EAATZBscKCDKcBAJ49EOAfskriZB2gmG9anAX3IEZAFZAZA2cgumiag2igb4AC8EpbAD8lQo9DwE2QfxDBTFfJVV68TZA9ZALxSGhsOEbkQE72ubZCWESh5k4gC87UQZAG4PrT6TpZAY8KvNI6Uiv0ZAZCgOLcs4v7iOJFVVqsFqgqZCvG3wZDZD';
//Initiate cURL.
$ch = curl_init($url);
//The JSON data.
$jsonData = '{
    "recipient":{
        "id":"' . $sender . '"
    }, 
    "message":{
        "text":"The message you want to return"
    }
}';
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
//Set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//Execute the request but first check if the message is not empty.
if(!empty($input['entry'][0]['messaging'][0]['message'])){
  $result = curl_exec($ch);
}
?>
