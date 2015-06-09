<?php
require_once('vendor/autoload.php');

/*
 * Application setup, database connection, data sanitization and user
 * validation methods.
 */
$config = Factory::fromFile('config/config.php', true);     // Zend Config

if ($credentialsAreValid) {

    $tokenId    = base64_encode(mcrypt_create_iv(32));
    $issuedAt   = time();
    $notBefore  = $issuedAt + 10;               // Adding 10 seconds
    $expire     = $notBefore + 60;              // Adding 60 seconds
    $serverName = $config->get('serverName');   // Retrieve server name from config file

    /*
     * Token array
     */
    $data = [
        'iat'   => $issuedAt,       // Issued at: time when token was generated
        'jti'   => $tokenId,        // Json Token Id: unique token identifier
        'iss'   => $serverName,     // Issuer
        'nbf'   => $notBefore       // Not before
        'exp'   => $expire          // Expire
        'data' => [                 // Data related to the signer user
            'userId'    => $rs['id'],   // userid from the users table
            'userName'  => $userName    // User name
        ]
    ];

    /*
     * Extract key from config file (generated with base64_encode)
     */
    $secretKey = base64_decode($config->get('jwtKey'));

    /*
     * Encode the array to a JWT string.
     * Parameters: the key to encode the token.
     */
    $jwt = JWT::encode(
        $data,      // Data to be encoded in the JWT
        $secretKey, // Signing key
        'Hs512'     // Algorithm used to sign the token
    );

    $unencodedArray = ['jwt' => $jwt];
    echo json_encode($unencodedArray);
}