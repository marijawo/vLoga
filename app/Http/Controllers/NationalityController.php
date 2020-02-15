<?php

namespace App\Http\Controllers;

use App\Nationality;
use Illuminate\Http\Request;

class NationalityController extends Controller
{

    public function index()
    {
        $all_nationalities = Nationality::all();
        return response()->json([
            'data' => $all_nationalities,
            'message' => 'All Nationalities'
        ],200);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $new_nationality = Nationality::create($this->validateRequest());
        return response()->json([
            'data' => $new_nationality,
            'message' => 'Added Nationality'
        ],200);
    }


    public function show($id)
    {
        $single_nationality = Nationality::findOrFail($id);
        return response()->json([
            'data' => $single_nationality,
            'message' => 'Show single nationality'
        ],200);
    }


    public function edit(Nationality $nationality)
    {
        //
    }


    public function update($id)
    {
        $update_nationality = Nationality::findOrFail($id);
        $update_nationality->name = request()->name;
        $update_nationality->save();

        return response()->json([
            'data' => $update_nationality,
            'message' => 'Update Success'
        ],200);
    }


    public function destroy($id)
    {
        $delete_employee = Nationality::findOrFail($id);
        $delete_employee->delete();
        return response()->json([
            'data' => $delete_employee,
            'message' => 'Deleted Employee'
        ],200);
     }

    public function validateRequest() {
        return request()->validate([
            'name' => 'required'
        ]);
    }
}
