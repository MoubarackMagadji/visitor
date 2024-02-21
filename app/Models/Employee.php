<?php

namespace App\Models;

use App\Models\Dept;
use App\Models\Visit;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    use Sortable;

    protected $guarded = [];

    protected $sortable = ['id', 'firstname', 'doj', 'e_status','created_at'];

    protected $casts = [
        'doj' => 'datetime',
    ];

    public function getFullnameAttribute(){
        return $this->firstname." ".$this->lastname;
    }
    
    public function getStatusAttribute(){
        return $this->e_status ? "Active":"Inactive";
    }
    
    public function dept(){
        return $this->belongsTo(Dept::class);
    }

    public function visits(){
        return $this->hasMany(Visit::class, 'emp_id', 'id');
    }

}
