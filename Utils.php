<?php


function removeNullValue(&$params){
    foreach ($params as $k => $v) {
        if($v == null || $v == ''){
            unset($params[$k]);
        }
    }
}

function getBaseString($params) {

    removeNullValue($params);

    ksort($params);
    $baseString = '';
    $len = count($params);
    $i = 0;
    foreach ($params as $k => $v) {
        $i++;
        if($i == $len){
            $baseString.=$k."=".$v;
        }else{
            $baseString.=$k."=".$v."&";
        }
    }
    return $baseString;
}

function httpPost($url, $data)
{

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    $data = json_encode($data);
    
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_HTTPHEADER,array(
            'Content-Type: application/json; charset=utf-8',
            'Content-Length:' . strlen($data),
            'Cache-Control: no-cache',
            'Pragma: no-cache'
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $res = curl_exec($curl);
    $errorno = curl_errno($curl);
    $resp['code'] = 0;
    $resp['msg'] = 'ok';
    $resp['success'] = true;
    $resp['data'] = null;

    if ($errorno) {

        $resp['code'] = 500;
        $resp['msg'] = 'errorno='.$errorno.",err=".curl_error($curl);
        $resp['success'] = false;
        return json_encode($resp);
    }

    $code = curl_getinfo($curl,CURLINFO_HTTP_CODE);

    if($code !=200){
        $resp['code'] = $code;
        $resp['msg'] = $res;
        $resp['success'] = false;
        return json_encode($resp);
    }
    
    curl_close($curl);
    return $res;
}


function getRSASign($content, $privateKey){
    $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n" .
        wordwrap($privateKey, 64, "\n", true) .
        "\n-----END RSA PRIVATE KEY-----";

    $key = openssl_get_privatekey($privateKey);
    openssl_sign($content, $signature, $key, "SHA256");

    openssl_free_key($key);
    $sign = base64_encode($signature);
    return $sign;
}


function verifyRSASign($content, $sign, $publicKey){
    $publicKey = "-----BEGIN PUBLIC KEY-----\n" .
    wordwrap($publicKey, 64, "\n", true) .
    "\n-----END PUBLIC KEY-----";

    $key = openssl_get_publickey($publicKey);
    $ok = openssl_verify($content,base64_decode($sign), $key, 'SHA256');
    openssl_free_key($key);

    return $ok;
}
