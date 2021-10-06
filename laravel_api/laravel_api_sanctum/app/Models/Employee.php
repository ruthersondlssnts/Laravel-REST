<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'contact',
        'department_id',
        'user_id'
    ];
    public function department()
    {
        return $this->belongsTo(Unit::class, 'department_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
}
