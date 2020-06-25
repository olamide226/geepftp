<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUpload()
    {
        return view('fileUpload');
    }
  
  public function fileUploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xlx,xls,csv,zip|max:1000048',
        ]);
  
        $fileName = time().'.'.$request->file->extension();  
   
        $request->file->move(public_path('uploads'), $fileName);
   
        return back()
            ->with('success','You have successfully uploaded file.')
            ->with('file',$fileName);
   
    }
}
