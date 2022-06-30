<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\events;
use Illuminate\Support\Facades\DB;

class eventController extends Controller
{
    public function index(){
        return view('home');
    }
    public function create(){
        return view('/createEvent');
    }
    public function insert(Request $request){
        $request->validate(
            [
                'title'=>'required',
                'description'=>'required',
                'start_date'=>'required',
                'end_date'=>'required'
            ]
        );
        $events = new events;
        $events->title = $request['title'];
        $events->description = $request['description'];
        $events->start_date = $request['start_date'];
        $events->end_date = $request['end_date'];
        $events->save();
        session()->flash('success','Event has been created successfully! Please, click go back button to view the event.');
        return view('/createEvent');
    }
    
    public function view(Request $request){
        $query = events::query();
        if($request->ajax()){
            $value = $request->filter;
            if($value == 1){
                $date = \Carbon\Carbon::today();
                $query = DB::table('events')->select('id','title','description','start_date','end_date')->where('start_date', '<', $date)->get();
                return response()->json(['filter'=>$query]);
            }
            elseif($value==2){
                $date = \Carbon\Carbon::today();
                $query = DB::table('events')->select('id','title','description','start_date','end_date')->where('start_date', '>', $date)->get();
                return response()->json(['filter'=>$query]);
            }
            elseif($value==3){
                $date1 = \Carbon\Carbon::today();
                $date2 = \Carbon\Carbon::today()->addDays(7);
                $query = DB::table('events')->select('id','title','description','start_date','end_date')->where('start_date', '>', $date1)->where('end_date','<',$date2)->get();
                return response()->json(['filter'=>$query]);
            }
            else{
                $date1 = \Carbon\Carbon::today()->subDays(7);
                $date2 = \Carbon\Carbon::today();
                $query = DB::table('events')->select('id','title','description','start_date','end_date')->where('start_date', '>', $date1)->where('end_date','<',$date2)->get();
                return response()->json(['filter'=>$query]);
            }   
        }
            $events = $query->get();
            $data = compact('events');
            return view('viewEvent')->with($data);    
    }
    public function filter(Request $request){

    }
    public function edit($id){
        $events = events::find($id);
        if(is_null($events)){
            //no data found
        }
        else{
            $data = compact('events');
            return view('editEvent')->with($data);
        } 
    }
    public function update($id, Request $request){
        $events = events::find($id);
        $events->title = $request['title'];
        $events->description = $request['description'];
        $events->start_date = $request['start_date'];
        $events->end_date = $request['end_date'];
        $events->save();
         session()->flash('updated','Event has been updated successfully!');
        return redirect('viewEvent');
    }
    public function delete(Request $request){
        $id = $request->deleteId;
        print_r($id);
        $events = events::find($id)->delete($id);
        return redirect()->back();
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
}
