@extends('Admin.common')

@section('content')
<section class="container">
	<div class="row">
	<div class="col-md-12">
		<form action="{{route('delProg')}}" method="POST">
			{{ csrf_field() }}
			<select class="custom-select" id="dept" name="Department">
				<option disabled selected value> -- select an option -- </option>
				@foreach($departments as $department)
				<option value="{{$department->DepartmentID}}">{{$department->DepartmentName}}</option>
				@endforeach
			</select>
			@foreach($departments as $department)
			<select class="custom-select" id="{{$department->DepartmentID}}Pgm" style="display: none" name="Programme">
				<option disabled selected value="0"> -- select an option -- </option>
				@foreach($department->programs as $program)
				<option value="{{$program->ProgrammeID}}">{{$program->ProgrammeName}}</option>
				@endforeach
			</select>
			@endforeach
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<form action="{{route('addProg')}}" method="POST">
			{{ csrf_field() }}
			<select class="custom-select" id="dept" name="Department">
				<option disabled selected value> -- select an option -- </option>
				@foreach($departments as $department)
				<option value="{{$department->DepartmentID}}">{{$department->DepartmentName}}</option>
				@endforeach
			</select>
					 <input class="form-control" type="text" placeholder="Enter Programme Name" name="Programme">
				<button type="submit" class="btn btn-primary">Submit</button>
		</form>			 

		</div>
	</div>
</section>
@endsection

@section('scripts')
	<script src="{{asset('js/drop.js')}}"></script>
@endsection