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
       //( here' we're randomising the data to satisfy the requriement that the groups should change on refresh )
       $shapes = Shape::orderBy(DB::raw('RAND()'))->get();;

       // next we take that data we've gathered from the database, and we hand it off to a 'SortingService' this is designed this way try
       // to minimise the amount of business logic added to controllers and increases re-usability
       $sortOutput = (new SortingService($shapes))->execute();



       // This should really be here, instead we should take '$sortOutput' and hand it off to a 'view' that would be responsible for rendering the data however we want.
       // but instead we're just printing to the screen.

       $sortOutput->each(function ($group, $key){

           echo '<h2>Group '. ($key + 1) . '</h2><br/>';

           $group->each(function ($shape, $key){

               echo '    '. $shape->colour . ' - ' . $shape->type . '<br/>' ;

           });

        });

   }

}
