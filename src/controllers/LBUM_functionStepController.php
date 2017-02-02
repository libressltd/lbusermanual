<?php

namespace LIBRESSLtd\LBUserManual\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LBUM_document;
use App\Models\LBUM_function;
use App\Models\LBUM_function_step;
use App\Models\Media;

class LBUM_functionStepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($function_id)
    {
        $function = LBUM_function::findOrFail($function_id);
        return view("libressltd.lbusermanual.document.function.step.index", ["function" => $function]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($function_id)
    {
        $function = LBUM_function::findOrFail($function_id);
        return view("libressltd.lbusermanual.document.function.step.add", ["function" => $function]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $function_id)
    {
        $function = LBUM_function::findOrFail($function_id);
        $step = new LBUM_function_step;
        $step->fill($request->all());
        $step->function_id = $function_id;

        if ($request->hasFile("image_en"))
        {
            $media = Media::saveFile($request->image_en);
            $step->image_en_id = $media->id;
        }
        if ($request->hasFile("image_vi"))
        {
            $media = Media::saveFile($request->image_vi);
            $step->image_vi_id = $media->id;
        }

        $step->save();

        return redirect("/lbum/function/$function_id/step");
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
    public function edit($function_id, $id)
    {
        $function = LBUM_function::findOrFail($function_id);
        $step = LBUM_function_step::findOrFail($id);
        return view("libressltd.lbusermanual.document.function.step.add", ["function" => $function, "step" => $step]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $function_id, $id)
    {
        $function = LBUM_function::findOrFail($function_id);
        $step = LBUM_function_step::findOrFail($id);
        $step->fill($request->all());
        $step->function_id = $function_id;

        if ($request->hasFile("image_en"))
        {
            $media = Media::saveFile($request->image_en);
            $step->image_en_id = $media->id;
        }
        if ($request->hasFile("image_vi"))
        {
            $media = Media::saveFile($request->image_vi);
            $step->image_vi_id = $media->id;
        }
        
        $step->save();

        return redirect("/lbum/function/$function_id/step");
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
