@section('header-message')
    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('guru.dashboard') }}">
            <div class="flex gap-2">
                <flux:icon.home variant="mini" /> 
                <span class="hidden sm:flex">Home</span>
            </div>
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('bahan.ajar') }}">Bahan Ajar</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Chat Bot</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <x-slot:title>Aplikasi Absensi | Absensi | {{  Auth::user()->role->name }} </x-slot:title>
@endsection
@php
    $profil_path = Auth::user()->profil_path ?? 'storage/assets/avatar.png';
    if (!is_null(Auth::user()->profil_path)) {
        $profil_path = 'storage/assets/profile_pictures/'.Auth::user()->profil_path;
    }
@endphp
<div>
    <div class="md:flex">
        <div class="grid">
            <flux:heading size="xl" class="font-extrabold" level="1">Chat Bot</flux:heading>
            <flux:text class="font-semibold">Ini adalah layanan Chat Bot AI yg terIntegrasi dengan model: Chat Gemini</flux:text> 
            <flux:text class="mb-2 mt-2 text-red-500">Harap diperhatikan, Informasi yg disampaikan oleh AI belum tentu sepenuhnya Benar, Harap periksa kembali Informasi yg telah disampaikan</flux:text>
        </div>
        <flux:spacer />
        <div class="flex justify-center items-end gap-5">
            <a href="https://gemini.google.com/" target="_blank" rel="noopener noreferrer">
                <flux:icon.gemini class="size-24" />
            </a>
            <flux:modal.trigger name="clear-chat">
                <flux:button variant="ghost" icon="backspace" class="lg:mt-15">Clear Chat</flux:button>
            </flux:modal.trigger>
        </div>

    </div>
    
    <flux:separator variant="subtle" class="mb-5"/>

    <div class="flex flex-col items-center lg:w-4/6 mx-auto">
        <div class="w-full border rounded-lg shadow-md p-5 mb-4">
            <flux:text class="mb-2 font-mono text-red-500">AI memberikan jawaban berdasarkan data yang ada, namun jangan lupa untuk selalu memverifikasi informasi tersebut dengan sumber yang terpercaya. Pikiran kritis tetaplah aset terpenting.</flux:text>
            <hr>
            <div class="chat-messages pr-3 overflow-y-auto h-96">
                @foreach ($messages as $item)
                    <div class="lg:grid mt-2 mb-4">
                        <div class="flex items-end justify-end mt-2 mb-2">
                           <flux:profile :chevron="false" avatar="{{ asset($profil_path) }}" class="w-8 h-8 rounded-full" />
                        </div>
                        <div class="flex items-end justify-end">
                            @isset($item['question'])
                                <span class="inline-block rounded-lg py-2 px-4 bg-blue-500 text-white">
                                    {{ $item['question'] }}
                                </span>
                            @endisset
                        </div>
                    </div>
                    <div class="items-start mb-2">
                        <flux:icon.gemini class="bg-gray-300 rounded-full size-10 mb-2" />
                        <div class="text-left ml-3">
                            @isset($item['answer'])
                                <span class="inline-block rounded-lg py-2 px-4 bg-gray-200 text-gray-800 whitespace-pre-line">
                                    {{ $item['answer'] }}
                                </span>
                            @endisset
                        </div>
                    </div>
                    <hr>        
                @endforeach
            </div>
        </div>
    </div>

    <form wire:submit.prevent="askQuestion">
        <div class="flex flex-col items-center lg:w-4/6 mx-auto">
            <div class="lg:flex w-full gap-2">
                <flux:textarea wire:model="question" placeholder="Type your question..." rows="2" required/>
                <div class="flex items-center justify-end mt-2 lg:mt-0">
                    <flux:button variant="primary" type="submit" icon="paper-airplane">Ask</flux:button>
                </div>
            </div>
        </div>
    </form> 

    <flux:modal name="clear-chat" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Clear theses Chat?</flux:heading>
                <flux:text class="mt-2">
                    <p>You're about to Clear this conversation.</p>
                    <p>This action cannot be reversed.</p>
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="removeChat">Clear chat</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
