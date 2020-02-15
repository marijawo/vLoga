<?php

namespace App\Http\Controllers;

use App\Institution;
use Illuminate\Http\Request;

class InstitutionController extends Controller
{

    public function index()
    {
        $institutions = Institution::latest()->get();
        return response()->json([
            $institutions,
            'data' => $institutions,
            'message' => 'load data success'
        ], 200);
    }


    public function store(Request $request)
    {
        $new_institute = Institution::create($this->validateRequest());
        return response()->json([
            'data' => $new_institute,
            'message' => 'Add success'
        ], 201);
    }


    public function show($id)
    {
        $single_institution = Institution::findOrFail($id);
        return response()->json([
            'data' => $single_institution,
            'message' => 'Single object'
        ]);
    }

    public function update($id)
    {
        $update_institution = Institution::findOrFail($id);
        $update_institution->name = request()->name;
        $update_institution->description = request()->description;
//  $update_institution->logo = request()->logo;
        $update_institution->save();
        return response()->json([
            'data' => $update_institution,
            'message' => 'Update success'
        ], 200);

    }

    public function destroy($id)
    {
        $delete_institution = Institution::findOrFail($id);
        $delete_institution->delete();
        return response()->json([

            'data' => $delete_institution,
            'message' => 'Delete Success'
        ], 200);

    }

    // validate form data
    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
            'description' => 'required',
//     'logo' => 'required'
        ]);
    }
}
