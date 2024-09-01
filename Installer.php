<?php

namespace Dtdtech\Isbc;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Installer
{
    public static function configure(InputInterface $input, OutputInterface $output)
    {
        // Litsenziya ID'sini so'rash
        $output->writeln('Please enter your license ID:');
        $licenseId = trim(fgets(STDIN));

        // Litsenziya ID'sini tekshirish
        if (!self::validateLicense($licenseId)) {
            $output->writeln('Invalid license ID. Installation aborted.');
            exit(1);
        }

        // Litsenziya ID'sini saqlash
        file_put_contents('config/license.key', $licenseId);
        $output->writeln('License ID saved successfully.');
    }

    private static function validateLicense($licenseId)
    {
        // Litsenziya ID'sini tekshirish
        // Bu yerda litsenziya tekshiruvini amalga oshirishingiz mumkin
        return !empty($licenseId);
    }
}
