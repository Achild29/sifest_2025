<?php

namespace App\Enums;

enum UserRole: string
{
    case admin = "Admin";
    case guru = "Guru";
    case siswa = "Siswa";
}
