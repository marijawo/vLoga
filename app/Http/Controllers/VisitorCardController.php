<?php

namespace App\Http\Controllers;

use App\VisitorCard;
use Illuminate\Http\Request;

class
VisitorCardController extends Controller
{

    public function index()
    {
        $visitor_cards = VisitorCard::latest()->get();
        return response()->json([
            'data' => $visitor_cards,
            'message' => 'List of VisitorCards'
        ], 200);
    }


    public function store(Request $request)
    {
        $new_visitor_card = VisitorCard::create($this->validateRequest());
        return response()->json([
            'data' => $new_visitor_card,
            'message' => 'Create success'
        ], 200);

    }


    public function show($id)
    {
        $single_visitor_card = VisitorCard::findOrFail($id);
        return response()->json([
            'data' => $single_visitor_card,
            'message' => 'Show single object'
        ]);
    }


    public function update($id)
    {
        $update_visitor_card = VisitorCard::findOrFail($id);
        $update_visitor_card->name = request()->name;
        $update_visitor_card->save();
        return response()->json([
            'data' => $update_visitor_card,
            'message' => 'Update success'
        ], 200);
    }


    public function destroy($id)
    {
        $delete_visitor_card = VisitorCard::findOrFail($id);
        $delete_visitor_card->delete();
        return response()->json([
            'data' => $delete_visitor_card,
            'message' => 'Delete success'
        ]);
    }


    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required',
        ]);
    }
}
