<?php
// check_license.php
if (PHP_SAPI !== 'cli') {
    die("This script must be run from the command line.");
}

// Correct license key for validation
$correctLicenseKey = '123456789';

// Ask user for the license key
echo "Please enter your license key: ";
$userInput = trim(fgets(STDIN));

// Validate the license key
if ($userInput === $correctLicenseKey) {
    echo "License key is valid. Continuing installation...\n";
    exit(0); // Continue with the script
} else {
    echo "Invalid license key. Installation aborted.\n";
    exit(1); // Exit with error code
}
