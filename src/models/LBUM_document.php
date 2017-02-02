<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use LIBRESSLtd\LBForm\Traits\LBDatatableTrait;
use Alsofronie\Uuid\Uuid32ModelTrait;
use Auth;
use Form;
use App;

class LBUM_document extends Model
{
    use LBDatatableTrait, Uuid32ModelTrait;
    protected $table = "LBUM_documents";

    protected $fillable = ["name_en", "name_vi"];
    protected $appends = ["generate_button", "function_button"];

    public $phpWord;

    public function generate($locale = "vi")
    {
        App::setLocale("vi");
        $this->phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord = $this->phpWord;
        $this->formatTitle();
        $this->addTOC();

        foreach  ($this->functions()->whereNull("parent_id")->get() as $f)
        {
            $section = $phpWord->createSection();
            $this->print_function($f, $section, 1);
        }

        $this->download("HelloWorld.docx");
    }

    public function addTOC()
    {
        $phpWord = $this->phpWord;
        $section = $phpWord->createSection();
        $section->addTOC();
    }

    public function formatTitle()
    {
        $phpWord = $this->phpWord;
        $phpWord->addNumberingStyle(
            'hNum',
            array('type' => 'multilevel', 'levels' => array(
                array('pStyle' => 'Heading1', 'format' => 'upperLetter', 'text' => '%1.'),
                array('pStyle' => 'Heading2', 'format' => 'upperRoman', 'text' => '%2.'),
                array('pStyle' => 'Heading3', 'format' => 'decimal', 'text' => '%3.'),
                )
            )
        );
        $phpWord->addTitleStyle(1, array('name' => 'Calibri', 'size' => 14, 'bold' => true, 'color' => '0B5294'), array('numStyle' => 'hNum', 'numLevel' => 0));
        $phpWord->addTitleStyle(2, array('name' => 'Calibri', 'size' => 13, 'bold' => true, 'color' => '0F6FC6'), array('numStyle' => 'hNum', 'numLevel' => 1));
        $phpWord->addTitleStyle(3, array('name' => 'Tohoma', 'size' => 12, 'color' => '073662'), array('numStyle' => 'hNum', 'numLevel' => 2));

        $phpWord->setDefaultFontName('Tahoma');
        $phpWord->setDefaultFontSize(12);
    }

    public function print_function($function, $section, $index)
    {
        $phpWord = $this->phpWord;
        $section->addTitle($function->name, $index);
        if (strlen($function->description) > 0)
        {
            $section->addText($function->description);
        }

        foreach ($function->steps as $step)
        {
            $section->addListItem($step->name, 0);
            if (strlen($step->note) > 0)
            {
                $section->addText($step->note);
            }
            if ($step->image)
            {
                $section->addImage($step->image->path(), ["width" => 400, "wrappingStyle" =>"square"]);
            }
        }

        foreach ($function->children as $f)
        {
            $this->print_function($f, $section, $index + 1);
        }
    }

    public function download($filename)
    {
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($this->phpWord, 'Word2007');
        $xmlWriter->save("php://output");
    }
    
    public function getGenerateButtonAttribute()
    {
        return Form::lbButton("/lbum/document/$this->id", "GET", "Generate", ["class" => "btn btn-xs btn-info"])->toHtml();
    }
    
    public function getFunctionButtonAttribute()
    {
        return Form::lbButton("/lbum/document/$this->id/function", "GET", "Function", ["class" => "btn btn-xs btn-info"])->toHtml();
    }

    public function functions()
    {
        return $this->hasMany("App\Models\LBUM_function", "document_id")->orderBy("order_number");
    }

    public function getNameAttribute()
    {
        $name_key = "name_".\App::getLocale();
        return $this->$name_key;
    }

    static public function boot()
    {
        LBUM_document::bootUuid32ModelTrait();
        LBUM_document::saving(function ($area) {
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
