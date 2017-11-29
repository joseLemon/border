<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Directory extends Model {
    /*
     *
     * REFERENCE TO TABLE NAME
     *
     */
    protected $table = 'directories';

    /*
     *
     * REFERENCE TO TABLE PRIMARY ID
     *
     */
    protected $primaryKey = 'directory_id';
}