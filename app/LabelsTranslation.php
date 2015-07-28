<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabelsTranslation extends Model
{
    protected $table = 'labels_translations';
    protected $fillable = ['name'];
    public $timestamps = false;
}
