<?php

namespace LIBRESSLtd\LBUserManual\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LBUM_document;

class LBUM_documentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("libressltd.lbusermanual.document.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("libressltd.lbusermanual.document.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document = new LBUM_document;
        $document->fill($request->all());
        $document->save();

        return redirect(url("/lbum/document"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = LBUM_document::findOrFail($id);
        $document->generate();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = Push_application::findOrFail($id);
        return view("vendor.LBPushCenter.application.add", ["application" => $application]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $app = Push_application::findOrFail($id);
        $app->name = $request->name;
        $app->type_id = $request->type_id;
        $app->server_key = $request->server_key;
        $app->server_secret = $request->server_secret;
        $app->pem_password = $request->pem_password;

        if ($request->file("pem_file"))
        {
            $app->pem_file_id = Media::saveFile($request->file("pem_file"))->id;
        }

        $app->save();

        return redirect()->back();
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
