<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Platform')" class="grid">
                @role('Student')
                <flux:navlist.item icon="home" :href="route('student.dashboard')" :current="request() -> routeIs('student.dashboard')"
                    wire:navigate>{{ __('Dashboard') }}
                </flux:navlist.item>
                @else
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request() -> routeIs('dashboard')"
                    wire:navigate>{{ __('Dashboard') }}
                </flux:navlist.item>
                @endrole

                @canany(['view.roles', 'create.roles', 'edit.roles', 'delete.roles'])
                <flux:navlist.item icon="user-group" :href="route('roles.index')"
                    :current="request()-> routeIs('roles.index')" wire:navigate>{{ __('Role') }}
                </flux:navlist.item>
                @endcanany

                @canany(['view.schools', 'create.schools', 'edit.schools', 'delete.schools'])
                <flux:navlist.item icon="academic-cap" :href="route('schools.index')"
                    :current="request()-> routeIs('schools.index')" wire:navigate>{{ __('Schools') }}
                </flux:navlist.item>
                @endcanany

                @canany(['view.programs', 'create.programs', 'edit.programs', 'delete.programs'])
                <flux:navlist.item icon="academic-cap" :href="route('programs.index')"
                    :current="request()-> routeIs('programs.index')" wire:navigate>{{ __('Programmes') }}
                </flux:navlist.item>
                @endcanany

                @canany(['view.departments', 'create.departments', 'edit.departments', 'delete.departments'])
                <flux:navlist.item icon="academic-cap" :href="route('departments.index')"
                    :current="request()-> routeIs('departments.index')" wire:navigate>{{ __('Departments') }}
                </flux:navlist.item>
                @endcanany

                @canany(['view.students', 'create.students', 'edit.students', 'delete.students'])
                <flux:navlist.item icon="user-circle" :href="route('students.index')"
                    :current="request()-> routeIs('students.index')" wire:navigate>{{ __('Manage Students') }}
                </flux:navlist.item>
                @endcanany

                @canany(['view.staffs', 'create.staffs', 'edit.staffs', 'delete.staffs'])
                <flux:navlist.item icon="user" :href="route('staffs.index')"
                    :current="request()-> routeIs('staffs.index')" wire:navigate>{{ __('Manage Staffs') }}
                </flux:navlist.item>
                @endcanany

                @canany(['view.settings', 'create.settings', 'edit.settings', 'delete.settings'])
                <flux:navlist.item icon="cog" :href="route('settings.admin')"
                    :current="request()-> routeIs('settings.admin')" wire:navigate>{{ __('Admin Settings') }}
                </flux:navlist.item>
                @endcanany

                @canany(['view.idc', 'create.idc', 'edit.idc', 'delete.idc'])
                <flux:navlist.item icon="credit-card" :href="route('idcard.pay')"
                    :current="request()-> routeIs('idcard.pay')" wire:navigate>{{ __('ID Card') }}
                </flux:navlist.item>
                @endcanany

                @canany(['view.transcript', 'create.transcript', 'edit.transcript', 'delete.transcript'])
                <flux:navlist.item icon="document-currency-bangladeshi" :href="route('transcripts.pay')"
                    :current="request()-> routeIs('transcripts.pay')" wire:navigate>{{ __('Transcript') }}
                </flux:navlist.item>
                @endcanany
            </flux:navlist.group>
        </flux:navlist>

        <flux:navlist variant="outline">
            @canany(['view.items', 'create.items', 'edit.items', 'delete.items', 'view.structures', 'create.structures', 'edit.structures', 'delete.structures'])
            <flux:navlist.group :heading="__('Inventory')" class="grid" expandable>
                @canany(['view.structures', 'create.structures', 'edit.structures', 'delete.structures'])
                <flux:navlist.item icon="home-modern" :href="route('structures')" :current="request() -> routeIs('structures')"
                    wire:navigate>{{ __('Structure') }}
                </flux:navlist.item>
                @endcanany
                
                @canany(['view.items', 'create.items', 'edit.items', 'delete.items'])
                <flux:navlist.item icon="cog" :href="route('items')" :current="request() -> routeIs('items')"
                    wire:navigate>{{ __('Items') }}
                </flux:navlist.item>
                @endcanany
            </flux:navlist.group>
            @endcanany
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline" class="hidden">
            <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit"
                target="_blank">
                {{ __('Repository') }}
            </flux:navlist.item>

            <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                target="_blank">
                {{ __('Documentation') }}
            </flux:navlist.item>
        </flux:navlist>

        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile 
            :name="auth()->user()->name"
            :initials="auth()->user()->initials()"
            icon:trailing="chevrons-up-down"
            avatar:color="auto"
            />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials() "icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
