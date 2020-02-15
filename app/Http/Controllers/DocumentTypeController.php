<?php

namespace App\Http\Controllers;

use App\DocumentType;
use Illuminate\Http\Request;

class DocumentTypeController extends Controller
{

    public function index()
    {
        $all_document_types = DocumentType::all();
        return response()->json([
            'data' => $all_document_types,
            'message' => 'Document Types'
        ], 200);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $new_document_type = DocumentType::create($this->validateRequest());
        return response()->json([
            'data' => $new_document_type,
            'message' => 'Add Document Type'
        ], 200);
    }


    public function show($id)
    {
        $single_document_type = DocumentType::findOrFail($id);
        return response()->json([
            'data' => $single_document_type,
            'message' => 'Get Single document type'
        ], 200);
    }


    public function edit(DocumentType $documentType)
    {
        //
    }


    public function update($id)
    {
        $update_document_type = DocumentType::findOrFail($id);
        $update_document_type->name = request()->name;
        $update_document_type->save();
        return response()->json([
            'data' => $update_document_type,
            'message' => 'Update document type'
        ], 200);
    }


    public function destroy($id)
    {
        $delete_document_type = DocumentType::findOrFail($id);
        $delete_document_type->delete();
        return response()->json([
            'data' => $delete_document_type,
            'message' => 'Delete success'
        ], 200);
    }

    public function validateRequest()
    {
        return request()->validate([
            'name' => 'required'
        ]);
    }
}
