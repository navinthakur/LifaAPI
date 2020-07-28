<?php
function Encrypt($data){
    $encData = openssl_encrypt($data, 'DES-EDE3', "&5P483", OPENSSL_RAW_DATA);

    $encData = base64_encode($encData);

    return $encData;
}

/**
 * @param $data
 * @return string
 */
 function Decrypt($data){
    $data = base64_decode($data);

    $decData = openssl_decrypt($data, 'DES-EDE3', "&5P483", OPENSSL_RAW_DATA);

    return $decData;
}
?>