<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public $id;
    public $title;
    public $backdrop;
    public $size;
    public $isShowCloseButton;
    public $scrollable;
    public $modaldialogscrollable;

    public function __construct($id, $title, $backdrop, $size = '', $isShowCloseButton = 'true' , $scrollable = '', $modaldialogscrollable = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->backdrop = $backdrop;
        $this->size = $size;
        $this->isShowCloseButton = $isShowCloseButton;
        $this->scrollable = $scrollable;
        $this->modaldialogscrollable = $modaldialogscrollable;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal');
    }
}
