<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Division;
use Illuminate\Http\Request;

class MultiDependencyController extends Controller
{
    public function index()
    {
        $divisions = Division::get();
        return view('multi-dependency',compact('divisions'));
    }

    public function getDistricts(Division $division)
    {
        return $division->load('districts');
    }

    public function getUpazilas(District $district)
    {
        return $district->load('upazilas');
    }
}
