<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see App\Services\Area
 */
class Smenu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'smenu'; }
}
