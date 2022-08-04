<?php

namespace App\Http\Services;


use App\Shape;
use Illuminate\Support\Collection;

class SortingService
{

    protected $input;

    protected $typePerGroup;

    protected $colourPerGroup;

    public $outputCollection;


    // we have a simple constructor here designed to 'set up' the service when it's first instantiated.
    // in this case, it's taking the input and storing it as a property, but it's also running a method that is designed to create the ruleset provided.
    public function __construct($input)
    {
        $this->input = $input;
        $this->outputCollection = collect();
        $this->defineRules();
    }

    // this is the 'main' function that this service runs its responsible for taking the data we've provided from the controller,
    // and returning the groups that we need based on the rules set at the bottom of this file.
    public function execute(): Collection
    {
        // loop through the input collection, and start to add them to their new homes in the output collection
        $this->input->each(function (Shape $shape) {

            //added a simple counter to ensure that we only add the shape once.
            $shapeSorted = false;

            // this is necessary for the first run, if we're on the first shape the code will break, so we need to skip the 'check' and just add it to the first group.
            if ($this->outputCollection->isNotEmpty()){

                // now we're looping through the 'output collection' as we need to know what's already in each group before we add more!
                $this->outputCollection->each(function ($group, $key) use ($shape, &$shapeSorted) {

                    // run a function created to determine if the shape will fit in the current group. ( will skip if shape has already found a home )
                    if($this->checkShapesValidityInGroup($shape, $group, $key))
                    {
                        // check passed, and it'll fit here fine, so we add it to the group, then update the $shapeSorted Variable to ensure we skip through.
                        /* @var $group Collection */
                        $group->push($shape);
                        $shapeSorted = true;
                        return false;
                    }

                    // if that won't fit anymore, then check the next group
                });

                // if we are here and the shape still hasn't been added to a group, then we know that we'll need to create a new group with that shape.
                // and we'll need to create a new group for the shape.
            }


            // simple check to ensure that we only add the shape to a new group if the shape hasn't been sorted though the check for whatever reason.
            if(!$shapeSorted)
            {
                $this->outputCollection->add(
                    collect(
                        array($shape)
                    )
                );
            }

        });

        return $this->outputCollection;

    }

    public function checkShapesValidityInGroup(Shape $shape, Collection $group, $key): bool
    {
        $currentGroupCounterColour = [];
        $currentGroupCounterType = [];

        $valid = true;

        // firstly we need to loop through the 'existing' group that were checking to calculate what's already in there.
        // note because we're using anonymous functions here, we need to prepend the 'used' variables outside the scope with & to tell php that we want them to be updated.
        $group->each(function ($groupShape) use (&$valid, &$currentGroupCounterColour, &$currentGroupCounterType, $shape, $key, $group) {

            // add the current 'group shape colour' to the counter
            if (array_key_exists($groupShape->colour, $currentGroupCounterColour)){
                    $currentGroupCounterColour[$groupShape->colour] ++;
            }else{
                $currentGroupCounterColour[$groupShape->colour] = 1;
            }

            // add the current 'group shape type' to the counter
            if (array_key_exists($groupShape->type, $currentGroupCounterType)){
                $currentGroupCounterType[$groupShape->type] ++;
            }else{
                $currentGroupCounterType[$groupShape->type] = 1;
            }

        });

        // Now we have an understanding of what is already in this group, compare that with what shape we're checking and the rules that have been set.

        /* @var $shape Shape */
        if (array_key_exists($shape->colour, $currentGroupCounterColour)) {
            if (($currentGroupCounterColour[$shape->colour] + 1 ) > $this->colourPerGroup[$shape->colour]) {
                $valid = false;
            }
        }


        /* @var $shape Shape */
        if (array_key_exists($shape->type, $currentGroupCounterType)) {
            if (($currentGroupCounterType[$shape->type] + 1 ) > $this->typePerGroup[$shape->type]) {
                $valid = false;
            }
        }

        return $valid;
    }

    public function defineRules()
    {

        /*
        * RULES -
        *
        * ONLY ONE COLOUR ALLOWED PER EACH GROUP ( MAYBE NEEDS ALL FOUR COLOURS, NOT CLEAR )
        *
        * ONLY ONE SHAPE TYPE ALLOWED PER GROUP ( NOTE SQUARES ARE ALLOWED 2 )
        *
        * NO LIMIT ON NUMBER OF GROUPS
        *
        */

        //Similar to the seeding function, I've created an algorithmic representation of the rules,
        //so they can be modified easily in the future. but a config / database would make this even better in a real use case to avoid deployment.

        $this->typePerGroup = [
            'square' => 2,
            'triangle' => 1,
            'circle' => 1,
            'pentagon' => 1,
            'hexagon' => 1,
        ];

        $this->colourPerGroup = [
            'red' => 1,
            'blue' => 1,
            'green' => 1,
            'yellow' => 1,
        ];
    }

}
