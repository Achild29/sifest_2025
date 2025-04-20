<div>
    <x-slot:title>Dashboard {{  Auth::user()->role->name ?? "| Aplikasi Absensi" }} </x-slot:title>
    
    <flux:heading size="xl" level="1">Good afternoon, {{ Auth::user()->name ?? 'User' }}</flux:heading>
    <flux:text class="mb-6 mt-2 text-base">Here's what's new today</flux:text>
    <flux:separator variant="subtle" />
</div>