<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shape extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'shapes';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

}
