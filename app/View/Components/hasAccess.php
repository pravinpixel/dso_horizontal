<?php

namespace App\View\Components;

use Illuminate\View\Component;

class hasAccess extends Component
{
    public $menu_name;
    public $access = false;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->menu_name = format_route($name);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    { 
        if(auth_user_role()->slug != 'admin' && isset(auth_user_role()->permissions)) {
            foreach (auth_user_role()['permissions'] as $menu => $access) {
                if(is_array($this->menu_name)) {
                    if(in_array($menu,$this->menu_name) && $access == true) {
                        $this->access = true;
                    }
                } else {
                    if($menu == $this->menu_name && $access == true) {
                        $this->access = true;
                    }
                }
            }
        } else {
            $this->access = true;
        }
        return view('components.has-access');
    }
}