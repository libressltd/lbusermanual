<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LIBRESSLtd\LBForm\Traits\LBDatatableTrait;
use Alsofronie\Uuid\Uuid32ModelTrait;
use App\Models\LBUM_document;
use Auth;
use Form;
use App;

class LBUM_function extends Model
{
    use LBDatatableTrait, Uuid32ModelTrait;
    protected $table = "LBUM_functions";

    protected $fillable = ["name_en", "name_vi", "description_en", "description_vi", "parent_id", "order_number"];
    protected $appends = ["edit_button", "step_button"];

    public function getEditButtonAttribute()
    {
        return Form::lbButton("/lbum/document/$this->document_id/function/$this->id/edit", "GET", "Edit", ["class" => "btn btn-xs btn-primary"])->toHtml();
    }

    public function getStepButtonAttribute()
    {
        return Form::lbButton("/lbum/function/$this->id/step", "GET", "Step", ["class" => "btn btn-xs btn-info"])->toHtml();
    }

    public function document()
    {
        return $this->belongsTo("App\Models\LBUM_document", "document_id");
    }

    public function children()
    {
        return $this->hasMany("App\Models\LBUM_function", "parent_id")->orderBy("order_number");
    }

    public function steps()
    {
        return $this->hasMany("App\Models\LBUM_function_step", "function_id")->orderBy("order_number");
    }

    public function getNameAttribute()
    {
        $name_key = "name_".\App::getLocale();
        return $this->$name_key;
    }

    public function getDescriptionAttribute()
    {
        $name_key = "description_".\App::getLocale();
        return $this->$name_key;
    }

    static public function boot()
    {
        LBUM_function::bootUuid32ModelTrait();
        LBUM_function::saving(function ($area) {
            if (Auth::user())
            {
                if ($area->id)
                {
                    $area->updated_by = Auth::user()->id;
                }
                else
                {
                    $area->created_by = Auth::user()->id;
                }
            }
        });
    }
}
