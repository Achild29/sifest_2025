<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeHelper {
    public static function generateQrCode(string $nisn): string {
        $qrImage = QrCode::format('png')->size(500)->generate($nisn);;
        $filename = 'qr_'. $nisn . '.png';
        
        Storage::disk('public')->put('qr_code/'. $filename, $qrImage);

        return $filename;
    }
}