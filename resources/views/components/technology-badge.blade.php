{{-- Il Corpo ==> La Vista Blade: Contiene solo l'HTML e decide come mostrare il badge a schermo  --}}
{{-- $attributes->merge()? ==> È uno strumento di Laravel. Significa che il badge ha già le sue classi di base, ma se quando lo si usa si decide di scriverci dentro altro, Laravel le unirà automaticamente senza rompere la grafica di base  --}}
<span {{ $attributes->merge(['class' => 'badge rounded-pill px-3 py-2 fw-semibold align-middle']) }} style="{{ $badgeStyle }}">
    <i class="bi bi-cpu me-1"></i>
    {{ $technology->name }}
</span>