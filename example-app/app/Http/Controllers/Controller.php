<?php

namespace App\Http\Controllers;

use App\Shape;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Services\SortingService;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

   public function index()
   {
       // ENTRY POINT INTO THE APPLICATION, HERE WE DECIDE WHAT WE'RE GOING TO DO.

       //Retrieve all 'shapes' from the database, and store them in a collection.
//       $shapes = Shape::all();

       $shapes = Shape::orderBy(DB::raw('RAND()'))->get();;

       $sortOutput = (new SortingService($shapes))->execute();

       $sortOutput->each(function ($group, $key){

           echo '<h2>Group '. ($key + 1) . '</h2><br/>';

           $group->each(function ($shape, $key){

               echo '    '. $shape->colour . ' - ' . $shape->type . '<br/>' ;

           });

        });

       /*
        * RULES -
        *
        * ONLY ONE COLOUR ALLOWED PER EACH GROUP
        *
        * ONLY ONE SHAPE TYPE ALLOWED PER GROUP ( NOTE SQUARES ARE ALLOWED 2 )
        *
        * NO LIMIT ON NUMBER OF GROUPS
        *
        */




   }

}
