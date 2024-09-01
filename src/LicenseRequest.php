<?php
namespace Dtdtech\Isbc;

class LicenseRequest
{
    private $apiUrl;
    private $bearerToken;

    public function __construct($apiUrl, $bearerToken)
    {
        $this->apiUrl = $apiUrl;
        $this->bearerToken = $bearerToken;
    }

    public function checkLicense()
    {
        $ch = curl_init($this->apiUrl);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->bearerToken,
            'Content-Type: application/x-www-form-urlencoded',
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $this->handleError(curl_error($ch));
        }

        curl_close($ch);

        $data = json_decode($response, true);

        if ($httpCode !== 200) {
            $this->handleError("HTTP error code: $httpCode");
        }

        if (isset($data['status']) && $data['status'] === 'valid') {
            echo "License key is valid. Continuing...\n";
        } else {
            $this->handleError("Invalid license key.");
        }
    }

    private function handleError($message)
    {
        // You can replace this with a more sophisticated logging system if needed
        echo "Failed to verify license: " . $message . "\n";
        exit(1); // Exit with an error
    }
}