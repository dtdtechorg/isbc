<?php

namespace Dtdtech\Isbc;

class LicenseChecker
{
    private $licenseKey;
    private $apiUrl = 'https://files.isbcbot.ru/plugn/api/auth.php';

    public function __construct($licenseKey)
    {
        $this->licenseKey = $licenseKey;
    }

    public function validateLicense()
    {
        $ch = curl_init($this->apiUrl);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->licenseKey,
            'Content-Type: application/json'
        ]);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if (curl_errno($ch)) {
            echo "Failed to verify license: " . curl_error($ch) . "\n";
            curl_close($ch);
            exit(1);
        }

        curl_close($ch);

        $data = json_decode($response, true);

        if ($httpCode === 200 && $data['status'] === 'valid') {
            echo "License key is valid. Continuing...\n";
        } else {
            echo "Invalid license key. Exiting...\n";
            exit(1);
        }
    }
}
