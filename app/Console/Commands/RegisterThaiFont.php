<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Barryvdh\DomPDF\Facade\Pdf;

class RegisterThaiFont extends Command
{
    protected $signature = 'font:register-thai';
    protected $description = 'Register Noto Sans Thai font for DomPDF';

    public function handle()
    {
        $fontPath = storage_path('fonts/NotoSansThai-Regular.ttf');
        
        if (!file_exists($fontPath)) {
            $this->error("Font file not found: $fontPath");
            return 1;
        }

        try {
            // Get font metrics from PDF facade
            $pdf = Pdf::getFacadeRoot();
            $fontMetrics = $pdf->getFontMetrics();
            
            $fontMetrics->registerFont(
                [
                    'family' => 'notosansthai',
                    'style' => 'normal',
                    'weight' => 'normal'
                ],
                $fontPath
            );
            
            $this->info('✅ Noto Sans Thai font registered successfully');
            return 0;
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            return 1;
        }
    }
}
