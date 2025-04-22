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
</div>
