@if (session()->has('error'))
   	<div class="alert alert-danger">
       {{ session()->get('error') }}
   	</div>
@endif
@if (session('success'))
   	<div class="alert alert-success">
       {{ session('success') }}
   	</div>
@endif