<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hexagon extends Model {
    /*
     *
     * REFERENCE TO TABLE NAME
     *
     */
    protected $table = 'hexagons';

    /*
     *
     * REFERENCE TO TABLE PRIMARY ID
     *
     */
    protected $primaryKey = 'hexagon_id';
}