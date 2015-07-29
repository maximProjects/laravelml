<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Facade;
use App\Label;
use App\LabelsTranslation;
use Request;
use App\Language;

class TrlHelper extends Facade
{

    private static $_instance = false;

    protected static function getFacadeAccessor() { return 'TrlHelper'; }

    public static function t(){
        if(!self::$_instance){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        $prefix = Request::segment(1);
        $langObj = Language::where('prefix', $prefix)->first();
        $this->_langObj = $langObj;
    }

    function __clone(){}

    public function getLabel($label=null)
    {
        $labelObj = Label::where('name', $label)->first();
        if ($labelObj) {
            $trlObj = LabelsTranslation::where('label_id', $labelObj->id)->where('lang_id', $this->_langObj->id)->first();
            if (!empty($trlObj->text)) {
                return $trlObj->text;
            } else {
                return "*".$label;
            }
        }else {
            return "!".$label;
        }
    }
}