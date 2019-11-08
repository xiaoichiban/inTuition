<?php
// Signaling server
// Address, need to use the wss protocol
// and must be the domain name

$SIGNALING_ADDRESS = 'ws://127.0.0.1:8877';

/*
$SSL_CONTEXT = array(
    // More ssl options please refer to the manual
	// http://php.net/manual/zh/context.ssl.php
    
	
	'ssl' => array(
        // Please use absolute path
        'local_cert'        => 'C:/something/server.pem', // can be also .crt ext
        'local_pk'          => 'C:/something/server.key',
        'verify_peer'       => false,
        'allow_self_signed' => true, //This option is required if it is a self-signed certificate.
    )
	
	
);
*/

