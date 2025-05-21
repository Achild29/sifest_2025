<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/x-icon" href="https://my.unpam.ac.id/icons/logo.png">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    <title>{{ $title ?? env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('build/assets/app-BAxmsT8G.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])        
    @fluxAppearance
    @stack('html5-qrcode')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
    <div class="sticky inset-x-0 top-0 z-50">
        <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:brand href="#" logo="https://my.unpam.ac.id/icons/logo.png" name="{{env('APP_NAME')}}" class=" dark:hidden" />
        <flux:brand href="#" logo="https://my.unpam.ac.id/icons/logo.png" name="{{env('APP_NAME')}}" class="hidden dark:flex" />
        <flux:spacer />
        <flux:navbar class="-mb-px">
            <flux:navbar.item href="#heroSection">Home</flux:navbar.item>
            <flux:navbar.item href="#perfomance">about</flux:navbar.item>
            
            <flux:separator vertical variant="subtle" class="my-2"/>
        
        </flux:navbar>
        <flux:spacer />
        <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle" aria-label="Toggle dark mode" />
        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon:trailing="arrow-up-right" href=" {{ route('login') }} " current>Start</flux:navbar.item>
                    
        </flux:navbar>
        </flux:header>
        
    </div>
    <div class="relative isolate px-6 pt-14 lg:px-8">
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-1155/678 w-144.5 -translate-x-1/2 rotate-30 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-288.75" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>

        <section id="heroSection">
            <div class="h-svh">
                <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-32 lg:px-8">
                    <div class="relative isolate overflow-hidden dark:bg-gray-900 bg-gray-100 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
                        <svg viewBox="0 0 1024 1024" class="absolute top-1/2 left-1/2 -z-10 size-256 -translate-y-1/2 mask-[radial-gradient(closest-side,white,transparent)] sm:left-full sm:-ml-80 lg:left-1/2 lg:ml-0 lg:-translate-x-1/2 lg:translate-y-0" aria-hidden="true">
                            <circle cx="512" cy="512" r="512" fill="url(#759c1415-0410-454c-8f7c-9a820de03641)" fill-opacity="0.7" />
                            <defs>
                            <radialGradient id="759c1415-0410-454c-8f7c-9a820de03641">
                                <stop stop-color="#7775D6" />
                                <stop offset="1" stop-color="#E935C1" />
                            </radialGradient>
                            </defs>
                        </svg>
                        <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
                            <h2 class="text-3xl font-semibold tracking-tight text-balance dark:text-zinc-300 text-gray-600 sm:text-4xl">Boost your productivity. Start using <span class="font-black text-gray-800 dark:text-white">CodeNest</span> today.</h2>
                            <p class="mt-6 text-lg/8 text-pretty text-gray-600 dark:text-gray-300">Tempat berkumpul dan belajar bersama para coder.</p>
                            <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
                            <a href=" {{ route('login') }} " class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-xs hover:bg-gray-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">Get started</a>
                            <a href="https://github.com/Achild29/sifest_2025" target="_blank" rel="noopener noreferrer" class="text-sm/6 font-semibold dark:text-white">Learn more <span aria-hidden="true">→</span></a>
                            </div>
                        </div>
                        <div class="relative mt-16 h-80 lg:mt-8">
                            <img class="absolute top-0 left-0 w-228 max-w-none rounded-md bg-white/5 ring-1 ring-white/10" src="{{asset('storage/assets/codenest.png')}}" alt="App screenshot" width="1824" height="1080">
                            <img class="absolute dark:hidden top-0 left-0 w-228 max-w-none rounded-md bg-white/5 ring-1 ring-white/10" src="{{asset('storage/assets/codenest_light.png')}}" alt="App screenshot" width="1824" height="1080">
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="perfomance">
            <div class="">
                <div class="mx-auto max-w-2xl px-6 lg:max-w-7xl lg:px-8 lg:pt-25">
                    <h2 class="text-center text-base/7 font-semibold text-indigo-600">work faster</h2>
                    <p class="mx-auto mt-2 max-w-lg text-center text-4xl font-semibold tracking-tight text-balance text-gray-950 dark:text-white sm:text-5xl">Everything you need in CodeNest</p>
                    <div class="mt-10 grid gap-4 sm:mt-16 lg:grid-cols-3 lg:grid-rows-2">
                    <div class="relative lg:row-span-2">
                        <div class="absolute inset-px rounded-lg bg-white lg:rounded-l-4xl"></div>
                        <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] lg:rounded-l-[calc(2rem+1px)]">
                        <div class="px-8 pt-8 pb-3 sm:px-10 sm:pt-10 sm:pb-0">
                            <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Mobile App</p>
                            <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Learn how to make Mobile Apps with us</p>
                        </div>
                        <div class="@container relative min-h-120 w-full grow max-lg:mx-auto max-lg:max-w-sm">
                            <div class="absolute inset-x-10 top-10 bottom-0 overflow-hidden rounded-t-[12cqw] border-x-[3cqw] border-t-[3cqw] border-gray-700 bg-gray-900 shadow-2xl">
                            <img class="size-full object-cover object-top dark:hidden" src="{{ asset('storage/assets/mobile.png') }}" alt="">
                            <img class="size-full object-cover object-top" src="{{ asset('storage/assets/mobile_dark.png') }}" alt="">
                            </div>
                        </div>
                        </div>
                        <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5 lg:rounded-l-4xl"></div>
                    </div>
                    <div class="relative max-lg:row-start-1">
                        <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-t-4xl"></div>
                        <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] max-lg:rounded-t-[calc(2rem+1px)]">
                        <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                            <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Skill up your Progamming</p>
                            <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Learn Programming with us</p>
                        </div>
                        <div class="flex flex-1 items-center justify-center px-8 max-lg:pt-10 max-lg:pb-12 sm:px-10 lg:pb-2">
                            <img class="w-full max-lg:max-w-xs" src="https://tailwindcss.com/plus-assets/img/component-images/bento-03-performance.png" alt="">
                        </div>
                        </div>
                        <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5 max-lg:rounded-t-4xl"></div>
                    </div>
                    <div class="relative max-lg:row-start-3 lg:col-start-2 lg:row-start-2">
                        <div class="absolute inset-px rounded-lg bg-white"></div>
                        <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)]">
                        <div class="px-8 pt-8 sm:px-10 sm:pt-10">
                            <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Web Developer</p>
                            <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Learn How to make Web App with us.</p>
                        </div>
                        <div class="@container flex flex-1 items-center max-lg:py-6 lg:pb-2">
                            <img class="h-[min(152px,40cqw)] object-cover" src="https://tailwindcss.com/plus-assets/img/component-images/bento-03-security.png" alt="">
                        </div>
                        </div>
                        <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5"></div>
                    </div>
                    <div class="relative lg:row-span-2">
                        <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-b-4xl lg:rounded-r-4xl"></div>
                        <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(var(--radius-lg)+1px)] max-lg:rounded-b-[calc(2rem+1px)] lg:rounded-r-[calc(2rem+1px)]">
                        <div class="px-8 pt-8 pb-3 sm:px-10 sm:pt-10 sm:pb-0">
                            <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">with Familiar framework</p>
                            <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Laravel 12, Livewire, Flux UI, TailwindCSS and much more dependcies</p>
                        </div>
                        <div class="relative min-h-120 w-full grow">
                            <div class="absolute top-10 right-0 bottom-0 left-10 overflow-hidden rounded-tl-xl bg-gray-900 shadow-2xl">
                            <div class="flex bg-gray-800/40 ring-1 ring-white/5">
                                <div class="-mb-px flex text-sm/6 font-medium text-gray-400">
                                <div class="border-r border-b border-r-white/10 border-b-white/20 bg-white/5 px-4 py-2 text-white">admin.blade.php</div>
                                <div class="border-r border-gray-600/10 px-4 py-2">app\Livewire\Admin.php</div>
                                </div>
                            </div>
                            <div class="px-6 pt-6 pb-14 font-mono">
                                <span class="text-blue-700">public function</span><span class="text-yellow-100"> mount</span><span class="text-purple-400">() {</span>
                                <br>
                                <div class="ml-10">
                                    <span class="text-blue-200"> $data </span>=<span class="text-green-600"> User</span>::<span class="text-yellow-100">where</span><span class="text-blue-400">(</span><span class="text-orange-400">'role'</span>, 
                                    <span class="text-green-600 ml-10">UserRoleEnums</span>::admin<span class="text-blue-400">)</span><br>
                                    <div class="ml-10">
                                        -><span class="text-yellow-100">paginate</span><span class="text-blue-400">(</span>10<span class="text-blue-400">)</span>;
                                    </div>
                                </div>
                                <span class="text-purple-400">}</span>
                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="pointer-events-none absolute inset-px rounded-lg shadow-sm ring-1 ring-black/5 max-lg:rounded-b-4xl lg:rounded-r-4xl"></div>
                    </div>
                    </div>
                </div>
                </div>

        </section>

        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
        <div class="relative left-[calc(50%+3rem)] aspect-1155/678 w-144.5 -translate-x-1/2 bg-linear-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-288.75" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
    </div>




    @fluxScripts
</body>
</html>