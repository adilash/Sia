<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Storage;
use Response;
class AdminDash extends Controller
{
    //
    public function showQueue()
    {
    	$qitems=DB::table('QUEUE')->join('COURSE','QUEUE.CourseID','=','COURSE.CourseID')->join('PROGRAMME','QUEUE.ProgrammeID','=','PROGRAMME.ProgrammeID')->join('DEPARTMENT','DEPARTMENT.DepartmentID','=','COURSE.DepartmentID')->select('qid','DepartmentName','ProgrammeName','CourseName','Year','TestType','link','email')->get();
    	return view('Admin.queue')->with('qitems',$qitems);

    }
    public function getFile($qid)
    {
    	$link=DB::table('QUEUE')->select('link')->where('qid','=',$qid)->first();
    	
    	$file=Storage::disk('local')->get($link->link);

		
return Response::make($file, 200, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'inline; filename="'.$qid.'"'
]);
    }
}
