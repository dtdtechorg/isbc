<?php
namespace Dtdtech\Isbc;

class LicenseRequest
{
    public static function checkLicense()
    {
        $apiUrl = 'https://files.isbcbot.ru/plugin/api/auth.php'; // API endpoint URL
        $bearerToken = 'qwertyuiop'; // Bearer token (agar kerak bo'lsa)

        // cURL sessiyasini yaratish
        $ch = curl_init($apiUrl);

        // cURL sozlamalarini o'rnatish
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $bearerToken, // Bearer token
            'Content-Type: application/x-www-form-urlencoded', // yoki 'application/json' agar JSON yuborsangiz
        ]);

        // So'rovni yuborish
        $response = curl_exec($ch);

        // So'rov xatoliklarini tekshirish
        if (curl_errno($ch)) {
            echo "Failed to verify license: " . curl_error($ch) . "\n";
            curl_close($ch);
            exit(1); // Exit with an error
        }

        // cURL sessiyasini yopish
        curl_close($ch);

        // Javobni JSON formatida dekodlash
        $data = json_decode($response, true);

        // Javobni tekshirish
        if (isset($data['status']) && $data['status'] === 'valid') {
            echo "License key is valid. Continuing...\n";
        } else {
            echo "Invalid license key. Exiting...\n";
            exit(1); // Exit with an error
        }
    }
}
