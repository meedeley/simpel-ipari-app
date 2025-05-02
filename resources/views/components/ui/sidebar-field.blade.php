@props(['label' => '', 'icon' => ''])

<div>

    <li class="nav-small-cap">
        <i class="ti ti-{{ $icon }} nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">{{ $label }}</span>
    </li>

   {{ $slot }}
   
    <x-ui.sidebar-spacer/>
</div>

