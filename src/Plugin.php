<?php
namespace Dtdtech\Isbc;

use Composer\Script\Event;
use Composer\Script\ScriptEvents;

class Plugin
{
    public static function checkLicense(Event $event)
    {
        $correctLicenseKey = '123456'; // O'zingizning litsenziya kalitini shu yerga yozing
        
        echo "Please enter your license key: ";
        $userInput = trim(fgets(STDIN));

        if ($userInput === $correctLicenseKey) {
            echo "License key is valid. Continuing...\n";
        } else {
            echo "Invalid license key. Exiting...\n";
            exit(1); // Exit with an error
        }
    }
}
