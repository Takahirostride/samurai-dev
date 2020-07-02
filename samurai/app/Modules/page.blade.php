@extends('layouts.home')
@section('style')
	{{ HTML::style('assets/client/css/page.css"') }}
@endsection
@section('content')
	<h1>Page</h1>
@endsection
@section('script')
	{{HTML::script('assets/client/js/page.js')}}
@endsection