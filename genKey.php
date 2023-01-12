<?php
$res = openssl_pkey_new(array('private_key_bits' => 1024)); 
openssl_pkey_export($res, $private_key);
$public_key = openssl_pkey_get_details($res);
$public_key = $public_key["key"];

$private_key = str_replace("-----BEGIN PRIVATE KEY-----","",$private_key);
$private_key = str_replace("-----END PRIVATE KEY-----","",$private_key);
$private_key = str_replace("\n","",$private_key);

$public_key = str_replace("-----BEGIN PUBLIC KEY-----","",$public_key);
$public_key = str_replace("-----END PUBLIC KEY-----","",$public_key);
$public_key = str_replace("\n","",$public_key);
echo "private key:\n";
echo $private_key;
echo "\npublic key:\n";
echo $public_key;
echo "\n";