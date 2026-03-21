<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    //this will return index
    public function index(){

    $blogs=Blog::orderBy('created_at','DESC');

    if(!empty($request->keyword)){
        $blogs=$blogs->where('title','like','%' .$request->keyword.'%');
    }

      $blogs=$blogs->get();

        return response()->json([
            'status'=>true,
            'data'=>$blogs
        ]);
    }

    //this will return a single blog
    public function show($id){
        $blog=Blog::find($id);

        if($blog==null){
              return response()->json([
                'status'=>false,
                'message'=>'Blog not found',
            ]);
        }

        $blog['date']=\Carbon\Carbon::parse($blog->created_at)->format('d M,Y');

            return response()->json([
                'status'=>true,
                'data'=>$blog,
            ]);

    }

    //This will store blog
    public function store(Request $request){
       $validator= Validator::make($request->all(),[
            'title'=>'required | min:10',
            'author'=>'required | min:3',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'please fix the errors',
                'errors'=>$validator->errors()
            ]);
        }

        $blog=new Blog();
        $blog->title=$request->title;
        $blog->author=$request->author;
        $blog->description=$request->description;
        $blog->shortDesc=$request->shortDesc;
        $blog->save();

        //save image here
        $tempImage=TempImage::find($request->image_id);

        if($tempImage!=null){
            $imageExtArray=explode('.',$tempImage->name);
            $ext=last($imageExtArray);
            $imageName=time().'-'.$blog->id.'.'.$ext;

            $blog->image=$imageName;
            $blog->save();

            $sourcePath=public_path('uploads/temp/'.$tempImage->name);
            $desPath=public_path('uploads/blogs/'.$imageName);

            File::copy($sourcePath,$desPath);
        }

          return response()->json([
                'status'=>true,
                'message'=>'Blog added successfully.',
                'data'=>$blog
            ]);

    }

    //This will update a blog
    public function update($id,Request $request){

    $blog=Blog::find($id);

    if($blog==null){
            return response()->json([
                'status'=>false,
                'message'=>'Blog not found.',

            ]);
    }

    $validator= Validator::make($request->all(),[
            'title'=>'required | min:10',
            'author'=>'required | min:3',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'please fix the errors',
                'errors'=>$validator->errors()
            ]);
        }

        $blog->title=$request->title;
        $blog->author=$request->author;
        $blog->description=$request->description;
        $blog->shortDesc=$request->shortDesc;
        $blog->save();

        //save image here
        $tempImage=TempImage::find($request->image_id);

        if($tempImage!=null){

            //delete old image here

            File::delete(public_path('uploads/blogs/'.$blog->image));

            $imageExtArray=explode('.',$tempImage->name);
            $ext=last($imageExtArray);
            $imageName=time().'-'.$blog->id.'.'.$ext;

            $blog->image=$imageName;
            $blog->save();

            $sourcePath=public_path('uploads/temp/'.$tempImage->name);
            $desPath=public_path('uploads/blogs/'.$imageName);

            File::copy($sourcePath,$desPath);
        }

          return response()->json([
                'status'=>true,
                'message'=>'Blog updated successfully.',
                'data'=>$blog
         ]);

    }

    //This will delete a blog
    public function destroy($id){
        $blog=Blog::find($id);

        if($blog==null){
              return response()->json([
                'status'=>false,
                'message'=>'Blog not found.',
              ]);
        }

        //Delete blog image first

        File::delete(public_path('uploads/blogs/' .$blog->image));

        //Delete blog from DB

        $blog->delete();

        return response()->json([
                'status'=>true,
                'message'=>'Blog deleted successfully.',
         ]);

    }
}
