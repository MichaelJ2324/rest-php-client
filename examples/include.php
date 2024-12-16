<?php

/**
 * ©[2022] SugarCRM Inc.  Licensed by SugarCRM under the Apache 2.0 license.
 */

require_once __DIR__ . '/../vendor/autoload.php';

$server = 'https://cloudsi-stage.sugarondemand.com/';
$credentials = [
    'username' => 'mrussell',
    'password' => 'IronMan_2324',
    'platform' => 'api',
    'client_id' => 'sugar',
    'client_secret' => '',
];

function pre($message)
{
    $msg = $message;
    if (!is_string($message)) {
        $msg = print_r($message, true);
    }
    echo "<pre>$msg</pre><br/>";
}
