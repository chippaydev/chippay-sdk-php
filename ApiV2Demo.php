<?php
require_once("Utils.php");
require_once("ApiV2.php");

function testApiV2AddOrder(){

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
    $params['syncUrl'] = 'http://127.0.0.1:8088';
    $params['asyncUrl'] = 'http://127.0.0.1:8088/v1/callback';

    $apiV2 = new ApiV2('MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAIn9F7FILRwSaEhPtI4JzW3Irpi3PPPbgJ/fAa/HMDG/B1E3PL1izd3Ody7foqpqTSr9X2kBOcCSOcxU3JQlkruakE7wRKNHpTlnrBMD9HLgEEItTvyyzGSPHPJ82Ox+DC7h82wS4T5yZJ6ieUxQ7GXlyzI9yQgU2e0aShTPg20JAgMBAAECgYB9ltz5fbeQ1TAUoHa00DcotH40gJH5YM6ws0fVtHUo0bTXNm8R79tvBXt0LhbfA+E4P2OXLoZhvrTcRGB+dbQVtDcJYwl2bHK3ayMF93OzJz75WlXKm0PhF2rIzUW+jHcoQ95YQTXluFI2oJ47DQ28/2sYi9z1eSmXKl2Ug/g0AQJBAMy37/NAIzAEJ/8F/+WOA26FXMeDiKDw3N2GRj/WbsWJd9osZQwpR+MGfXrWzWXl689S7i6f23sAFawzD9R7J9cCQQCsjfGN93sw/2dBQZs+1t7Y4Y3w/dXrVyadfHCq0YwzVf2k3W4rdvjVcfrBo8AbDmZBJcJzME9j4XZiDWkYF/YfAkAec/pA0DiryuJ8QFM5va9rAHG1yC5J6qqgVXobwvVFc1ad4N7DOVzVO8DsxglV8Cbs92QxEVyf5npS3GGtdQiPAkEAldRirIz50R/UPpuC+9uDgPrJTzp5p3HzO8gz5H8zp9fA+Ii1AtS5WE0yGTXgtx2XuHXbFD4ckXPSYW2Xla4orQJBALhuu6sV7TFFFO6hwER0EdCjbTM0FjtIVbZTXPAL+daDsq3FgDLtVQJytv2TEyJiQT6Wj46i+AWAbp47JRXynKw=');

    echo $apiV2->call('https://open-v2.chippaytest.com/cola/apiOpen/addOrder',$params);
}


function testApiV2AddIntentOrder(){

    $params['areaCode'] = "86";
    $params['phone'] = '18900000008';
    $params['companyOrderNum'] = microtime(); //need to be unique
    $params['coinQuantity'] = 20;
    $params['companyId'] = '12511234561'; //merchantId
    $params['syncUrl'] = 'http://127.0.0.1:8088';
    $params['asyncUrl'] = 'http://127.0.0.1:8088/v1/callback';

    $apiV2 = new ApiV2('MIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAIn9F7FILRwSaEhPtI4JzW3Irpi3PPPbgJ/fAa/HMDG/B1E3PL1izd3Ody7foqpqTSr9X2kBOcCSOcxU3JQlkruakE7wRKNHpTlnrBMD9HLgEEItTvyyzGSPHPJ82Ox+DC7h82wS4T5yZJ6ieUxQ7GXlyzI9yQgU2e0aShTPg20JAgMBAAECgYB9ltz5fbeQ1TAUoHa00DcotH40gJH5YM6ws0fVtHUo0bTXNm8R79tvBXt0LhbfA+E4P2OXLoZhvrTcRGB+dbQVtDcJYwl2bHK3ayMF93OzJz75WlXKm0PhF2rIzUW+jHcoQ95YQTXluFI2oJ47DQ28/2sYi9z1eSmXKl2Ug/g0AQJBAMy37/NAIzAEJ/8F/+WOA26FXMeDiKDw3N2GRj/WbsWJd9osZQwpR+MGfXrWzWXl689S7i6f23sAFawzD9R7J9cCQQCsjfGN93sw/2dBQZs+1t7Y4Y3w/dXrVyadfHCq0YwzVf2k3W4rdvjVcfrBo8AbDmZBJcJzME9j4XZiDWkYF/YfAkAec/pA0DiryuJ8QFM5va9rAHG1yC5J6qqgVXobwvVFc1ad4N7DOVzVO8DsxglV8Cbs92QxEVyf5npS3GGtdQiPAkEAldRirIz50R/UPpuC+9uDgPrJTzp5p3HzO8gz5H8zp9fA+Ii1AtS5WE0yGTXgtx2XuHXbFD4ckXPSYW2Xla4orQJBALhuu6sV7TFFFO6hwER0EdCjbTM0FjtIVbZTXPAL+daDsq3FgDLtVQJytv2TEyJiQT6Wj46i+AWAbp47JRXynKw=');

    echo $apiV2->call('https://open-v2.chippaytest.com/cola/apiOpen/addIntentOrder',$params);
}

testApiV2AddOrder();
//testApiV2AddIntentOrder();