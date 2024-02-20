<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

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
        
        
        $image = base64_decode($request->image);
        $imageName = uniqid(basename('aabb')).'.jpg';
        
        // file_put_contents('../../uploads/'.$imageName, $data);
        Storage::put('public/media/'.$imageName, $image);
        
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
        
        // $visit = $validator->all();
        $data = [
            'vistorname' => $request->vistorname,
            'nbvisitors' => $request->nbvisitors,
            'tel' => $request->tel,
            'emp_id' => $request->emp_id,
            'picture' => $imageName,
            'additionalnote' => $request->additionalnote,
            'closer' => 0,
            'creator' => auth()->user()->id
        ];
        // $validator['picture'] = $imageName;
        
        Visit::create($data);

        echo 'ok';


    }

    public function endVisit(Request $request){

        $visit = Visit::where('id',$request->visitID)->first();

        $visit->closer = auth()->user()->id;
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
