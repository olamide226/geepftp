<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
          $last_date = DB::select(
    "SELECT max(created_at) ddate FROM `files` WHERE `user_id`=?",
    [$request->user()->id]);

        return view('files.create')->withLastDate($last_date);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'source' => 'required',
            'file' => 'required|mimes:xlsx,xlx,xls,csv,zip,txt|max:1000048',
            
        ]);
        if ('txt'==$request->file->extension()) {
            $fileName = $request->source .'.csv';
        }else{
            $fileName = $request->source .'.'.$request->file->extension();  

        }
   
        $request->file->move(public_path('uploads'), $fileName);
        $data = $request->all();
        $data['name'] = $fileName;
        $data['user_id'] = $request->user()->id;
        $data['email'] = $request->username;
  
        File::create($data);
   
        return redirect()->route('files.create')
                        ->with('success','File Uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
       
    }
    public function showSuccess()
    {
        return redirect()->route('files.create')
                        ->with('success','File Uploaded successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
