@php
    $profil_path = Auth::user()->profil_path ?? 'storage/assets/avatar.png';
    if (!is_null(Auth::user()->profil_path)) {
        $profil_path = 'storage/assets/'.Auth::user()->profil_path;
    }
@endphp
<flux:header class="block! bg-white lg:bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:navbar class="w-full">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            @yield('header-message')
        <flux:spacer />

        <flux:dropdown position="top" align="start">
            <flux:profile :chevron="false" avatar="{{ asset($profil_path) }}" class="lg:hidden" />
            <flux:profile avatar="{{ asset($profil_path) }}" name="{{ explode(' ', Auth::user()->name)[0] }}" class="bg-zinc-200 dark:bg-zinc-800 hidden lg:flex"/>
            <flux:menu>
                <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                    <flux:radio value="light" icon="sun" />
                    <flux:radio value="dark" icon="moon" />
                    <flux:radio value="system" icon="computer-desktop" />
                </flux:radio.group>
                <flux:navlist.item icon="cog-6-tooth" href="{{ route('settings') }}">Settings Profile</flux:navlist.item>
                <flux:menu.separator />
                <flux:menu.item icon="arrow-right-start-on-rectangle" href="{{ route('logout') }}">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:navbar>
</flux:header>