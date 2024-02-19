<?php

namespace App\Models;

use App\Models\Employee;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visit extends Model
{
    use HasFactory;
    use Sortable;

    protected $guarded = [];

    protected $sortable = ['id', 'vistorname', 'nbvisitors', 'ended', 'created_at'];

    public function employee(){
        return $this->hasOne(Employee::class,'id','emp_id');
    }
}
