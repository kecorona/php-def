<?php
return array(
    'jwt' => array(
        'key'       => '',      // Key for signing JWT's
        'algorithm' => 'HS512'  // Algorithm used to sign the token - https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
        ),
    'database' => array(
        'user'      => '',      // DB username
        'password'  => '',      // DB password
        'host'      => '',      // DB host
        'name'      => '',      // DB schema name
        ),
    'serverName'    => '',      // Domain name
); 