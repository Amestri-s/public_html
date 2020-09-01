<?php

    require "require/head.php";

    $webhook_url = "https://discordapp.com/api/webhooks/750321907861291018/swMuUfXRa4KW5WOowA5HLU28lwCUFhcAcezwgCRsGvoYpufJPntHGCM5xdifeu2u_xaL";
    $timestamp = date("c", strtotime("now"));

    if(!(isset($_SESSION['perm'])) || !($_SESSION['perm'] >= 4)) {

                    header('Location: /scfr/auth/');

                    exit;

    }

    $id = $_GET['id'];

    $result = mysqli_query($link, "DELETE FROM notices WHERE id=$id");

    $json_data = json_encode([

        "content" => "SCFR Logs",

        "username" => "SCFR",

        "avatar_url" => "https://scfr.site/img/logo.png",

        "embeds" => [
            [
                "title" => $_SESSION['username'],

                "type" => "rich",

                "description" => "just deleted a notice.",

                "url" => "https://scfr.site/scfr",

                "timestamp" => $timestamp,

                "color" => hexdec( "#ff0000" ),

                "footer" => [
                    "text" => "SCFR",
                ],
            ]
        ]

    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

    $ch = curl_init($webhook_url);
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
    curl_setopt( $ch, CURLOPT_POST, 1);
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt( $ch, CURLOPT_HEADER, 0);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec( $ch );
    curl_close( $ch );

    header('Location: /scfr/admin.php');

?>