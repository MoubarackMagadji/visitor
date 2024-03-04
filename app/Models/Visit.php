<?php

namespace App\Models;

use App\Models\User;
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

    public function getPurposeWordAttribute(){
        if($this->purpose == 1){
            return "Personal";
        }elseif($this->purpose == 2){
            return "Official";
        }else{
            return "Other";
        }
        
    }

    public function employee(){
        return $this->hasOne(Employee::class,'id','emp_id');
    }

    public function visitcloser(){
        return $this->hasOne(User::class,'id','closer');
    }

    public function visitcreator(){
        return $this->hasOne(User::class,'id','creator');
    }


}
