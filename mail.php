<?php
$data = $_POST;
require 'Mailjet/vendor/autoload.php';
use \Mailjet\Resources;

try {
    $apiKey = '87816f2fdd9b77ee68e26936702aa5e9';
    $secretKey = 'c267d816c45f41da6af5fecdc075affd';

    $mj = new \Mailjet\Client($apiKey, $secretKey,true,['version' => 'v3.1']);
    $body = [
        'Messages' => [
            [
                'From' => [
                    'Email' => "no-reply@evelynmuebles.com.ar"
                ],
                'To' => [
                    [
                        'Email' => "info@evelynmuebles.com.ar"
                    ]
                ],
                'Subject' => "Contacto - Pagina Web",
                'TextPart' => "Nombre: ".utf8_decode($data["nombre"])."Mail: ".utf8_decode($data['mail'])."Telefono: ".utf8_decode($data['tel'])."Texto: ".utf8_decode($data['texto'])."",
                'HTMLPart' => "Nombre: ".utf8_decode($data["nombre"])."<br>Mail: ".utf8_decode($data['mail'])."<br>Telefono: ".utf8_decode($data['tel'])."<br>Texto: ".utf8_decode($data['texto']).""
            ]
        ]
    ];

    $response = $mj->post(Resources::$Email, ['body' => $body]);

    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    header('Location: exito.html');
    exit;
} catch (Exception $e) {
    echo ("Fallo al enviar");
}