<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ascendants',
        'selectable',
        'id'
    ];
    protected $primaryKey ='id';
    public $incrementing=false;
    protected $keyType='string';
    public function employees()
    {
        return $this->hasMany('App\Models\Employee', "department_id");
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model)
        {
           if(empty($model->id)){
                $model->id=Str::uuid();
           }
        });
    }
}
