<?php
ini_set("include_path", '/home/nyuvbmwh/php:' . ini_get("include_path") );
require_once 'HTTP/Request2.php';
$request = new HTTP_Request2();
$request->setUrl('http://ec2-54-175-10-42.compute-1.amazonaws.com/participant/login');
$request->setMethod(HTTP_Request2::METHOD_POST);
$request->setConfig(array(
  'follow_redirects' => TRUE
));
$request->setHeader(array(
  'Content-Type' => 'application/json'
));
$request->setBody('{\n	"username": "abhishek_951",\n	"password": "vp_2020"\n}');
try {
  $response = $request->send();
  if ($response->getStatus() == 200) {
    echo $response->getBody();
  }
  else {
    echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
    $response->getReasonPhrase();
  }
}
catch(HTTP_Request2_Exception $e) {
  echo 'Error: ' . $e->getMessage();
}
?>