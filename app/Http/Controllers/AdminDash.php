<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use DB;
use Storage;
use Response;
class AdminDash extends Controller
{
    //
    public function showQueue()
    {
    	$qitems=DB::table('QUEUE')->join('COURSE','QUEUE.CourseID','=','COURSE.CourseID')->join('PROGRAMME','COURSE.ProgrammeID','=','PROGRAMME.ProgrammeID')->join('DEPARTMENT','DEPARTMENT.DepartmentID','=','PROGRAMME.DepartmentID')->select('qid','DepartmentName','ProgrammeName','CourseName','Year','TestType','link','email')->get();
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
    public function queueApr($qid)
    {
    	$qp=DB::table('QUEUE')->where('qid',$qid)->join('COURSE','QUEUE.CourseID','=','COURSE.CourseID')->join('PROGRAMME','COURSE.ProgrammeID','=','PROGRAMME.ProgrammeID')->first();
    	$db=DB::table('PROGRAMME')->where('ProgrammeID',$qp->ProgrammeID)->value('DepartmentID');
    	$course=DB::table('COURSE')->where('CourseID',$qp->CourseID)->value('CourseName');
    	
    	if(!Storage::exists($db))
    		{
    			Storage::makeDirectory($db);
    		}
    	if(!Storage::exists($db.'/'.$qp->ProgrammeID))
    		{
    			Storage::makeDirectory($db.'/'.$qp->ProgrammeID);	
    		}
    	if(!(Storage::exists($db.'/'.$qp->ProgrammeID.'/'.$qp->CourseID)))
    		{
    			Storage::makeDirectory($db.'/'.$qp->ProgrammeID.'/'.$qp->CourseID);	
    		}
    		$path=$db.'/'.$qp->ProgrammeID.'/'.$qp->CourseID;
    		$extension=File::extension(storage_path().'/'.$qp->link);
    		$filename=$course.'_'.$qp->Year.'_'.$qp->TestType;
    		$newLink=$path.'/'.$filename.'.'.$extension;
    		Storage::disk('local')->move($qp->link,'public/'.$newLink);
    		DB::table('QUESTIONPAPER')->insert(['CourseID' => $qp->CourseID,'Year' => $qp->Year,'TestType' => $qp->TestType,'link' => $newLink]);
    		DB::table('QUEUE')->where('qid',$qid)->delete();
    		return \Redirect::back()
      ->with('message', 'Aprroved');
    }
    public function queueDel($qid)
    {
    	$qp=DB::table('QUEUE')->where('qid',$qid)->first();
    	Storage::disk('local')->delete($qp->link);
    	DB::table('QUEUE')->where('qid',$qid)->delete();
    	return \Redirect::back()
      ->with('message', 'Deleted');
    }
    public function MngDep()
    {
    	$departments=DB::table('DEPARTMENT')->leftJoin('PROGRAMME','PROGRAMME.DepartmentID','=','DEPARTMENT.DepartmentID')->select(['DepartmentName','DEPARTMENT.DepartmentID AS DepartmentID'])->whereNULL('ProgrammeID')->get();
    	return view('Admin.MngDep')->with('departments',$departments);

    }
    public function addDep(Request $request)
    {
    	$validated= $request->validate([
        	'Department' => 'required'
        ]);
        DB::table('DEPARTMENT')->insert(
        	['DepartmentName'=>$request->Department
        	]);
        return \Redirect::back()->with('message',$request->Department.'ASD');
    }
    public function delDep(Request $request)
    {
    	$validated= $request->validate([
        	'Department' => 'required'
        ]);
        DB::table('DEPARTMENT')->where('DepartmentID',$request->Department)->delete();
        return \Redirect::back();
    }
    public function MngProg()
    {	
    	$departments=DB::table('DEPARTMENT')->get();
    	foreach ($departments as $department) {
    	$department->programs=DB::table('PROGRAMME')->leftJoin('COURSE','PROGRAMME.ProgrammeID','=','COURSE.ProgrammeID')->select(['ProgrammeName','PROGRAMME.ProgrammeID AS ProgrammeID'])->where('DepartmentID',$department->DepartmentID)->whereNULL('CourseID')->get();
    	
    }
    return view('Admin.MngProg')->with('departments',$departments);

}
    public function addProg(Request $request)
    {
    	$validated= $request->validate([
        	'Programme' => 'required'
        ]);
        DB::table('PROGRAMME')->insert(
        	['DepartmentID'=>$request->Department,
        	'ProgrammeName'=>$request->Programme
        	]);
        return \Redirect::back()->with('message',$request->Department.'ASD');
    }
    public function delProg(Request $request)
    {
    	$validated= $request->validate([
        	'Programme' => 'required'
        ]);
        DB::table('PROGRAMME')->where('ProgrammeID',$request->Programme)->delete();
        return \Redirect::back();
    }
  public function MngCrs()
    {	
    	$departments=DB::table('DEPARTMENT')->get();
    	foreach ($departments as $department) {
    	$department->programs=DB::table('PROGRAMME')->select(['ProgrammeName','ProgrammeID'])->where('DepartmentID',$department->DepartmentID)->get();
    	foreach ($department->programs as $program) {
    		$program->courses=DB::table('COURSE')->leftJoin('QUESTIONPAPER','COURSE.CourseID','=','QUESTIONPAPER.CourseID')->select(['CourseName','COURSE.CourseID AS CourseID'])->where('ProgrammeID',$program->ProgrammeID)->whereNULL('qsid')->get();
	# code...
    	}
    }
    return view('Admin.MngCrs')->with('departments',$departments);

}
    public function addCrs(Request $request)
    {
    	$validated= $request->validate([
        	'CourseID' => 'required',
        ]);
        DB::table('COURSE')->insert(
        	['CourseID' => $request->CourseID,
        		'CourseName' => $request->CourseName,
        	'ProgrammeID' => $request->Programme
        	]);
        return \Redirect::back()->with('message',$request->Department.'ASD');
    }
    public function delCrs(Request $request)
    {
    	$validated= $request->validate([
        	'Course' => 'required'
        ]);
        $qp=DB::table('QUEUE')->where('CourseID',$request->Course)->get();
        if(!$qp->isEmpty())
        {
        	foreach ($qp as $q) {
        		Storage::disk('local')->delete($q->link);	
        		# code...
        	}
        	DB::table('QUEUE')->where('CourseID',$request->Course)->delete();
        }
        DB::table('COURSE')->where('CourseID',$request->Course)->delete();
        return \Redirect::back();
    }    




    public function QB(Request $request)
    {
                $departments=DB::table('DEPARTMENT')->get();
        foreach ($departments as $department) {
            $department->programs=DB::table('PROGRAMME')->select('ProgrammeID','ProgrammeName')->where('DepartmentID','=',$department->DepartmentID)->get();
            foreach ($department->programs as $program) {
                $program->courses=DB::table('COURSE')->select('CourseID','CourseName')->where('ProgrammeID','=',$program->ProgrammeID)->get();
                # code...
            }
            }# code...
        
        
        $qitems=DB::table('QUESTIONPAPER')->join('COURSE','QUESTIONPAPER.CourseID','=','COURSE.CourseID')->join('PROGRAMME','COURSE.ProgrammeID','=','PROGRAMME.ProgrammeID')->join('DEPARTMENT','DEPARTMENT.DepartmentID','=','PROGRAMME.DepartmentID')->select('qsid','DepartmentName','ProgrammeName','CourseName','Year','TestType','link')->where('DEPARTMENT.DepartmentID','=',$request->Department)->where('PROGRAMME.ProgrammeID',$request->Programme)->where('COURSE.CourseID',$request->Course)->get();
        return view('Admin.qbank',compact('departments','qitems'));
    }

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
    	return view('Admin.qbank',compact('departments','qitems'));
    }


    public function delQB($qsid)
    {
    	$qp=DB::table('QUESTIONPAPER')->where('qsid',$qsid)->first();
    	$file=$qp->link;
    	Storage::delete($file);
    	DB::table('QUESTIONPAPER')->where('qsid',$qsid)->delete();

    }




}
