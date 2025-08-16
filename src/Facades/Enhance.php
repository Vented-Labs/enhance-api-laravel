<?php

namespace Vented\EnhanceApiLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Vented\EnhanceApiLaravel\EnhanceApiLaravel
 */
class Enhance extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Vented\EnhanceApiLaravel\EnhanceApiLaravel::class;
    }
}
