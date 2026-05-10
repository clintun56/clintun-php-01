<?php

use Dompdf\Dompdf;
use Dompdf\FontMetrics;

// Create DOMPDF instance to get FontMetrics
$dompdf = new Dompdf();
$fontMetrics = $dompdf->getFontMetrics();

// TTF file path
$fontPath = storage_path('fonts/NotoSansThai-Regular.ttf');

if (!file_exists($fontPath)) {
    die("Font file not found: $fontPath\n");
}

try {
    // Register the font
    $fontMetrics->registerFont(
        ['family' => 'notosansthai', 'style' => 'normal'],
        $fontPath
    );
    echo "✅ Noto Sans Thai font registered successfully\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
