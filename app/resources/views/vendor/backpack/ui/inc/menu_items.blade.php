{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>



<x-backpack::menu-dropdown title="Модели" icon="la la-group">
    <x-backpack::menu-dropdown-item title="Tg messages" icon="la la-envelope" :link="backpack_url('tg-message')" />
    <x-backpack::menu-dropdown-item title="Tg users" icon="la la-user" :link="backpack_url('tg-user')" />
</x-backpack::menu-dropdown>
<x-backpack::menu-item title="Jobs" icon="la la-question" :link="backpack_url('jobs')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
<x-backpack::menu-item title="Tg unhandled updates" icon="la la-question" :link="backpack_url('tg-unhandled-update')" />