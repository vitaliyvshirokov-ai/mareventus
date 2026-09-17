@props(['compact' => false])

<div class="route-map-art {{ $compact ? 'route-map-art-compact' : '' }}" aria-hidden="true">
    <img src="{{ asset('assets/images/map.png') }}" alt="" class="world-map-image">
</div>
