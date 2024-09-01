<?php

namespace Dtdtech\Isbc;

class Client
{
    private $licenseId;

    public function __construct()
    {
        $this->licenseId = $this->getLicenseId();
        if (!$this->validateLicense($this->licenseId)) {
            throw new \Exception('Invalid license ID.');
        }
    }

    private function getLicenseId()
    {
        // Litsenziya ID'sini o'qish
        return trim(file_get_contents('config/license.key'));
    }

    private function validateLicense($licenseId)
    {
        // Litsenziya ID'sini tekshirish
        // Bu yerda litsenziya tekshiruvini amalga oshirishingiz mumkin
        return !empty($licenseId);
    }
}
