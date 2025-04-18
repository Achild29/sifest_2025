<?php

namespace App\Enums;

enum StatusAbsensi: string
{
    case alpha = "alpha";
    case hadir = "hadir";
    case izin = "izin";
    case sakit = "sakit";
    case others = "others";
}
