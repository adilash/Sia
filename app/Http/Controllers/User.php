<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\QPUploadRequest;
use DB;
use Illuminate\Support\Facades\Storage;
class User extends Controller
{
    //
    public function SelectQP()
    {
    	$departments=DB::table('DEPARTMENT')->get();
    	foreach ($departments as $department) {
    		$department->courses=DB::table('COURSE')->select('CourseID','CourseName')->where('DepartmentID','=',$department->DepartmentID)->get();
            $department->programs=DB::table('PROGRAMME')->select('ProgrammeID','ProgrammeName')->where('DepartmentID','=',$department->DepartmentID)->get();
    		# code...
    	}
    	return view('User.qbank')->with('departments',$departments);
    }
    public function Upload()
    {
        $departments=DB::table('DEPARTMENT')->get();
        foreach ($departments as $department) {
            $department->courses=DB::table('COURSE')->select('CourseID','CourseName')->where('DepartmentID','=',$department->DepartmentID)->get();
            $department->programs=DB::table('PROGRAMME')->select('ProgrammeID','ProgrammeName')->where('DepartmentID','=',$department->DepartmentID)->get();
            # code...
        }
        return view('User.upload')->with('departments',$departments);
    }

    public function storeQP(QPUploadRequest $request)
    {
        if($request->file('file')->isValid())
        {
            if(!(Storage::disk('local')->exists('Queue')))
                {
                    Storage::makeDirectory('Queue');
                }


        $file=$request->file('file');
        $path=$file->store('Queue','local');
        DB::table('QUEUE')->insert(['CourseID' => $request->Course,'ProgrammeID' => $request->Programme, 'Year' => $request->year,'TestType' => $request->TType,'link' => $path,'email' => $request->email]);
        return \Redirect::route('upload')
      ->with('message', 'Thanks for uploading!');
        }

    }

}
