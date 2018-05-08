@extends('Admin.common')

@section('content')
<section class="container">
	<div class="row">
	<div class="col-md-12">
		<form action="{{route('delCrs')}}" method="POST">
			{{ csrf_field() }}
			<select class="custom-select del" id="adddept" name="Department">
				<option disabled selected value> -- select an option -- </option>
				@foreach($departments as $department)
				<option value="{{$department->DepartmentID}}">{{$department->DepartmentName}}</option>
				@endforeach
			</select>
			@foreach($departments as $department)
			<select class="custom-select del" id="add{{$department->DepartmentID}}Pgm" style="display: none" name="Programme" onchange="apgdrpdwn()">
				<option disabled selected value="0"> -- select an option -- </option>
				@foreach($department->programs as $program)
				<option value="{{$program->ProgrammeID}}">{{$program->ProgrammeName}}</option>
				@endforeach
			</select>
			@endforeach
			@foreach($departments as $department)
			@foreach($department->programs as $program)
			<select class="custom-select del" id="add{{$program->ProgrammeID}}Crs" style="display: none" onchange="acrsdrpdwn()" name="Course">
				<option disabled selected value="0"> -- select an option -- </option>
				@foreach($program->courses as $course)
				<option value="{{$course->CourseID}}">{{$course->CourseName}} - {{$course->CourseID}}</option>
				@endforeach
			</select>
			@endforeach
			@endforeach
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<form action="{{route('addCrs')}}" method="POST">
			{{ csrf_field() }}
			<select class="custom-select add" id="dept" name="Department">
				<option disabled selected value> -- select an option -- </option>
				@foreach($departments as $department)
				<option value="{{$department->DepartmentID}}">{{$department->DepartmentName}}</option>
				@endforeach
			</select>
			@foreach($departments as $department)
			<select class="custom-select add" id="{{$department->DepartmentID}}Pgm" style="display: none" name="Programme" onchange="pgpdwn()">
				<option disabled selected value="0"> -- select an option -- </option>
				@foreach($department->programs as $program)
				<option value="{{$program->ProgrammeID}}">{{$program->ProgrammeName}}</option>
				@endforeach
			</select>
			@endforeach			
					 <input class="form-control" type="text" placeholder="Enter Course Name" name="CourseName">
					 <input class="form-control" type="text" placeholder="Enter Course Name" name="CourseID">
				<button type="submit" class="btn btn-primary">Submit</button>
		</form>			 

		</div>
	
                                

                                @if ($errors->has('Course'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
	</div>
</section>
@endsection

@section('scripts')
	<script src="{{asset('js/dropdwn.js')}}"></script>
	<script src="{{asset('js/drop.js')}}"></script>
@endsection