<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Image;
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
}
