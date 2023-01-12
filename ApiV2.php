<?php

require_once('Utils.php');

/**
 * v2 版本使用的是非对称签名，使用SHA256WITHRSA,商户端持有私钥，平台持有公钥
 * v2 版本回调验签，使用平台提供的公钥（公钥在文档中有）
 */
class ApiV2{
    
    private $privateKey;

    function __construct($privateKey)
    {
        $this->privateKey = $privateKey;
    }

    function call($url,$params){

        $baseString = getBaseString($params);

        $sign = getRSASign($baseString,$this->privateKey);

        $params['sign'] = $sign;

        return httpPost($url,$params);
    }
}