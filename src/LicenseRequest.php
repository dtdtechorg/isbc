<?php
namespace Dtdtech\Isbc;

use Composer\Script\Event;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Plugin
{
    public static function checkLicense(Event $event)
    {
        $apiUrl = 'https://files.isbcbot.ru/plugin/api/auth.php'; // API endpoint URL
        $bearerToken = 'qwertyuiop'; // Bearer token (agar kerak bo'lsa)

        $client = new Client();

        try {
            $response = $client->post($apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $bearerToken, // Bearer token
                    'Content-Type'  => 'application/x-www-form-urlencoded', // yoki 'application/json' agar JSON yuborsangiz
                ],
                // Agar boshqa ma'lumot yuborilmaydi, 'form_params' yoki 'json' qo'shmasangiz ham bo'ladi
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['status']) && $data['status'] === 'valid') {
                echo "License key is valid. Continuing...\n";
            } else {
                echo "Invalid license key. Exiting...\n";
                exit(1); // Exit with an error
            }
        } catch (RequestException $e) {
            echo "Failed to verify license: " . $e->getMessage() . "\n";
            exit(1); // Exit with an error
        }
    }
}
