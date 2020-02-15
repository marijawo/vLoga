<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function index()
    {
//        $all_visitors = Visitor::all();
        $all_visitors = Visitor::with('institution', 'document_type', 'employee', 'nationality', 'visitor_card',
            'department')->get();
       /* $all_visitors = Visitor::with('institution', '
       document_type', 'employee', 'nationality', 'visitor_card',
            'department')->simplePaginate(5);*/
        return response()->json([
            'data' => $all_visitors,
            'message' => 'List of all visitors'
        ], 200);
    }

    public function create()
    {
        //
    }

    /*public function checkedOutVisitors() {
        $checked_visitors = Visitor::inActiveVisitors()->get();
        return response()->json([
            'data' => $checked_visitors,
            'message' => 'Checked our visitors'
        ], 200);
    }*/

    public function store(Request $request)
    {
        $this->validateRequest();


        $current_data = Carbon::now();
        $new_visitor = new Visitor();

        $new_visitor->first_name = request('first_name');
        $new_visitor->middle_name = request('middle_name');
        $new_visitor->last_name = request('last_name');
        $new_visitor->gender = request('gender');
        $new_visitor->nationality_id = request('nationality_id');
        $new_visitor->phone = request('phone');
        $new_visitor->document_type_id = request('document_type_id');
        $new_visitor->document_number = request('document_number');
        $new_visitor->employee_id = request('employee_id');
        $new_visitor->institution_id = request('institution_id');
        $new_visitor->visiting = request('visiting');
        $new_visitor->purpose = request('purpose');
        $new_visitor->visitor_card_id = request('visitor_card_id');
        $new_visitor->time_in = Carbon::now()->format('H:i');
//        $new_visitor->time_out = request('time_out');

        if ($new_visitor) {
            $new_visitor->load('institution', 'nationality', 'visitor_card', 'employee', 'document_type', 'department');
        }
        $new_visitor->save();

//        $time_difference = $new_visitor->time_out - $new_visitor->time_in;

        return response()->json([
            'data' => $new_visitor,
//            'td' => $time_difference,
            'message' => 'Visitor Added'
        ], 200);

    }



    public function import(Request $request)
    {

//        return $request->all();

        // loop to save got employee
        $all_visitors_import = request()->csv;

//        return $all_visitors_import;

        foreach ($all_visitors_import as $index => $visitor) {

            if ($index == 0) {
                continue;
            }
            $new_visitor = new Visitor();
            $new_visitor->id = $visitor['id'];
            $new_visitor->first_name = $visitor['first_name'];
            $new_visitor->middle_name = $visitor['middle_name'] ? $visitor['middle_name'] : ' ';
            $new_visitor->last_name = $visitor['last_name'];
            $new_visitor->gender = $visitor['gender'];
            $new_visitor->phone = $visitor['phone'];
            $new_visitor->nationality_id = $visitor['nationality_id'];
            $new_visitor->document_type_id = $visitor['document_type_id'];
            $new_visitor->document_number = $visitor['document_number'];
            $new_visitor->employee_id = $visitor['employee_id'];
            $new_visitor->institution_id = $visitor['institution_id'];
            $new_visitor->visiting = $visitor['visiting'];
            $new_visitor->purpose = $visitor['purpose'];
            $new_visitor->visitor_card_id = $visitor['visitor_card_id'];
            $new_visitor->time_in = $visitor['time_in'];
            $new_visitor->time_out = $visitor['time_out'];
            $new_visitor->created_at = '2020-01-01';
            $new_visitor->updated_at = '2020-01-01';
            $new_visitor->save();

        }
        return response()->json([
            'csv-single' => $new_visitor,
            'data' => request()->all(),
            'message' => 'Add Visitor'
        ], 200);
    }


    public function show($id)
    {
        $single_visitor = Visitor::with('institution', 'document_type', 'employee', 'nationality', 'visitor_card')->get($id);
        return response()->json([
            'data' => $single_visitor,
            'message' => 'Single visitor returned'
        ], 200);
    }

    public function edit(Visitor $visitor)
    {
        //
    }

    /*public function timeOut($id) {
        $clock_out = Visitor::findOrFail($id);
        $clock_out->time_out = request('time_out');

        if ($clock_out) {
            $clock_out->load('nationality', 'document_type', 'employee', 'visitor_card', 'institution');
        }

        $clock_out->save();

        return response()->json([
            'data' => $clock_out,
            'message' => 'Clock Out'
        ], 200);
    }*/

    public function update($id)
    {
        $update_visitor = Visitor::findOrFail($id);


        /*$update_visitor->first_name = request('first_name');
        $update_visitor->middle_name = request('middle_name');
        $update_visitor->last_name = request('last_name');
        $update_visitor->gender = request('gender');
        $update_visitor->nationality_id = request('nationality_id');
        $update_visitor->phone = request('phone');
        $update_visitor->document_type_id = request('document_type_id');
        $update_visitor->document_number = request('document_number');
        $update_visitor->employee_id = request('employee_id');
        $update_visitor->institution_id = request('institution_id');
        $update_visitor->visiting = request('visiting');
        $update_visitor->purpose = request('purpose');
        $update_visitor->visitor_card_id = request('visitor_card_id');
        $update_visitor->time_in = Carbon::now()->format('H:i');

        */

        $update_visitor->time_out = Carbon::now()->format('H:i');

        $update_visitor->save();

        if ($update_visitor) {
            $update_visitor->load('nationality', 'document_type', 'employee', 'visitor_card', 'institution');
        }

        return response()->json([
            'data' => $update_visitor,
            'message' => 'Visitor Update'
        ], 200);
    }


    public function destroy(Visitor $visitor)
    {
        //
    }


    public function validateRequest()
    {
        return request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'nationality_id' => 'required',
            'phone' => 'required',
            'document_type_id' => 'required',
            'document_number' => 'required',
            'employee_id' => '',
            'institution_id' => 'required',
            'visiting' => '',
            'purpose' => 'required',
            'visitor_card_id' => 'required',
//            'time_in' => 'required',
//            'time_out' => 'required',
        ]);
    }

}
