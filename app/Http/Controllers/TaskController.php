<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Input;
use DB;
use Session;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Hash;

class TaskController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    	
        $tasks = Task::orderby('id', 'desc')->get();

        return view( 'index' )->with( 'tasks', $tasks );

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view( 'create' );
    }
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {

        $messages = [
                'title.required'   => 'Type task title.',
                'description.required'   => 'Task details.',
            ];

        $rules = [
            'title'         => 'required',
            'description'   => 'required',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails() ) {

            return Redirect::back()->withErrors($validator);

        } 
        
        $user = new Task;
        $user->title     = $request->get('title');
        $user->description  = $request->get('description');
        
        if($user->save()) {

            Session::put('valid', true);
            Session::flash('message', 'Successfully created hack user!');
        
        } else {
            Session::put('invalid', true);
            Session::flash('message', 'Sorry! we cannot create hack user.');
        }

        return Redirect::to('/task');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view( 'edit', [
                'task' => Task::find($id)
            ] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'title.required'        => 'Type task title.',
            'description.required'  => 'Task details.',
        ];

        $rules = [
            'title'       => 'required',
            'description' => 'required',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails() ) {

            return Redirect::back()->withErrors($validator);

        } 

        Task::where('id', $id)
                ->update( [
                        'title' => $request->get('title'),
                        'description' => $request->get('description'),
                    ]);

        return Redirect::to('/task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
        return back();  
    }
}
