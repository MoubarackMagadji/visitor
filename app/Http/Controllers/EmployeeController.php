<?php

namespace App\Http\Controllers;

use App\Models\Dept;
use App\Models\Visit;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cookie;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = request()->nb ?? Cookie::get("visitors_employees_nb") ?? 10;
        if(request()->has("nb")) {
            Cookie::queue("visitors_employees_nb", request()->nb,365);
        }

        $employees = Employee::sortable(["id"=>"desc"])->paginate($paginator);

        $depts = Dept::where('d_status',true)->orderBy('name','asc')->get();


        return view('employees.index')->with(['depts'=>$depts, 'employees'=>$employees]);
    }

    public function visits(Employee $employee){

        
        // dd($employee->visits);

        $paginator = request()->nb ?? Cookie::get("visitors_visitsemp_nb") ?? 10;
        if(request()->has("nb")) {
            Cookie::queue("visitors_visitsemp_nb", request()->nb,365);
        }

        $visits = Visit::where('emp_id',$employee->id)->sortable(["id"=>"desc"])->paginate($paginator);
        // $visits = $employee->visits;
        // dd($visits->total());

        return view('employees.visits', compact('visits', 'employee'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'emp_id' => ['required', Rule::unique("employees", "emp_id")],
            'firstname' => "required",
            "lastname" => 'required',
            "dept_id" => ['required', Rule::exists('depts',"id")],
        ]);

        
        
        if ($validator->fails())
        {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
        
            ), 202);
        }
        
        $employee = $request->all();
        
        Employee::create($employee);

        echo 'ok';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        
        return view('employees.show')->with(['employee'=>$employee]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $depts = Dept::where('d_status',true)->orderBy('name','asc')->get();
        return view('employees.edit', compact('depts', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        // dd($request->all());
        $validator = $request->validate([
            'firstname' => 'required',
            'lastname' =>'required',
            'doj' => 'nullable',
            'e_status' => 'required',
            'dept_id' => [Rule::exists('depts','id')]
        ]);

        $employee->update($validator);

        return redirect( route('employee.show', $employee->id))->with('success', 'Employee edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
