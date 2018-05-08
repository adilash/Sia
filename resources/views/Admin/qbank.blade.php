@extends('Admin.common')

@section('content')
<section class="container">
	<div class="row">
	<div class="col-md-10 ">
            <div class="panel panel-info">
                <div class="panel-heading">Search Question Paper</div>
                <div class="panel-body">
		<form action="{{route('MngQB')}}" method="POST">
			{{ csrf_field() }}
			<select class="custom-select" id="dept" name="Department">
				<option disabled selected value> -- select an option -- </option>
				@foreach($departments as $department)
				<option value="{{$department->DepartmentID}}">{{$department->DepartmentName}}</option>
				@endforeach
			</select>
			@foreach($departments as $department)
			<select class="custom-select" id="{{$department->DepartmentID}}Pgm" style="display: none" onchange="pgdrpdwn()" name="Programme">
				<option disabled selected value="0"> -- select an option -- </option>
				@foreach($department->programs as $program)
				<option value="{{$program->ProgrammeID}}">{{$program->ProgrammeName}}</option>
				@endforeach
			</select>
			@endforeach
			
			@foreach($departments as $department)
			@foreach($department->programs as $program)
			<select class="custom-select" id="{{$program->ProgrammeID}}Crs" style="display: none" onchange="crsdrpdwn()" name="Course">
				<option disabled selected value="0"> -- select an option -- </option>
				@foreach($program->courses as $course)
				<option value="{{$course->CourseID}}">{{$course->CourseName}} - {{$course->CourseID}}</option>
				@endforeach
			</select>
			@endforeach
			@endforeach
			<select class="custom-select" id="ttype" style="display: none" name="TType">
				<option disabled="disabled" selected="selected" value="0"> -- select an option -- </option>
				<option value="T1">T1</option>
				<option value="T2">T2</option>
				<option value="EndSem">End Sem</option>
			</select>
			<select class="custom-select" id="year" style="display: none" name="year">
				<option disabled selected value="0"> -- select an option -- </option>
				@for($i=date('Y');$i>=2005;$i--)
					<option>{{$i}}</option>
				@endfor
			</select>
			<script src="//www.townscript.com/organizer-popup-widget/townscript-organizer-widget.nocache.js" type="text/javascript"></script>
			<button type="submit" class="btn btn-primary" onclick="popup('fossmeet18')">Submit</button>

		</form>

@if(!$qitems->isEmpty())
		<table class="table table-sm">
		  <thead>
		    <tr>
		      <th scope="col">Department</th>
		      <th scope="col">Programme</th>
		      <th scope="col">Course</th>
		      <th scope="col">Year</th>
		      <th scope="col">Test</th>
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
		      <td><a href="{{route('QB',['path'=>$qitem->link])}}" target="_blank">Link
		      </a></td>
		      <td><a href="{{route('delQB',['qsid' => $qitem->qsid])}}">Link
		      </a><button type="submit" class="btn btn-primary">        Delete
                                </button></td>
		     </tr>

		    @endforeach
		  </tbody>
		</table>
	@endif
</div>
</div>
</div>
</div>
</section>
@endsection

@section('scripts')
	<script src="{{asset('js/drop.js')}}"></script>
@endsection