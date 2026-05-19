<?php
// ============================================================================
// File:    NumberHelper.php
// Author:  Recep Seymen Konuk <konukrecepseymen@gmail.com>
//
// Licensed under the terms of the LICENSE file in the project root directory.
// ============================================================================

namespace Seymen\PhpMvcTemplate\Helpers;


class NumberHelper
{
    /**
     * Verilen sayıyı belirtilen ondalık basamağına göre kısaltılmış sayı formatına dönüştürür.
     * Örneğin: 1_300_000 → "1.3Mn", 4_645_000_000 → "4.645Mlr".
     * @param int      $number   Formatlanacak sayı.
     * @param int      $decimals Kullanılacak ondalık basamak sayısı.
     * @return string  Kısaltılmış ve formatlanmış sayı ifadesi.
     */
    public static function formatNumber(int $number, int $decimals = 1): string
    {
        if ($number >= 1000000000) {
            return round($number / 1000000000, $decimals) . 'Mlr';
        }
        if ($number >= 1000000) {
            return round($number / 1000000, $decimals) . 'Mn';
        }
        if ($number >= 1000) {
            return round($number / 1000, $decimals) . 'B';
        }
        return (string)$number;
    }
}
