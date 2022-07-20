<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Divison;
use App\Models\Division;
use App\Models\Upazila;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpazilaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisions = ['Dhaka','Rajshahi','Sylhet','Khulna','Ctg'];

        $dhaka = ["Dhaka 1","Dhaka 2","Dhaka 3","Dhaka 4","Dhaka 5"];
        $Rajshahi = ["Rajshahi 1","Rajshahi 2","Rajshahi 3","Rajshahi 4","Rajshahi 5"];
        $Sylhet = ["Sylhet 1","Sylhet 2","Sylhet 3","Sylhet 4","Sylhet 5"];
        $Khulna = ["Khulna 1","Khulna 2","Khulna 3","Khulna 4","Khulna 5"];
        $Ctg = ["Ctg 1","Ctg 2","Ctg 3","Ctg 4","Ctg 5"];

        foreach($divisions as $div){
            Division::create([
                "name" => $div
            ]);
        }

        foreach($dhaka as $div){
            District::create([
                "name" => $div,
                "division_id" => 1
            ]);
        }
        foreach($Rajshahi as $div){
            District::create([
                "name" => $div,
                "division_id" => 2
            ]);
        }
        foreach($Khulna as $div){
            District::create([
                "name" => $div,
                "division_id" => 4
            ]);
        }
        foreach($Ctg as $div){
            District::create([
                "name" => $div,
                "division_id" => 5
            ]);
        }
        foreach($Sylhet as $div){
            District::create([
                "name" => $div,
                "division_id" => 3
            ]);
        }


        for($i = 1;$i<=5;$i++){
            Upazila::create([
                "name" => "Upazila {$i}",
                "district_id" => rand(1,5)
            ]);
        }
        for($i = 6;$i<=10;$i++){
            Upazila::create([
                "name" => "Upazila {$i}",
                "district_id" => rand(6,10)
            ]);
        }
        for($i = 11;$i<=15;$i++){
            Upazila::create([
                "name" => "Upazila {$i}",
                "district_id" => rand(11,15)
            ]);
        }

        for($i = 16;$i<=20;$i++){
            Upazila::create([
                "name" => "Upazila {$i}",
                "district_id" => rand(16,20)
            ]);
        }
        for($i = 21;$i<=25;$i++){
            Upazila::create([
                "name" => "Upazila {$i}",
                "district_id" => rand(21,25)
            ]);
        }
    }
}
