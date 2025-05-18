@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Bahan Ajar</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Absensi | {{  Auth::user()->role->name }} </x-slot:title>
@endsection
<div>
    <flux:heading size="xl" class="font-extrabold" level="1">Bahan Ajar</flux:heading>
    <flux:text class="mb-2 mt-2 font-semibold">This page you can manage your moduls</flux:text>
    <flux:separator variant="subtle" class="mb-5"/>
    
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 px-4 py-3 ">
        <div x-data="{ searchFocused: false, focusSearch() { this.searchFocused = true; $wire.searchFocus(); } }">
            <flux:input
            icon="magnifying-glass"
            wire:model.live="search"
            placeholder="Search by Modul Name or Class Name..."
            @focus="focusSearch()"
            @blur="searchFocused = false"
            />
        </div>
        <div class="text-center">
            <flux:heading size="xl" class="font-extrabold" level="1">Bahan Ajar <br> Yang Anda Miliki</flux:heading>
        </div>
        <div class="flex">
            <flux:modal.trigger name="add-modul">
                <flux:button icon="plus" class="bg-green-500" variant="primary">Tambah Modul</flux:button>
            </flux:modal.trigger>
            <flux:spacer />
            <div class="grid justify-end items-end">
                Butuh Inspirasi?
                <a href="{{ route('chatbot') }}" class="dark:hover:bg-zinc-600 hover:bg-zinc-100 rounded-2xl border">
                    <flux:icon.gemini class="size-24" />
                </a>
            </div>
        </div>
    </div>
    <div class="grid lg:grid-cols-3 gap-5 mb-2">
        @foreach ($moduls as $item)
            <div class="bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-800 p-5 rounded-xl h-96 w-[360px] lg:w-full">
                @if ($item->extension === 'pptx' || $item->extension === 'ppt')
                    <div class="h-64 flex items-center justify-center">
                        <img src="{{ asset('storage/assets/ppt.svg') }}" alt="{{ $item->name }}" loading="lazy" class="max-w-full max-h-full object-contain">
                    </div>
                @endif
                @if ($item->extension === 'docx' || $item->extension === 'doc')
                    <div class="h-64 flex items-center justify-center">
                        <img src="{{ asset('storage/assets/doc.svg') }}" alt="{{ $item->name }}" loading="lazy" class="max-w-full max-h-full object-contain">
                    </div>
                @endif
                @if ($item->extension === 'pdf')
                    <div class="h-64 flex items-center justify-center">
                        <img src="{{ asset('storage/assets/pdf.svg') }}" alt="{{ $item->name }}" loading="lazy" class="max-w-full max-h-full object-contain">
                    </div>
                @endif
                
                <h4 class="font-raleway font-bold mt-2.5">{{ $item->name }}</h4>
                <div class="flex gap-2 mb-1">
                    <p> {{ $item->classRoom->name  }} </p>
                    <flux:tooltip content="klik untuk menambahkan modul ini ke kelas lain">
                        <flux:button variant="ghost" size="xs" wire:click="showShare({{$item->id}})">+ share for an other class</flux:button>
                    </flux:tooltip>
                </div>
                <div class="flex flex-cols-3 gap-2 justify-center">
                    <a href="{{ asset('storage/assets/modul/'.$item->modul_path) }}" target="_blank" rel="noopener noreferrer">
                        <flux:button icon="arrow-down-tray" variant="primary">Download</flux:button>
                    </a>
                    <flux:button icon="pencil-square" variant="filled" wire:click="showEdit({{$item->id}})">Edit</flux:button>
                    <flux:button icon="trash" variant="danger" wire:click="showDelete({{$item->id}})">Hapus</flux:button>
                </div>
            </div>
        @endforeach
    </div>
    {{ $moduls->links() }}

    @if ($moduls->count() <= 0)
        <div class="grid items-center text-center bg-rose-100 lg:h-[550px] h-96 rounded-2xl shadow-2xl">
            <flux:heading size="xl" class="font-extrabold text-red-500" level="1">Anda belum memiliki Bahan Ajar</flux:heading>
        </div>
    @endif

    <flux:modal name="add-modul" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add Modul</flux:heading>
                <flux:text class="mt-2">Menambahakan Modul Baru</flux:text>
            </div>
            
            <flux:input label="Name Modul" placeholder="Judul Modul" wire:model="namaModul" />
            <flux:select wire:model.live="selectedClass" label="Kelas">
                <flux:select.option selected>pilih kelas</flux:select.option>
                @foreach ($kelas as $item)
                    <flux:select.option value="{{ $item->id }}">{{ $item->name }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:input type="file" wire:model="modul" label="Modul" description="Modul yg dapat di upload berupa .docx .doc .pdf .ppt .pptx"/>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="addModul">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="edit-modul" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Modul</flux:heading>
                <flux:text class="mt-2">Make changes to your Modul.</flux:text>
            </div>

            <flux:input label="Name Modul" placeholder="Judul Modul" wire:model="namaModul" />
            <flux:select wire:model.live="selectedClass" label="Kelas">
                @if (!is_null($kelasSelectedId))
                    <flux:select.option value="{{ $kelasSelectedId->id }}" selected>{{ $kelasSelectedId->name }}</flux:select.option>
                @endif
                @if ($kelasBaru && $kelasBaru->isNotEmpty())
                    @foreach ($kelasBaru as $item)
                        <flux:select.option value="{{ $item->id }}">{{ $item->name }}</flux:select.option>
                    @endforeach
                @endif
            </flux:select>
            <flux:input type="file" wire:model="modul" label="Modul" description="Modul yg dapat di upload berupa .docx .doc .pdf .ppt .pptx"/>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="editModul">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="delete-modul" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Delete modul?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to delete this modul.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" icon="trash" wire:click="deleteModul">Delete modul</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="share-modul" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Share Modul</flux:heading>
                <flux:text class="mt-2">Share this modul to an other class</flux:text>
            </div>
            <flux:field variant="inline">
                <flux:checkbox label="{{ $kelasSelected }}" checked disabled/>
            </flux:field>
            <flux:checkbox.group wire:model="kelasSelectedBaru" label="Pilih Kelas" >
                @if ($kelasBaru && $kelasBaru->isNotEmpty())
                    @foreach ($kelasBaru as $item)
                        <flux:checkbox label="{{ $item->name }}" value="{{ $item->id }}" />
                    @endforeach
                @endif
            </flux:checkbox.group>
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="shareModul">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>


</div>
