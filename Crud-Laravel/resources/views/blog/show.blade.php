
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div class="container" >
	<div class="row">
	<div class="col-sm-12">
		<div class="card">
		<div class="card-body">
			<h3 class="card-title">{{ $forms->title }}</h3>
			<h4 class="card-text">{{ $forms->description }}</h4>
			<br> <br><br>
			<a href="http://127.0.0.1:8000/forms" class="btn btn-primary">Back</a>
		</div>
		</div>
	</div>


@endsection
