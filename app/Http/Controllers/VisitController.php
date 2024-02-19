<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cookie;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = request()->nb ?? Cookie::get("visitors_visits_nb") ?? 10;
        if(request()->has("nb")) {
            Cookie::queue("visitors_visits_nb", request()->nb,365);
        }

        $visits = Visit::sortable(["id"=>"desc"])->paginate($paginator);

        // $visits = Visit::all();

        return view('visits.index', 
            [
                'visits' => $visits
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::where('e_status',true)->get();
        return view('visits.add', ['employees' => $employees]);
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
            "vistorname" => 'required',
            'nbvisitors' => 'required|integer|min:1',
            "tel" => 'required|min:8|max:12',
            "emp_id" => ['required', Rule::exists('employees','id')]
        ]);

        if ($validator->fails())
        {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
        
            ), 202);
        }
        
        $visit = $request->all();
        
        Visit::create($visit);

        echo 'ok';


    }

    public function endVisit(Request $request){

        $visit = Visit::where('id',$request->visitID)->first();

        $visit->ended = true;
        $visit->save();

        echo 'ended';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function show(Visit $visit)
    {
        
        return view('visits.show',compact('visit'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function edit(Visit $visit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visit $visit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visit  $visit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visit $visit)
    {
        //
    }
}
