@extends('Admin.common')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6">
		<form method="POST" action="{{route('addDep')}}">
		 {{ csrf_field() }}
		 <input class="form-control" type="text" placeholder="Enter Department Name" name="Department">
		 <button type="submit" class="btn btn-primary">Submit</button>
		 </form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
		<form method="POST" action="{{route('delDep')}}">
		 {{ csrf_field() }}
				<select class="custom-select" id="dept" name="Department">
				<option disabled selected value> -- select an option -- </option>
				@foreach($departments as $department)
				<option value="{{$department->DepartmentID}}">{{$department->DepartmentName}}</option>
				@endforeach
			</select>
		 <button type="submit" class="btn btn-primary">Submit</button>
		 </form>
		</div>
	</div>
</div>
@if(Session::has('message'))
    <div class="alert alert-info">
      {{Session::get('message')}}
    </div>
@endif
@endsection