<?php

include './_access.php';

function getNewUserAccessToken(){

    global $access_client_id, $access_username, $access_password;

    /* Get oauth2 token using a POST request */
    $curlPostToken = curl_init();

    curl_setopt_array($curlPostToken, array(

    CURLOPT_URL => "https://login.windows.net/common/oauth2/token",

    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_ENCODING => "",

    CURLOPT_MAXREDIRS => 10,

    CURLOPT_TIMEOUT => 30,

    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

    CURLOPT_CUSTOMREQUEST => "POST",

    CURLOPT_POSTFIELDS => array(

    grant_type => 'password',

    scope => 'openid',

    resource => 'https://analysis.windows.net/powerbi/api',

    client_id => $access_client_id, // Registered App ApplicationID

    username => $access_username, // for example john.doe@yourdomain.com

    password => $access_password // Azure password for above user

    )


    ));


    $tokenResponse = curl_exec($curlPostToken);


    $tokenError = curl_error($curlPostToken);


    curl_close($curlPostToken);

    return $tokenResponse;

}

function decodeResultToken($tokenResponse){
    // decode result, and store the access_token in $embeddedToken variable:

    $tokenResult = json_decode($tokenResponse, true);

    $token = $tokenResult["access_token"];

    //$embeddedToken = "Bearer "  . ' ' .  $token;

    return $token;
}

function embeddedToken($access_token_decoded){
        /*      Use the token to get an embedded URL using a GET request */
        $curlGetUrl = curl_init();

        curl_setopt_array($curlGetUrl, array(

        CURLOPT_URL => "https://api.powerbi.com/v1.0/myorg/groups/63df1a7f-98af-4f6d-9639-a1f3d011e5e2/reports/",

        CURLOPT_RETURNTRANSFER => true,

        CURLOPT_ENCODING => "",

        CURLOPT_MAXREDIRS => 10,

        CURLOPT_TIMEOUT => 30,

        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

        CURLOPT_CUSTOMREQUEST => "GET",

        CURLOPT_HTTPHEADER => array(

        "Authorization: $access_token_decoded",

        "Cache-Control: no-cache",

        ),

        ));

        $embedResponse = curl_exec($curlGetUrl);

        $embedError = curl_error($curlGetUrl);

        curl_close($$curlGetUrl);

        return $embedResponse;

}
?>