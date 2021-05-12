<?php

function getNewUserAccessToken(){
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

    client_id => '', // Registered App ApplicationID

    username => '', // for example john.doe@yourdomain.com

    password => '' // Azure password for above user

    )


    ));


    $tokenResponse = curl_exec($curlPostToken);


    $tokenError = curl_error($curlPostToken);


    curl_close($curlPostToken);

    return $tokenResponse;

}

?>