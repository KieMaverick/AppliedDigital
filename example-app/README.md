## Brief Description

This is a Laravel application developed under a specific ruleset provided by Applied Digital as a Technical Test

## Rules / Spec

- Only 1 of each colour allowed per group 
  - eg Each group must contain 1 red, 1 blue, 1 green and 1 yellow shape
- Max of 1 of each shape allowed per group, except squares which are allowed a max of 2 per group.
  - eg A group containing 2 squares, 1 triangle and 1 circle would be allowed
  - eg A group containing 1 square, 2 triangles and 1 circle would not be allowed

## Technical Explanation / Reasoning 

This piece was outline as a simple task to be designed and solved in assumed procedural php, but I felt it was useful to outline how the soltion 
may be solved in a framework such as Laravel utilising ORM Databases and Object Orientated Programming. 

## Setup for evaluation 
#### Requirements 
- php 7.2
- mysql

Ensure you have a local mysql installation running and create a new database for this application
the connection details need to be updated in `.env`

second to this, you will need to run the migrations and seeds using these commands

`$ php artisan migrate`

`$ php artisan db:seed`

This should have successfully created all the prerequisite data to run the application. 

next execute the local php server using this command

`$ php artisan serve`

the terminal window should provide you a link to access the application

### Important files / locations 

#### Routing 

In laravel web routing is handled in `routes/web.php` here is the initial entry point into the application
in this case, there is only one entry pointing you to a controller `app/Http/Controllers/Controller.php`


#### Controllers
As mentioned previously the one and only 'Controller' used in this application is `app/Http/Controllers/Controller.php`
under normal circumstances its one and only responsibility would be to gather the information requested, and hand it off to a 'view'
but in this instance it's also formatting the data for view, this is only done here in the interest of saving alittle time. 

#### Services
The controller hand's off the information gathered from the database to a service `app/Http/Services/SortingService.php`. A service's responsibility in this instance is to house 
the business logic, the idea here is if we decided in future that we actually wanted to sort the data in a different way, we could create a
second service to handle that. or perhaps we wanted to reuse the sorting function itself elsewhere in the application then we can do that easily. 

##### Note, in this service I've dynamically defined the rules, so they can be changed easily and the application will accommodate. 

#### Database Seeder
A Database seeder is responsible for creating the pre-requisite data for the application, `database/seeds/ShapeSeeder.php` I decided to go down 
this route, and programmatically define the structure so once again I can modify the shapes/colour combinations that are added to the system easily. 

#### Models
In this application, there is only one model defined `app/Shape.php`. This is an incredibly simple model as we haven't defined any 'Accessors' or 'Mutators'
but here would be where you would define 'data specific logic'. 

