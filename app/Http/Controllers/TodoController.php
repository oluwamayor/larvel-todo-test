<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // create the store method 

    public function store (Request $request){
    
        // data validation
        $data = $request->validate([
            'title' => 'required|string|max:255',

            'priority' => 'nullable|integer|min:1|max:3',
            
            'done'=>'boolean',

        ]);
        $todo = Todo::create($data);

        return response()-> json([
            'status'=> true,
            'message' => 'Todo created.',
            'data' => $todo,
         ],201);
        // return the json response 
        }
        // get all our todo task list

        public function index (){
            $todos = Todo::all();
            return response()-> json([
                'status'=> true,
                'message' => 'Todo Task retrieved.',
                'data' => $todos,
             ],201);

        }

        // get a single todo task list
        public function show ($id){
            $todo = Todo::find($id);
            if($todo){
                return response()-> json([
                    'status'=> true,
                    'message' => 'Single Todo Task retrieved.',
                    'data' => $todo,
                 ],201);
            }
            else{
                return response()-> json([
                    'status'=> true,
                    'message' => 'Todo task not found',
                    'data' => null,
                 ],404);
            }
          
        }

        // update single todo task list
        public function update(Request $request, $id){
            $data = $request->validate([
                'title' => 'nullable|string|max:255',
    
                'priority' => 'nullable|integer|min:1|max:3',
                
                'done'=>'boolean',
    
            ]);
            $todo = Todo::find($id);
            if($todo){
                $todo->update($data);
                return response()-> json([
                    'status'=> true,
                    'message' => 'Todo task found',
                    'data' => $todo,
                 ]);
            }
            else{
                return response()-> json([
                    'status'=> false,
                    'message' => 'Todo task not found',
                    'data' => $todo,
                 ],404);
            }
          
        }

        public function delete($id){
          
            $todo = Todo::find($id);
            if($todo){
                $todo->delete();
                return response()-> json([
                    'status'=> true,
                    'message' => 'Todo task deleted',
                    'data' => null,
                 ]);
            }
            else{
                return response()-> json([
                    'status'=> false,
                    'message' => 'Todo task not found',
                    'data' => $todo,
                 ],404);
            }
          
        }
     
    }


