<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Image;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function post(){
        return view('post.index');
    }

    public function save(Request $request){
        if($request->hasfile('image'))
     {
          $image=$request->file('image');
        $file_name=time().'.'.$image->getClientOriginalExtension();
    $image_resize = Image::make($image->getRealPath());   
    $image_resize->resize( 1280,1400);
        $image_resize->insert(public_path('i.jpg'), 'bottom-right', 10, 10);

        $image_resize->save('images/post_images/'.$file_name);
        $data=new Post;
        $data->image=$file_name;
        $data->image_name=$request->image_name;      
        $data->save();
        return redirect()->back()->with('success','Post Add Successfully');


     }
    }

}