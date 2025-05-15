@php
    $profil_path = Auth::user()->profil_path ?? 'storage/assets/avatar.png';
    if (!is_null(Auth::user()->profil_path)) {
        $profil_path = 'storage/assets/'.Auth::user()->profil_path;
    }
@endphp
<flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="/" logo="https://my.unpam.ac.id/icons/logo.png" name="Aplikasi Absensi" class="px-2 dark:hidden" />
    <flux:brand href="/" logo="https://my.unpam.ac.id/icons/logo.png" name="Aplikasi Absensi" class="px-2 hidden dark:flex" />

    {{-- <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" /> --}}

    <flux:navlist variant="outline" class="gap-y-1">
        
        {{-- <flux:navlist.item icon="inbox" badge="12" href="#">Inbox</flux:navlist.item> --}}
        @if (Auth::user()->role->value == 'Admin')
            <flux:navlist.item icon="home" href="{{ route('admin.dashboard') }}">Home</flux:navlist.item>
            <flux:navlist.item icon="user-group" href="{{ route('manage.students') }}">Manage Students</flux:navlist.item>
            <flux:navlist.item icon="user-group" href="{{ route('manage.teachers') }}">Manage Teachers</flux:navlist.item>
            <flux:navlist.item icon="users" href="{{ route('manage.users') }}">Manage Admin</flux:navlist.item>
            <flux:navlist.item icon="book-open" href="{{ route('admin.manage.kelas') }}" :current="request()->routeIs([
                'admin.manage.kelas', 'admin.add.teacher.kelas'
                ])" >Manage Kelas</flux:navlist.item>
            
        @endif
        @if (Auth::user()->role->value == 'Guru')
            <flux:navlist.item icon="home" href="{{ route('guru.dashboard') }}">Home</flux:navlist.item>
            <flux:navlist.item icon="book-open" href="{{ route('manage.kelas') }}" :current="request()->routeIs([
                'manage.kelas', 'detail.kelas', 'add.students.kelas'
            ])">Manage Kelas</flux:navlist.item>
            <flux:navlist.item icon="clipboard-document-list" href="{{ route('guru.absensi') }}" :current="request()->routeIs(['guru.absensi','guru.absensi.*'])">Absensi</flux:navlist.item>
            <flux:navlist.item icon="academic-cap" href="{{ route('bahan.ajar') }}" :current="request()->routeIs(['bahan.ajar','chatbot'])">Bahan Ajar</flux:navlist.item>
            <flux:navlist.item icon="presentation-chart-bar" href="{{ route('guru.laporan') }}" :current="request()->routeIs(['guru.laporan','guru.laporan.*'])">Laporan Absensi</flux:navlist.item>
                    
        @endif
        @if (Auth::user()->role->value == 'Siswa')
            <flux:navlist.item icon="home" href="{{ route('siswa.dashboard') }}">Home</flux:navlist.item>
            <flux:navlist.item icon="qr-code" href="{{ route('qrcode') }}">QR Code</flux:navlist.item>
                    
        @endif
    </flux:navlist>
    <flux:spacer />
    <flux:separator class="lg:hidden" />
    <flux:navlist variant="outline" class="mb-5">
        <flux:navlist.group expandable heading="{{ Auth::user()->name }}" class="grid lg:hidden">
            <flux:navlist.item icon="cog-6-tooth" href="{{ route('settings') }}">Settings</flux:navlist.item>
            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                <flux:radio value="light" icon="sun" />
                <flux:radio value="dark" icon="moon" />
                <flux:radio value="system" icon="computer-desktop" />
            </flux:radio.group>
            <flux:navlist.item icon="arrow-right-start-on-rectangle" href="{{ route('logout') }}">Logout</flux:navlist.item>
        </flux:navlist.group>
    </flux:navlist>
</flux:sidebar>