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
    public $prefix="en";

    private static $_instance = false;

    protected static function getFacadeAccessor() { return 'TrlHelper'; }

    public static function t($prefix='en'){
        if(!self::$_instance){
            self::$_instance = new self($prefix);
        }
        return self::$_instance;
    }

    public function __construct($prefix) {
        /*
         * get current language object
         */
        //$prefix = Request::segment(1);
        $this->prefix = $prefix;
        $langObj = Language::where('prefix', $this->prefix)->first();
        $this->_langObj = $langObj;
    }

    function __clone(){}

    public function curLang()
    {
        /*
         * returns current lang object
         */
        $langObj = Language::where('prefix', $this->prefix)->first();
        return $langObj;
    }

    public function url($path)
    {
        /*
         * format link url with lang prefix
         */
        $pathTrl = "/".$this->prefix.$path;
        return $pathTrl;
    }

    public function redirect($path)
    {
        /*
         * redirecting to url with lang prefix
         */
        $pathTrl = $this->prefix.'/'.$path;
        return redirect($pathTrl);
    }
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

    public function getLangArr()
    {
        /*
         * returns all lang arrray
         */
        $langs = Language::all();
        return $langs;
    }

    public function getPrefix() {
        return $this->prefix;
    }
}