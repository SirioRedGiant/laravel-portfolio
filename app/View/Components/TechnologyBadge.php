<?php

namespace App\View\Components;

use App\Models\Technology;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


//note lanciando il comando => php artisan make:component TechnologyBadge non ha creato due componenti diversi, ha semplicemente creato le due parti dello stesso componente
//? Il Cervello --> La Classe PHP: Si occupa della logica, quindi dei calcoli dei colori e di ricevere i dati.
class TechnologyBadge extends Component
{
    public $technology;
    public $badgeStyle;

    /**
     * Create a new component instance.
     */
    public function __construct(Technology $technology)
    {
        $this->technology = $technology;
        $this->badgeStyle = $this->generateSoftStyle();
    }

    /**
     * logica per creare l'effetto Badge trasparente
     */
    private function generateSoftStyle(): string
    {
        // se non c'è colore, usa il colore di fallback
        $hexColor = $this->technology->color ?? '#0dcaf0';

        // rimuove l'hash
        $hex = str_replace('#', '', $hexColor);

        //fixed gestione di eventuali codici corti come #FFF
        if (strlen($hex) == 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        // '26' finale sul background = 15% opacità
        // '40' finale sul bordo = 25% opacità
        return "background-color: #{$hex}26; color: #{$hex}; border: 1px solid #{$hex}40;";
    }

    /**
     * iquesto indica quale file Blade deve renderizzare questo componente
     */
    public function render(): View|Closure|string
    {
        return view('components.technology-badge');
    }
}
