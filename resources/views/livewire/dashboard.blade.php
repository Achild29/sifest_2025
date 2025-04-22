<?php

use App\Enums\UserRole;

?>

<div>
    <x-slot:title>Dashboard {{  Auth::user()->role->name ?? "| Aplikasi Absensi" }} </x-slot:title>
    
    <div class="flex gap-2">
        <flux:heading size="xl" level="1">Wellcome back, {{ Auth::user()->name ?? 'User' }} </flux:heading>
        <flux:heading size="xl" level="1" class="hidden dark:flex">👋🏻</flux:heading>
        <flux:heading size="xl" level="1" class="dark:hidden">👋</flux:heading>
    </div>
    <flux:text class="mb-6 mt-2 text-base">Here's what's new today</flux:text>
    <flux:separator variant="subtle" />

    @if (Auth::user()->role->value == UserRole::admin->value)
        @livewire('admin.dashboard')
    @endif
</div>