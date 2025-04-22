<?php

use App\Enums\UserRole;

?>

<div>
    @if (Auth::user()->role->value == UserRole::admin->value)
        @livewire('admin.settings')
    @endif
    @if (Auth::user()->role->value == UserRole::guru->value)
        @livewire('guru.settings')
    @endif
    @if (Auth::user()->role->value == UserRole::siswa->value)
        @livewire('siswa.settings')
    @endif
</div>
