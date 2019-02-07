<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see App\Services\Area
 */
class Sproduct extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'sproduct'; }
}
