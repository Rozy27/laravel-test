@extends('layouts.main')

@section('container')
	<div class="row">
		<div class="col-lg-3 mb-3">
			<form action="/product">
				<div class="input-group mb-3">
				  <input type="text" name="search" class="form-control" placeholder="Search.." value="{{ request('search') }}">
				  <input type="hidden" name="kategori" class="form-control" value="{{ request('kategori') }}">
				  <button class="btn btn-danger" type="submit">Search</button>
				</div>
			</form>

			<div class="list-group">
				<a href="#" class="list-group-item list-group-item-action bg-danger text-white">Kategori</a>
				<a href="/product" class="list-group-item list-group-item-action">All</a>
				@foreach ($kategorilist as $br)
				  <?php
				  	 $posisi_ = request('kategori');
				  	 $bgli_ = $br->slug == $posisi_ ?  '<span class="text-danger">'.$br->name.'</span>' : $br->name;
				  ?>
				  <a href="/product?kategori={{$br->slug}}" class="list-group-item list-group-item-action">{!! $bgli_ !!}</a>
				@endforeach
			</div>
		</div>
		<div class="col-lg-9">
			<div class="row">

			@if ($arrdata->count())

				@if ( request('search')) 
				<p class="text-center fs-6">Result {{$arrdata->count()}} for <strong>{{ request('search') }}</strong></p>
				@endif
				@foreach ($arrdata as $pr)
					<div class="col-lg-4 mb-3">
						<div class="card">
						  <div class="position-absolute px-3 py-1" style="background-color: rgba(220, 53, 69, 0.6)">
						  	<a href="/product?kategori={{$pr->kategori->slug}}" class="text-white text-decoration-none fs-7">{{$pr->kategori->name}}</a>
						  </div>

						  <img src="{{ asset('storage/'. $pr->image ) }}" class="card-img-top" alt="..." style="height: 250px;">
						  <ul class="list-group list-group-flush">

							<li class="list-group-item justify-content-between align-items-center" style="min-height:100px;">
							    {{$pr->name}}
                                <p><small class="text-muted">{{$pr->description}}</small></p>
							</li>

                            <li class="list-group-item d-flex justify-content-between align-items-center bg-danger text-white">
							    Price
							    <span class="label">IDR {{number_format($pr->price)}}</span>
							</li>
						  </ul>
						</div>
					</div>
				@endforeach
			@else
				<p class="text-center fs-6">No data found.</p>
			@endif
			</div>
		</div>
	</div>
@endsection


