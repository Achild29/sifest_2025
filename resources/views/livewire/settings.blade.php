<?php

use App\Enums\UserRole;

?>

<div>
    @if (Auth::user()->role->value == UserRole::admin->value)
        @livewire('admin.settings.settings')
    @endif
    @if (Auth::user()->role->value == UserRole::guru->value)
        @livewire('guru.settings.settings')
    @endif
    @if (Auth::user()->role->value == UserRole::siswa->value)
        @livewire('siswa.settings.settings')
    @endif
</div>
