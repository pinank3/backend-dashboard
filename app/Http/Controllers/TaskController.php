<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;
use App;
use DB;
use App\Http\Controllers\Controller;
use Config;
use Auth;
use Carbon\Carbon;
use Session;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class);
    }
    /**
     * Display a indexing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tasks = Task::where('is_deleted','=','0')->orderBy('updated_at','asc')->get(['id','task','updated_at','is_deleted']);        
        return view('tasks.index',compact('tasks'));
    }

    public function addTask(){
        return view('tasks.create_task');
    }
    public function postTask(Request $request){
        $validateData = $request->validate([
            'task'  => 'required',
        ]);
        $user_id = Auth::user()->id;
      
            
        try{
            DB::beginTransaction();
            $task = new Task();
            $task->task                           = $request->task;
            $task->created_by                     = $user_id;
            $task->updated_by                     = $user_id;
            $task->created_at                     = Carbon::now();
            $task->updated_at                     = Carbon::now();
           
            DB::commit();

            Session::flash('success','Task Added Successfully');
            return Redirect::route('task-list');
        }catch(\Exception $e){
            DB::rollback();
            Session::flash('error', 'Error while saving Task. '.$e->getMessage());
            return Redirect::route('task-list');
            }     
    }
    public function editTask($id){
        $task_id = base64_decode($id);
        $taskDetails = Task::where('id',$task_id)->first();
        return view('tasks.edit_task',compact('taskDetails'));
    }
    public function updateTask($id,Request $request){  
        $validateData = $request->validate([
            'task'  => 'required',
        ]);

        $task_id = base64_decode($id);

        $user_id = Auth::user()->id;
        try{
            DB::beginTransaction();
            $task = Task::where('id',$task_id)->first();
            $task->task                   = $request->task;
            $task->updated_by             = $user_id;
            $task->updated_at             = Carbon::now();
        
            DB::commit();

            Session::flash('success','Task Added Successfully');
            return Redirect::route('task-list');
        }catch(\Exception $e){
            DB::rollback();
            Session::flash('error', 'Error while saving Task. '.$e->getMessage());
            return Redirect::route('task-list');
            }
    }
    public function deletetask($id){
        $task_id    = base64_decode($id);
        $user_id     = Auth::user()->id;
        try {
            DB::beginTransaction();
            $task = Task::where('id', $task_id)->first();
            $task->is_deleted   = 1;
            $task->updated_by   = $user_id;
            $task->updated_at   = Carbon::now();

            if (!$task->save()) {
                throw new \Exception('Unable delete Task');
            }
            DB::commit();

            Session::flash('success', 'Task Deleted Successfully');
            return Redirect::route('task-list');
        } catch (\Exception $e) {
            DB::rollback();
  
            Session::flash('error', 'Error while deleting Task. '.$e->getMessage());
            return Redirect::route('task-list');
        }
   
    }

    public function roles()
    {
        return response()->json(Role::get());
    }
}
