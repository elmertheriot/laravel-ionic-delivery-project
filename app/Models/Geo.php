<?php

namespace DOLucasDelivery\Models;

use Illuminate\Contracts\Support\Jsonable;

class Geo implements Jsonable
{
    public $lat;
    public $long;
    
    /**
     * {@inheritDoc}
     * @see \Illuminate\Contracts\Support\Jsonable::toJson()
     */
    public function toJson($options = 0)
    {
        return json_encode([
            'lat'  => $this->lat,
            'long' => $this->long
        ]);
    }
}
