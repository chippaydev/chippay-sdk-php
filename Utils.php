<?php

function removeNullValue(&$params) {
    foreach ($params as $k => $v) {
        if ($v === null || $v === '') {
            unset($params[$k]);
        }
    }
}

function getBaseString($params) {
    removeNullValue($params);
    ksort($params);
    $baseString = '';
    $i = 0;
    $len = count($params);
    foreach ($params as $k => $v) {
        $i++;
        $baseString .= "$k=$v";
        if ($i < $len) {
            $baseString .= '&';
        }
    }
    return $baseString;
}

function httpPost($url, $data) {
    $curl = curl_init();

    $jsonData = json_encode($data);

    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_POST => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json; charset=utf-8',
            'Content-Length: ' . strlen($jsonData),
            'Cache-Control: no-cache',
            'Pragma: no-cache'
        ],
    ]);

    $res = curl_exec($curl);
    $errorno = curl_errno($curl);
    $resp = ['code' => 200, 'msg' => 'ok', 'success' => true, 'data' => null];

    if ($errorno) {
        $resp['code'] = 500;
        $resp['msg'] = 'errorno=' . $errorno . ', err=' . curl_error($curl);
        $resp['success'] = false;
        return json_encode($resp);
    }

    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($code !== 200) {
        $resp['code'] = $code;
        $resp['msg'] = $res;
        $resp['success'] = false;
        return json_encode($resp);
    }

    curl_close($curl);
    return $res;
}

function hmacSha256($data, $secretKey) {
    return hash_hmac('sha256', $data, $secretKey);
}

function getRSASign($content, $privateKey) {
    $key = openssl_pkey_get_private($privateKey);
    if (!$key) {
        throw new Exception("Invalid RSA private key");
    }

    openssl_sign($content, $signature, $key, OPENSSL_ALGO_SHA256);
    return base64_encode($signature);
}

function verifyRSASign($content, $sign, $publicKey) {
    $key = openssl_pkey_get_public($publicKey);
    if (!$key) {
        throw new Exception("Invalid RSA public key");
    }

    return openssl_verify($content, base64_decode($sign), $key, OPENSSL_ALGO_SHA256) === 1;
}

function genKey() {
    $res = openssl_pkey_new([
        'private_key_bits' => 1024,
        'private_key_type' => OPENSSL_KEYTYPE_RSA,
    ]);

    openssl_pkey_export($res, $privateKey);
    $keyDetails = openssl_pkey_get_details($res);
    $publicKey = $keyDetails['key'];

    return [
        'privKey' => $privateKey,
        'pubKey' => $publicKey
    ];
}