<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardButton extends Component
{
    public $bgCardColor;
    public $btnColor;
    public $url;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($bgCardColor, $btnColor, $url)
    {
        $this->bgCardColor = $bgCardColor;
        $this->btnColor = $btnColor;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.card-button');
    }
}
