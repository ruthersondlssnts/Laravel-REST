<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'ascendants',
        'selectable'
    ];
    public function employees()
    {
        return $this->hasMany('App\Models\Employee', "department_id");
    }
}
