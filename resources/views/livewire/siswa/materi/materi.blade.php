@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Moduls</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Absensi | {{  Auth::user()->role->name }} </x-slot:title>
@endsection
<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Moduls</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can access your moduls</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 px-4 py-3 mb-5">
        <div x-data="{ searchFocused: false, focusSearch() { this.searchFocused = true; $wire.searchFocus(); } }">
            <flux:input
            icon="magnifying-glass"
            wire:model.live="search"
            placeholder="Search by Modul Name..."
            @focus="focusSearch()"
            @blur="searchFocused = false"
            />
        </div>
        <div class="text-center">
            <flux:heading size="xl" class="font-extrabold" level="1">Modul<br>yang anda miliki</flux:heading>
        </div>
        <div class="text-center lg:text-end">
            <flux:text size="xl">kelas: 
                <span class="font-bold">{{ $user->student->classRoom->name }}</span>
            </flux:text>
            <flux:text size="xl"><span class="font-bold">{{ $modul }}</span> moduls</flux:text>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-5 mb-3">
        @foreach ($moduls as $item)
            <div class="bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-800 p-5 rounded-xl h-96 w-[360px] lg:w-full">
                @if ($item->extension === 'pptx' || $item->extension === 'ppt')
                    <div class="h-64 flex items-center justify-center">
                        <img src="{{ asset('storage/assets/ppt.svg') }}" alt="" loading="lazy" class="max-w-full max-h-full object-contain">
                    </div>
                @endif
                @if ($item->extension === 'docx' || $item->extension === 'doc')
                    <div class="h-64 flex items-center justify-center">
                        <img src="{{ asset('storage/assets/doc.svg') }}" alt="" loading="lazy" class="max-w-full max-h-full object-contain">
                    </div>
                @endif
                @if ($item->extension === 'pdf')
                    <div class="h-64 flex items-center justify-center">
                        <img src="{{ asset('storage/assets/pdf.svg') }}" alt="" loading="lazy" class="max-w-full max-h-full object-contain">
                    </div>
                @endif
                <h4 class="font-raleway font-bold mt-2.5">{{ $item->name }}</h4>
                <p> {{ $user->student->classRoom->name }} </p>
                <div class="flex flex-cols-3 gap-2 justify-end">
                    <a href="{{ asset('storage/assets/modul/'.$item->modul_path) }}" target="_blank" rel="noopener noreferrer">
                        <flux:button icon="arrow-down-tray" variant="primary">Download</flux:button>
                    </a>
                </div>
            </div>    
        @endforeach
    </div>
    {{ $moduls->links() }}
</div>
