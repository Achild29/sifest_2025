@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>QR Code</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>{{env('APP_NAME')}} | Absensi | {{  Auth::user()->role->name }} </x-slot:title>
@endsection
<div>
    <div class="lg:flex">
        <div class="grid">
            <flux:heading size="xl" class="font-extrabold" level="1">QR Code</flux:heading>
            <flux:text class="mt-2 font-semibold">This page shows your QR Code</flux:text>
            <flux:text class="mb-2">QR Code digunakan untuk melakukan Absensi</flux:text>
            <flux:separator variant="subtle" class="mb-5"/>
        </div>
        <flux:spacer />
        <div class="flex gap-3 md:grid md:gap-0 justify-center">
            {{-- <div> --}}
            <div wire:poll>
                @if ($absensi)
                    @if ($masuk)
                        <div class="lg:flex flex-cols-2 gap-2 mb-2">
                            <div class="flex items-center font-bold p-5 text-xl bg-green-200 text-green-800 rounded-2xl mb-2">
                                ✅ Kamu sudah absen masuk hari ini.
                            </div>
                            <div class="p-4 bg-yellow-200 text-yellow-800 rounded-2xl">
                                ⏳ Menunggu scan QR untuk absen pulang...
                                <div x-data="{
                                    seconds: 60,
                                    start() {
                                        let interval = setInterval(() => {
                                            if (this.seconds > 0) {
                                                this.seconds--;
                                            } else {
                                                clearInterval(interval);
                                                window.location.href = '/';
                                            }
                                        }, 1000);
                                    }
                                }"
                                x-init="start">
                                    <p class="flex justify-center gap-2 text-lg font-bold text-red-600"><flux:icon.loading /><span x-text="seconds"></span> detik</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($pulang)
                        <div class="lg:flex flex-cols-2 gap-2">
                            <div class="flex items-center text-center font-bold p-5 text-lg lg:text-xl bg-cyan-200 text-cyan-800 rounded-2xl mb-2">
                                👍 Good Kamu sudah masuk hari ini.
                            </div>
                            <div x-data="{
                                seconds: 5,
                                start() {
                                    let interval = setInterval(() => {
                                        if (this.seconds > 0) {
                                            this.seconds--;
                                        } else {
                                           clearInterval(interval);
                                           window.location.href = '/';
                                        }
                                    }, 1000);
                                }
                            }"
                            x-init="start"
                            class="p-4 bg-cyan-200 text-center text-cyan-800 rounded-2xl mb-2">
                                Anda akan diarahkan ke Dashboard
                                <p class="text-red-600 flex gap-2 justify-center"><flux:icon.loading /> <span x-text="seconds"></span> detik</p>
                            </div>

                        </div>
                    @endif
                @else
                    <div class="p-4 bg-yellow-200 text-yellow-800 rounded-2xl">
                        ⏳ Menunggu scan QR untuk absen masuk...
                        <div x-data="{
                            seconds: 60,
                            start() {
                                let interval = setInterval(() => {
                                    if (this.seconds > 0) {
                                        this.seconds--;
                                    } else {
                                        clearInterval(interval);
                                         window.location.href = '/';
                                    }
                                }, 1000);
                            }
                        }"
                        x-init="start">
                            <p class="flex justify-center gap-2 text-lg font-bold text-red-600"><flux:icon.loading /><span x-text="seconds"></span> detik</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center lg:w-4/6 py-24 mx-auto rounded-2xl shadow-2xl bg-white border">
        <img src="{{ asset('storage/qr_code/'. Auth::user()->student->qr_path) }}" class="w-64 lg:w-fit" alt="qr_code">
    </div>
</div>
