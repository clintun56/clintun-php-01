<?php

namespace App\Http\Controllers;

use Dompdf\FontMetrics;
use Dompdf\Exception;
use setasign\Fpdi\PdfParser\StreamReader;

class FontRegistration
{
    public static function registerThaiFont()
    {
        try {
            $fontPath = storage_path('fonts/NotoSansThai-Regular.ttf');
            
            if (!file_exists($fontPath)) {
                return false;
            }

            // Get font metrics
            $fpdf = new \Dompdf\Dompdf();
            $dompdf = $fpdf->getDomPDF();
            $fontMetrics = $dompdf->getFontMetrics();
            
            // Register font
            $fontMetrics->registerFont(
                [
                    'family' => 'noto sans thai',
                    'style'  => 'normal',
                ],
                $fontPath
            );
            
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
