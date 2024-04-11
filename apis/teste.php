<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://chatbot.menuia.com/api/create-message',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
  'appkey' => "2fabbe65-b20e-427f-b2a7-5da1b3c6f4c6",
  'authkey' => "v9t7zpp51nsSCMeqqJWfI4lj8iGG12tyMqW8PwvBH3CojiUaHM",
  'to' => "5531975275084",
  'message' => "teste",
  'sandbox' => 'false'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>
  
  