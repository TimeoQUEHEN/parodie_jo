<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MessageInfo extends Component
{

    public $type;
    public $message;

    public function __construct(String $type, String $message) {
        $this->type=$type;
        $this->message=$message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.message-info');
    }
}
