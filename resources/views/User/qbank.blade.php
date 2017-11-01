@extends('common')

@section('content')
<section class="container">
	<div class="row">
	<div class="col-md-12">
		<form action="/sumbitRequest">
			
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
			<select class="custom-select" id="{{$department->DepartmentID}}Crs" style="display: none" onchange="crsdrpdwn()" name="Course">
				<option disabled selected value="0"> -- select an option -- </option>
				@foreach($department->courses as $course)
				<option value="{{$course->CourseID}}">{{$course->CourseName}} - {{$course->CourseID}}</option>
				@endforeach
			</select>
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
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>
</section>
@endsection

@section('scripts')
	<script src="{{asset('js/drop.js')}}"></script>
@endsection