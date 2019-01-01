<?php

namespace ARJUN\ADMIN\FACADES;

use Illuminate\Support\Facades\Facade;

class INVISIBLERECAPTCHA extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'captcha';
    }

}
