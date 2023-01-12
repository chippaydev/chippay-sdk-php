<?php
require_once("Utils.php");
require_once("ApiV1.php");

function testGetBaseString(){
    $params = ['xxx'=>'xxxx',"m"=>10,'cdd'=>'m111','dy'=>'ddddd'];

    echo getBaseString($params);
    echo "\n";
}

function testApiV1AddOrder(){

    $params['username'] = 'haha';
    $params['areaCode'] = "86";
    $params['phone'] = '18900000008';
    $params['idCardType'] = 1;
    $params['idCardNum'] = '430524143201097878';
    $params['kyc'] = 2;
    $params['companyOrderNum'] = microtime(); //need to be unique
    $params['coinSign'] = 'USDT';
    $params['coinAmount'] = '20'; // string type is recommandation
    $params['total'] = '200'; // string type is recommandation
    $params['orderPayChannel'] = 3;
    $params['payCoinSign'] = 'cny';
    $params['companyId'] = '12511234561'; //merchantId
    $params['orderTime'] = time()*1000; //milli seconds
    $params['orderType'] = 1; //1 add buy order,2 sell order
    $params['signType'] = 1;
    $params['syncUrl'] = 'http://127.0.0.1:8088';
    $params['asyncUrl'] = 'http://127.0.0.1:8088/v1/callback';

    $apiV1 = new ApiV1('b7ef76e3b52a9d793d98fd6a3d92d6cf');

    echo $apiV1->call('https://open-v2.chippaytest.com/cola/order/addOrder',$params);
}


testApiV1AddOrder();