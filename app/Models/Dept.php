<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dept extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable = ['name'];

    protected $sortable = ['id','name','d_status','created_at'];
    public $sortableAs = ['employees_count'];

    public function getStatusAttribute(){
        return $this->d_status ? "Active" : "Inactive";
    }

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
