<?php

namespace App\Helpers;

class Helpers {
    public static function splitTextByWidth($text, $fontPath, $fontSize, $maxWidthPt)
    {
        $words = explode(' ', $text);
        $line1 = '';
        $line2 = '';

        foreach ($words as $i => $word) {
            $testLine = trim($line1 . ' ' . $word);
            $box = imagettfbbox($fontSize, 0, $fontPath, $testLine);
            $testWidth = abs($box[2] - $box[0]);

            if ($testWidth > $maxWidthPt) {
                if (!empty($line1)) {
                    $line2 = implode(' ', array_slice($words, $i));
                    break;
                } else {
                    $line1 = $word;
                    $line2 = implode(' ', array_slice($words, $i + 1));
                    break;
                }
            }

            $line1 = $testLine;
        }

        return [$line1, $line2];
    }
}