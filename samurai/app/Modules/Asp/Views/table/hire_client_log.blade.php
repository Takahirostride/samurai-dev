@extends('Asp::layouts.asp')
@section('content')
	<div class="container">	
		{!! Form::open(['url'=>'asp/tables/hire-client-statistic']) !!}
			<h3>Get list hire client statistic</h3>
			<p>
				<button type="submit" class="btn btn-primary" name="get_json" value="1">Start</button>
			</p>
		{!! Form::close() !!}		
		{!! Form::open(['url'=>'asp/tables/hire-client-statistic-update']) !!}
			<h3>Update database list hire client statistic</h3>
			<p>
				<button type="submit" class="btn btn-primary" name="save" value="1">Start</button>
			</p>
		{!! Form::close() !!}		
		<hr>
		{!! Form::open(['url'=>'asp/tables/hire-policy']) !!}
			<h3>Get list policy hire</h3>
			<p>
				<button type="submit" class="btn btn-primary" name="get_json" value="1">Start</button>
			</p>
		{!! Form::close() !!}		
		{!! Form::open(['url'=>'asp/tables/hire-policy-update']) !!}
			<h3>Update database list policy hire</h3>
			<p>
				<button type="submit" class="btn btn-primary" name="save" value="1">Start</button>
			</p>
		{!! Form::close() !!}	
		<hr>	
		{!! Form::open(['url'=>'asp/tables/hire-client-register']) !!}
			<h3>Get list json register hire</h3>
			<p>
				<button type="submit" class="btn btn-primary" name="save" value="1">Start</button>
			</p>		
		{!! Form::close() !!}
		{!! Form::open(['url'=>'asp/tables/hire-client-work']) !!}
			<h3>Get list json workset</h3>
			<p>
				<button type="submit" class="btn btn-primary" name="get_json" value="1">Start</button>
			</p>
		{!! Form::close() !!}		
		{!! Form::open(['url'=>'asp/tables/hire-client-save']) !!}
		<h3>Save hire-client-log</h3>
		<p>
			<button type="submit" class="btn btn-primary" name="save" value="1">Start</button>
		</p>
		{!! Form::close() !!}	
		<hr>
		{!! Form::open(['url'=>'asp/tables/hire-event']) !!}
			<h3>Check hire event</h3>
			<p>
				<button type="submit" class="btn btn-primary" name="create" value="1">Create</button>
				<button type="submit" class="btn btn-primary" name="accept" value="1">Accept</button>
				<button type="submit" class="btn btn-primary" name="finish" value="1">Finish</button>
				<button type="submit" class="btn btn-primary" name="workset" value="1">New WorkSet</button>
			</p>
		{!! Form::close() !!}				
	</div>
@endsection