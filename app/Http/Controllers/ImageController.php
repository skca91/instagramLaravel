<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use App\Models\Like;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        return view('image.create');
    }

    public function save(Request $request){

        $validate = $this->validate($request, [
            'image_path' => 'required|image',
            'description' => 'required',
        ]);

        $image_path = $request->file('image_path');
        $description = $request->input('description');

        $user = Auth::user();
        $image = new Image();
        $image->description = $description;
        $image->user_id = $user->id;

        if($image_path){

            $image_path_name = time().$image_path->getClientOriginalName();

            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }

        $image->save();

        return redirect()->route('dashboard')
                         ->with(['message' => 'Upload photo successfully']);
    }

    public function getImage($filename){

        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);

    }

    public function detail($id){

        $image = Image::find($id);

        return view('image.detail', [
            'image' => $image
        ]);
    }

    public function delete($id){

        $user = Auth::user();

        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if($user && $image && $image->user->id == $user->id){

            if($comments && count($comments) > 0){
                foreach($comments as $comment){
                    $comment->delete();
                }
            }

            if($likes && count($likes) > 0){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            Storage::disk('images')->delete($image->image_path);
            $image->delete();

            $message = array('message' => 'the photo has been deleted');

        }else{
            $message = array('message' => 'the photo has not been deleted');
        }

        return redirect()->route('dashboard')->with($message);
    }

    public function edit($id){

        $user = Auth::user();
        $image = Image::find($id);

        if($user && $image && $image->user->id == $user->id){

            return view('image.edit', ['image' => $image]);

        }else{

            return redirect()->route('dashboard');
        }

    }

    public function update(){


    }
}
