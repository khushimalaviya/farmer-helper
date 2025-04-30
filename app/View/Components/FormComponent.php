<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormComponent extends Component
{
    public $fields;
    public $action;
    public $method;
    public $buttonText;

    public function __construct($fields, $action, $method = 'POST', $buttonText = 'Submit')
    {
        $this->fields = $fields;
        $this->action = $action;
        $this->method = $method;
        $this->buttonText = $buttonText;
    }
    
    public function render(): View|Closure|string
    {
        return view('components.form-component');
    }
}
