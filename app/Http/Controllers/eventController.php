<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\events;
use Illuminate\Support\Facades\DB;

class eventController extends Controller
{
//Controller for index/home page.
    public function index(){
        return view('home');
    }

// Controller for crete event page.
    public function create(){
        return view('/createEvent');
    }

//Controller for inserting events.
    public function insert(Request $request){
        $date = \Carbon\Carbon::today();
        $request->validate(
            [
                'title'=>'required|string',
                'description'=>'required|string',
                'start_date'=>'required|date|after_or_equal:'.$date,
                'end_date'=>'required|after_or_equal:start_date'
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

/*Controller for viewing the events either by ascending order as per start_date or by filtering the date*/
    public function view(Request $request){
        $query = events::query();
        if($request->ajax()){
            $value = $request->filter;

//short by finished events.
            if($value == 1){
                $date = \Carbon\Carbon::today();
                $query = DB::table('events')->select('id','title','description','start_date','end_date')->where('start_date', '<', $date)->get();
                return response()->json(['filter'=>$query]);
            }

//sort by upcomming events.
            elseif($value==2){
                $date = \Carbon\Carbon::today();
                $query = DB::table('events')->select('id','title','description','start_date','end_date')->where('start_date', '>', $date)->get();
                return response()->json(['filter'=>$query]);
            }

//sort by upcomming event with in 7 days.
            elseif($value==3){
                $date1 = \Carbon\Carbon::today();
                $date2 = \Carbon\Carbon::today()->addDays(7);
                $query = DB::table('events')->select('id','title','description','start_date','end_date')->where('start_date', '>', $date1)->where('end_date','<',$date2)->get();
                return response()->json(['filter'=>$query]);
            }

//sorting by finished events of last 7 days.
            elseif($value==4){
                $date1 = \Carbon\Carbon::today()->subDays(7);
                $date2 = \Carbon\Carbon::today();
                $query = DB::table('events')->select('id','title','description','start_date','end_date')->where('start_date', '>', $date1)->where('end_date','<',$date2)->get();
                return response()->json(['filter'=>$query]);
            }
//filter
            else{
                $query = DB::table('events')->get();
                return response()->json(['filter'=>$query]);
            }   
        }
            $events = $query->get();
            $data = compact('events');
            return view('viewEvent')->with($data);    
    }

//Controller for edit event page.
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

//controller for updating event.
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

// Controller for deleting event.
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
