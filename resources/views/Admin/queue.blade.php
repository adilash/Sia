@extends('common')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
		<table class="table table-sm">
		  <thead>
		    <tr>
		      <th scope="col">Department</th>
		      <th scope="col">Programme</th>
		      <th scope="col">Course</th>
		      <th scope="col">Year</th>
		      <th scope="col">Test</th>
		      <th scope="col">email</th>
		      <th scope="col">Link</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($qitems as $qitem)
		    <tr>
		    
		      <td>{{$qitem->DepartmentName}}</td>
		      <td>{{$qitem->ProgrammeName}}</td>
		      <td>{{$qitem->CourseName}}</td>
		      <td>{{$qitem->Year}}</td>
		      <td>{{$qitem->TestType}}</td>
		      <td>{{$qitem->email}}</td>
		      <td><a href="{{route('queueLink',['qid' => $qitem->qid])}}" target="_blank">Link
		      </a></td>
		  </tr>
		    <tr>	
		     <td>
		     	<a href="{{route('queueApr',['qid' =>$qitem->qid])}}"><button type="submit" class="btn btn-primary">
                                    Approve
                                </button></a>
                                </td>
               <td><a href="{{route('queueDel',['qid' =>$qitem->qid])}}"><button type="submit" class="btn btn-primary">
                                    Delete
                                </button>
                            </a></td>
            
            </tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
	</div>
</div>