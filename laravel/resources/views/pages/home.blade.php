@extends('master')

@section('content')

	Home page


	@foreach($lessons as $lesson)
		<h3>{{$lesson}}</h3>
	@endforeach

	

@stop