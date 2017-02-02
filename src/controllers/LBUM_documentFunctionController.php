<?php

namespace LIBRESSLtd\LBUserManual\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LBUM_document;
use App\Models\LBUM_function;

class LBUM_documentFunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($document_id)
    {
        $document = LBUM_document::findOrFail($document_id);
        return view("libressltd.lbusermanual.document.function.index", ["document" => $document]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($document_id)
    {
        $document = LBUM_document::findOrFail($document_id);
        return view("libressltd.lbusermanual.document.function.add", ["document" => $document]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $document_id)
    {
        $document = LBUM_document::findOrFail($document_id);
        $function = new LBUM_function;
        $function->fill($request->all());
        $function->document_id = $document_id;
        $function->save();

        return redirect("/lbum/document/$document_id/function");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($document_id, $id)
    {
        $document = LBUM_document::findOrFail($document_id);
        $function = LBUM_function::findOrFail($id);
        return view("libressltd.lbusermanual.document.function.add", ["document" => $document, "function" => $function]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $document_id, $id)
    {
        $document = LBUM_document::findOrFail($document_id);
        $function = LBUM_function::findOrFail($id);
        $function->fill($request->all());
        $function->document_id = $document_id;
        $function->save();

        return redirect("/lbum/document/$document_id/function");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
