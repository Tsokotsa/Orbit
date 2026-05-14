<?php

namespace App\Services;

use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use RuntimeException;

class SimoPaymentService
{
    private const ENTITY_LENGTH = 5;

    private const REFERENCE_LENGTH = 9;

    private const CHECKSUM_LENGTH = 2;

    /**
     * Final customer reference length
     */
    private const FINAL_REFERENCE_LENGTH = 11;

    /**
     * Generate payment reference
     */
    public static function generate(
        int|string $odooId
    ): string {

        /**
         * Fetch entity
         */
        $entity = self::getEntity();

        /**
         * Normalize Odoo ID
         */
        $reference = self::normalizeReference($odooId);

        /**
         * Internal base
         */
        $base = $entity . $reference;

        /**
         * Add checksum placeholder
         */
        $temp = $base . '00';

        /**
         * MOD97
         */
        $remainder = self::mod97($temp);

        /**
         * Calculate checksum
         */
        $checksum = 98 - $remainder;

        $checksum = str_pad(
            (string) $checksum,
            2,
            '0',
            STR_PAD_LEFT
        );

        /**
         * FINAL VISIBLE REFERENCE
         *
         * 9 digits + 2 checksum
         */
        $finalReference = $reference . $checksum;

        Log::channel('daily')->info('SIMO reference generated', [
            'entity' => $entity,
            'reference' => $reference,
            'checksum' => $checksum,
            'final_reference' => $finalReference,
        ]);

        return $finalReference;
    }

    /**
     * Validate payment reference
     */
    public static function validate(
        string $reference
    ): bool {

        if (!ctype_digit($reference)) {
            return false;
        }

        /**
         * Must be 11 digits
         */
        if (
            strlen($reference)
            !== self::FINAL_REFERENCE_LENGTH
        ) {
            return false;
        }

        /**
         * Split
         */
        $referencePart = substr(
            $reference,
            0,
            9
        );

        $checksumPart = substr(
            $reference,
            -2
        );

        /**
         * Rebuild internal structure
         */
        $entity = self::getEntity();

        $base = $entity . $referencePart;

        /**
         * Recalculate checksum
         */
        $temp = $base . '00';

        $remainder = self::mod97($temp);

        $expectedChecksum = str_pad(
            (string) (98 - $remainder),
            2,
            '0',
            STR_PAD_LEFT
        );

        return $checksumPart === $expectedChecksum;
    }

    /**
     * Fetch active entity
     */
    private static function getEntity(): string
    {
        $gateway = PaymentGateway::query()
            ->where('agent', 'FNB')
            ->where('status', 'active')
            ->first();

        if (!$gateway) {

            throw new RuntimeException(
                'Active payment gateway entity not found.'
            );
        }

        if (empty($gateway->prodid)) {

            throw new RuntimeException(
                'Payment gateway entity is empty.'
            );
        }

        return self::normalizeEntity(
            $gateway->prodid
        );
    }

    /**
     * Normalize entity
     */
    private static function normalizeEntity(
        int|string $entity
    ): string {

        $entity = (string) $entity;

        if (!ctype_digit($entity)) {

            throw new InvalidArgumentException(
                'Entity must be numeric.'
            );
        }

        return str_pad(
            $entity,
            self::ENTITY_LENGTH,
            '0',
            STR_PAD_LEFT
        );
    }

    /**
     * Normalize reference
     */
    private static function normalizeReference(
        int|string $reference
    ): string {

        $reference = (string) $reference;

        if (!ctype_digit($reference)) {

            throw new InvalidArgumentException(
                'Reference must be numeric.'
            );
        }

        if (
            strlen($reference)
            > self::REFERENCE_LENGTH
        ) {

            throw new InvalidArgumentException(
                'Reference exceeds 9 digits.'
            );
        }

        return str_pad(
            $reference,
            self::REFERENCE_LENGTH,
            '0',
            STR_PAD_LEFT
        );
    }

    /**
     * MOD97
     */
    private static function mod97(
        string $number
    ): int {

        $remainder = 0;

        foreach (str_split($number) as $digit) {

            $remainder = (
                ($remainder * 10)
                + (int) $digit
            ) % 97;
        }

        return $remainder;
    }
}