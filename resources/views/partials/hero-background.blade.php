@php
    $image = $image ?? 'images/hero-home.jpg';
@endphp
<div class="hero-background" aria-hidden="true" style="background-image: url('{{ asset($image) }}');"></div>
