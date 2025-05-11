@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">
                    Home
                </span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('guru.absensi') }}" class="hidden sm:flex">Absensi</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('guru.absensi.kelas', $kelas->id) }}" class="hidden sm:flex">Kelas {{ $kelas->name }}</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('guru.absensi.kelas', $kelas->id) }}" icon="ellipsis-horizontal" class="sm:hidden" />
        <flux:breadcrumbs.item>Scan Masuk</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Scan Pulang | {{  Auth::user()->role->name }} </x-slot:title>
@endsection

@push('html5-qrcode')
    <script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
@endpush

@push('scan-qr')
    <script src="{{ asset('js/scan-qr-pulang.js') }}"></script>
@endpush

<div>
    <div class="md:flex">
        <div class="grid">
            <flux:heading size="xl" class="font-extrabold" level="1">Scan Masuk kelas: <span class="text-red-500">{{ $kelas->name }}</span></flux:heading>
            <flux:text class="mb-2 mt-2 font-semibold">This page you can scan QR code of your students to make change an attendace of your students in Class: <span class="text-red-500">{{ $kelas->name }}</span></flux:text>
        </div>
        <flux:spacer />
        <div class="flex gap-3 md:grid md:gap-0 justify-center">
            <flux:text class="mb-2 mt-2 font-semibold" class="flex gap-2">
                <flux:icon.calendar variant="mini"/>
                {{ now()->format('d M Y') }}
            </flux:text>
            <flux:text class="mb-2 mt-2 font-semibold" class="flex gap-2">
                <flux:icon.clock variant="mini"/>
                {{ now()->format('H:i') }}
            </flux:text>
        </div>
    </div>
    <flux:separator variant="subtle" class="my-2" />

    <div class="grid justify-center">
        <h1 class="text-2xl font-bold mb-4">Scan QR Code Absensi Masuk <span class="text-red-500">{{ $kelas->name }}</span></h1>
        <div id="reader" style="width: 300px;"></div>
    </div>
    
</div>
