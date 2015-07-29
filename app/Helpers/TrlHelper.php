<?php
/**
 * TrlHelper contains translate multilang methods
 */
namespace App\Helpers;

use Illuminate\Support\Facades\Facade;
use Request;
use App\Label;
use App\LabelsTranslation;
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
        /*
         * get current language object
         */
        $prefix = Request::segment(1);
        $langObj = Language::where('prefix', $prefix)->first();
        $this->_langObj = $langObj;
    }

    function __clone(){}

    public function getLabel($label=null)
    {
        /*
         * returns translated value
         */
        $labelObj = Label::where('name', $label)->first();
        if ($labelObj) {
            // if label exist get translation
            $trlObj = LabelsTranslation::where('label_id', $labelObj->id)->where('lang_id', $this->_langObj->id)->first();
            if (!empty($trlObj->text)) {
                // if translated return translation
                return $trlObj->text;
            } else {
                // if translation empty return label name with *
                return "*".$label;
            }
        }else {
            // if label no exist return label name with !
            return "!".$label;
        }
    }
}