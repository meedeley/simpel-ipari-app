@props(['href' => '', 'label' => '', 'icon' => ''])

<li class="sidebar-item">
    <a class="sidebar-link" href="{{ $href }}" aria-expanded="false">
        <i class="ti ti-{{ $icon }}"></i>
        <span class="hide-menu">{{ $label }}</span>
    </a>
</li>