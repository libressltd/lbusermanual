<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LIBRESSLtd\LBForm\Traits\LBDatatableTrait;
use Alsofronie\Uuid\Uuid32ModelTrait;
use App\Models\LBUM_document;
use Auth;
use Form;
use App;

class LBUM_function_step extends Model
{
    use LBDatatableTrait, Uuid32ModelTrait;
    protected $table = "LBUM_function_steps";
    protected $fillable = ["name_en", "name_vi", "note_en", "note_vi", "order_number"];
    protected $appends = ["edit_button"];

    public function getEditButtonAttribute()
    {
        return Form::lbButton("/lbum/function/$this->function_id/step/$this->id/edit", "GET", "Edit", ["class" => "btn btn-xs btn-primary"])->toHtml();
    }

    public function getNameAttribute()
    {
        $name_key = "name_".\App::getLocale();
        return $this->$name_key;
    }

    public function getNoteAttribute()
    {
        $name_key = "note_".\App::getLocale();
        return $this->$name_key;
    }

    public function image()
    {
        return $this->belongsTo("App\Models\Media", "image_".\App::getLocale()."_id");
    }

    static public function boot()
    {
        LBUM_function_step::bootUuid32ModelTrait();
        LBUM_function_step::saving(function ($area) {
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
