@extends('layouts.main')

@section('container')
		    
<div class="row justify-content-center">
	<div class="col-lg-4">

		@if(session()->has('cache-message'))
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  {{ session('cache-message') }}
			  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		@endif

		<main class="form-signin">
	    	<h1 class="h3 mb-3 fw-normal text-center">Please Log in</h1>
		  <form action="/login" method="post">
		  	@csrf
		    <div class="form-floating">
		      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email address" autofocus="" required value="{{ old('email') }}">
		      <label for="email">Email address</label>
		      @error('email')
		      	<div class="invalid-feedback">
		      		{{ $message }}
		      	</div>
		      @enderror
		    </div>
		    <div class="form-floating">
		      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
		      <label for="password">Password</label>
		    </div>
		    <button class="w-100 btn btn-lg btn-danger mt-3" type="submit">Log in</button>
		  </form>
		</main>
	</div>
</div>

@endsection