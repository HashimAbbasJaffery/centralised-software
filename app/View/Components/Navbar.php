<?php

namespace App\View\Components;

use App\Service\UserService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Request;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $token)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
