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
//
//    /**
//     * @var string
//     */
//    public $colour;
//
//
//    /**
//     * Allows Definition of Shape Type e.g Square, Circle, Triangle
//     * @var string
//     */
//    public $type;


//    /**
//     * @return string
//     */
//    public function getColour(): string
//    {
//        return $this->colour;
//    }
//
//    /**
//     * @param string $colour
//     */
//    public function setColour(string $colour): void
//    {
//        $this->colour = $colour;
//    }
//
//    /**
//     * @return string
//     */
//    public function getType(): string
//    {
//        return $this->type;
//    }
//
//    /**
//     * @param string $type
//     */
//    public function setType(string $type): void
//    {
//        $this->type = $type;
//    }

}
