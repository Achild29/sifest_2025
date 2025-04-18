<flux:sidebar sticky stashable class="bg-zinc-50 dark:bg-zinc-900 border-r rtl:border-r-0 rtl:border-l border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

    <flux:brand href="#" logo="https://my.unpam.ac.id/icons/logo.png" name="Sprinter" class="px-2 dark:hidden" />
    <flux:brand href="#" logo="https://my.unpam.ac.id/icons/logo.png" name="Sprinter" class="px-2 hidden dark:flex" />

    {{-- <flux:input as="button" variant="filled" placeholder="Search..." icon="magnifying-glass" /> --}}

    <flux:navlist variant="outline" class="gap-y-1">
        
        {{-- <flux:navlist.item icon="inbox" badge="12" href="#">Inbox</flux:navlist.item> --}}
        @if (Auth::user()->role->value == 'Admin')
            <flux:navlist.item icon="home" href="{{ route('admin.dashboard') }}">Home</flux:navlist.item>
            
        @endif
        @if (Auth::user()->role->value == 'Guru')
            <flux:navlist.item icon="home" href="{{ route('guru.dashboard') }}">Home</flux:navlist.item>
                    
        @endif
        @if (Auth::user()->role->value == 'Siswa')
            <flux:navlist.item icon="home" href="{{ route('siswa.dashboard') }}">Home</flux:navlist.item>
                    
        @endif
    </flux:navlist>
</flux:sidebar>