<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Http\Requests\StoreBlogPost;
use App\Post;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Use : Return postForm view
     */
    public function viewPost(){
        return view('postForm');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Use : This function used to save post data
     */
    public function SavePost(StoreBlogPost  $request){
        // custom validator using Request class
        //$validator = $request->validated();
        $validator = Validator::make($request->all(), [
            'key_name' => 'required|string',
            'key_value' => 'required|string',
            'user_id' => 'required',
        ],[
            'key_name.required' => 'key_name field fill up compulsory',
            'key_value.required' => 'key_value field fill up compulsory'
        ]);

        if($validator->fails()){
            return response()->json($validator->messages());
        } else {
            //$post = Post::create($request->all());
            $post = new Post();
            $post->key_name = $request->get('key_name');
            $post->key_value = $request->get('key_value');
            $post->user_id = $request->get('user_id');

            if($post->save()){
                $success['message'] = "Post added successfully..";
            }
            else {
                $success['message'] = "Sorry! Post is not successfully.";
            }
            return response()->json($success);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Use : This function used to get user detail
     */
    public function getUser(Request $request){
        //return response()->json(Post::where('key_value', '=', 'check')->searchable());
        return response()->json(Post::search('check')->get());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Use : used to stored agent data
     */
    public function addAgent(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'address' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json($validator->messages());
        } else {
            $data = Agent::addAgent($request->all());
            if($data){
                return response()->json(array('message' => "Agent data save successfully."));
            } else {
                return response()->json(array('message' => "Failed! something issue raised."));
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Use : used to stored user data
     */
    public function addUser(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'address' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->messages());
        } else {
            $data = User::addUser($request->all());
            if($data){
                return response()->json(array('message' => "User data save successfully."));
            } else {
                return response()->json(array('message' => "Failed! something issue raised."));
            }
        }
    }
}
