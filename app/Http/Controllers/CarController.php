<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Color;
use App\Models\Mechanic;
use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function index()
    {

//        $car=new Car();
//        $car->model="تيوتا";
//        $car->mechanic_id=1;
//        $car->save();
//        Car::create([
//            'model'=>"مرسيدس",
//            "mechanic_id"=>1
//        ]);
//
//        DB::insert('insert into cars(model,mechanic_id)
//values(?,?)',['tt',1]);

//        DB::table('cars')->insert([
//            [  'model'=>"مرسيدس", "mechanic_id"=>3],
//            [  'model'=>"car 2", "mechanic_id"=>4 ],
//            [  'model'=>"car 3", "mechanic_id"=>5],
//            [  'model'=>"car 4", "mechanic_id"=>6 ],
//            [  'model'=>"car 5", "mechanic_id"=>7 ],
//            [  'model'=>"car 6", "mechanic_id"=>8 ],
//       ]);


//        Owner::create([
//           'name'=> 'Osama',
//           'car_id'=> 1,
//        ]);

//        $m=Mechanic::get()->last();
$m=Mechanic::find(1);
//$car=Car::with(['mechanic','owner'])->find(1);
return dd($m->carOwner);
return dd($m->car->owner);
        $color=Color::find(1);
        return dd($color->cars);
        return dd($m->car->colors);
//        foreach ($m->car->colors as $color)
//        {
//
//        }
        return dd($m->car->owner);

    }
}
