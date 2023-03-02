<?php

namespace Claver\SmartQuery\Facades;
use Illuminate\Support\Facades\Facade;

class SmartModelFacade extends Facade{
    protected static function getFacadeAccessor(): string
    {
        return 'smart-model';
    }
}
