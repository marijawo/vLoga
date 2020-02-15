<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

 public function index ()
 {
  $departments = Department::with('institution')->get();
  return response()->json( [
   'data' => $departments,
   'message' => 'List of departments'
  ], 200 );
 }


 public function store (Request $request)
 {
  $new_department = Department::create( $this->validateRequest() );
  return response()->json( [
   'data' => $new_department,
   'message' => 'Added Department'
  ], 200 );
 }

 //Show method
 public function show ($id)
 {
     $single_department = Department::findOrFail($id);
     return response()->json([
      'data' => $single_department,
      'message' => 'Single department'
     ],200);
 }


 // Edit method


 public function update ($id)
 {
  $edit_department = Department::findOrFail( $id );
  $edit_department->name = request()->name;
  $edit_department->institution_id = request()->institution_id;
  $edit_department->save();
  return response()->json( [
   'data' => $edit_department,
   'message' => 'Edit Department'
  ], 200 );
 }


 public function destroy ($id)
 {
  $delete_department = Department::findOrFail();
  $delete_department->delete();
  return response()->json( [
   'data' => $delete_department,
   'message' => 'Department Deleted'
  ], 200 );
 }

 public function validateRequest ()
 {
  return request()->validate( [
   'name' => 'required',
   'institution_id' => 'required'
  ] );
 }
}
