<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function  truncate() {
        Employee::query()->truncate();
//        Employee::truncate();
    }

    public function index()
    {
//        $employees = Employee::latest()->with('department')->paginate(10);
        $employees = Employee::latest()->with('department')->get();
        return response()->json([
            'data' => $employees,
            'message' => 'List of employees - DONE'
        ], 200);
    }


    public function store(Request $request)
    {
        $new_employee = Employee::create($this->validateRequest());
        return response()->json([
            'data' => Employee::where('id', $new_employee->id)->with('department')->first(),
            'message' => 'Add Employee'
        ], 200);
    }


    public function import(Request $request)
    {


        // loop to save got employee
        $all_employees = request()->csv;

        foreach ($all_employees as $index => $employee) {

            if ($index == 0) {
                continue;
            }
//            return $employee['emp_code'];
            $new_employee = new Employee();
            $new_employee->emp_code = $employee['emp_code'];
            $new_employee->first_name = $employee['first_name'];
            $new_employee->middle_name = $employee['middle_name'] ? $employee['middle_name']: '';
            $new_employee->last_name = $employee['last_name'];
            $new_employee->job_title = $employee['job_title'];
/*            $new_employee->department_id = $employee['department_id'];
            $new_employee->phone = $employee['phone'];*/
            $new_employee->save();

        }
        return response()->json([
            'csv-single' => $new_employee,
            'data' => request()->all(),
            'message' => 'Add Employee'
        ], 200);
    }


    public function show($id)
    {
        $single_employee = Employee::findOrFail($id);
        return response()->json([
            'data' => $single_employee,
            'message' => 'Single employee'
        ], 200);
    }


    public function edit($id)
    {

    }


    public function update($id)
    {
        $update_employee = Employee::findOrFail($id);
        $update_employee->emp_code = request()->emp_code;
        $update_employee->first_name = request()->first_name;
        $update_employee->middle_name = request()->middle_name;
        $update_employee->last_name = request()->last_name;
        $update_employee->job_title = request()->job_title;
        $update_employee->department_id = request()->department_id;
        $update_employee->phone = request()->phone;
        $update_employee->save();
        return response()->json([
            'data' => $update_employee,
            'message' => 'Update employee'
        ], 200);
    }


    public function destroy($id)
    {
        $delete_employee = Employee::findOrFail($id);
        $delete_employee->delete();
        return response()->json([
            'data' => $delete_employee,
            'message' => 'Employee deleted'
        ]);
    }

    public function validateRequest()
    {
        return request()->validate([
            'emp_code' => 'required',
            'first_name' => 'required',
//            'middle_name' => 'required',
            'job_title' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'department_id' => 'required'
        ]);
    }

}

/*
$import_employee = request()->all();
$total_emp = count($import_employee);

$i = 0;
while ($i < $total_emp) {
    $import_employee[$i];



    $i++;
}*/
