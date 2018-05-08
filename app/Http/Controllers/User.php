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
            $department->programs=DB::table('PROGRAMME')->select('ProgrammeID','ProgrammeName')->where('DepartmentID','=',$department->DepartmentID)->get();
            foreach ($department->programs as $program) {
                $program->courses=DB::table('COURSE')->select('CourseID','CourseName')->where('ProgrammeID','=',$program->ProgrammeID)->get();
                # code...
            }
    		# code...
    	}
        $qitems=collect([]);
    	return view('User.qbank',compact('departments','qitems'));
    }
    public function Upload()
    {
        $departments=DB::table('DEPARTMENT')->get();
        foreach ($departments as $department) {
            $department->programs=DB::table('PROGRAMME')->select('ProgrammeID','ProgrammeName')->where('DepartmentID','=',$department->DepartmentID)->get();
            foreach ($department->programs as $program) {
                $program->courses=DB::table('COURSE')->select('CourseID','CourseName')->where('ProgrammeID','=',$program->ProgrammeID)->get();
                # code...
            }
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
        DB::table('QUEUE')->insert(['CourseID' => $request->Course,'Year' => $request->year,'TestType' => $request->TType,'link' => $path,'email' => $request->email]);
        return \Redirect::route('upload')
      ->with('message', 'Thanks for uploading!');
        }

    }
    public function qb(Request $request)
    {
                $validated= $request->validate([
            'Programme' => 'required',
            'Department' => 'required',
            'Course' => 'required',
        ]);
                $departments=DB::table('DEPARTMENT')->get();
        foreach ($departments as $department) {
            $department->programs=DB::table('PROGRAMME')->select('ProgrammeID','ProgrammeName')->where('DepartmentID','=',$department->DepartmentID)->get();
            foreach ($department->programs as $program) {
                $program->courses=DB::table('COURSE')->select('CourseID','CourseName')->where('ProgrammeID','=',$program->ProgrammeID)->get();
                # code...
            }
            }# code...
        
        $qitems=DB::table('QUESTIONPAPER')->join('COURSE','QUESTIONPAPER.CourseID','=','COURSE.CourseID')->join('PROGRAMME','COURSE.ProgrammeID','=','PROGRAMME.ProgrammeID')->join('DEPARTMENT','DEPARTMENT.DepartmentID','=','PROGRAMME.DepartmentID')->select('qsid','DepartmentName','ProgrammeName','CourseName','Year','TestType','link')->where('DEPARTMENT.DepartmentID','=',$request->Department)->where('PROGRAMME.ProgrammeID',$request->Programme)->where('COURSE.CourseID',$request->Course)->get();
    if((!empty($request->year)) && (!empty($request->TType)))
        {
            $qitems=DB::table('QUESTIONPAPER')->join('COURSE','QUESTIONPAPER.CourseID','=','COURSE.CourseID')->join('PROGRAMME','COURSE.ProgrammeID','=','PROGRAMME.ProgrammeID')->join('DEPARTMENT','DEPARTMENT.DepartmentID','=','PROGRAMME.DepartmentID')->select('qsid','DepartmentName','ProgrammeName','CourseName','Year','TestType','link')->where('DEPARTMENT.DepartmentID','=',$request->Department)->where('PROGRAMME.ProgrammeID',$request->Programme)->where('COURSE.CourseID',$request->Course)->where('Year',$request->year)->where('TestType',$request->TType)->get();
        }       
        return view('User.qbank',compact('departments','qitems'));
    }

}
