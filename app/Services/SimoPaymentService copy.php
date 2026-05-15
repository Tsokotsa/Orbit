<?php

namespace App\Services;

class SimoPaymentService
{
    /**
     * Generate 11-digit identifier:
     * [9-digit padded account][2-digit MOD97-10 checksum]
     */
    public static function generate(int|string $accountNumber): string
    {
        $accountNumber = (string) $accountNumber;

        if (!ctype_digit($accountNumber)) {
            throw new \InvalidArgumentException('Account number must be numeric.');
        }

        if (strlen($accountNumber) > 9) {
            throw new \InvalidArgumentException('Account number exceeds 9 digits.');
        }

        // Step 1: Pad to 9 digits
        $base = str_pad($accountNumber, 9, '0', STR_PAD_LEFT);

        // Step 2: Append "00" placeholder for checksum
        $temp = $base . '00';

        // Step 3: Compute MOD97
        $mod = self::mod97($temp);

        // Step 4: Calculate checksum
        $checksum = 98 - $mod;

        // Ensure 2 digits
        $checksum = str_pad((string) $checksum, 2, '0', STR_PAD_LEFT);

        return $base . $checksum;
    }

    /**
     * Validate full 11-digit identifier
     */
    public static function validate(string $identifier): bool
    {
        if (!ctype_digit($identifier) || strlen($identifier) !== 11) {
            return false;
        }

        return self::mod97($identifier) === 1;
    }

    /**
     * Safe MOD97 calculation using string arithmetic
     */
    private static function mod97(string $number): int
    {
        $remainder = 0;

        foreach (str_split($number) as $digit) {
            $remainder = ($remainder * 10 + (int) $digit) % 97;
        }

        return $remainder;
    }
}