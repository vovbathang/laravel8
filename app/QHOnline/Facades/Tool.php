<?php

namespace App\QHOnline\Facades;

use App\QHOnline\ToolFactory;
use Illuminate\Support\Facades\Facade;

class Tool extends Facade
{
    /**
     * @param string $string
     */
    public static function getThumbnail(string $string)
    {
    }

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ToolFactory::class;
    }
}
