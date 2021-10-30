@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h4">{{ $title }} Kategori</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/kategori{{ $actionlink }}" class="mb-5">
    {!! $newmethod !!}
    @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', !empty($adata) ? $adata->name : '') }}" requied autofocus>
            @error('name')
		      	<div class="invalid-feedback">
		      		{{ $message }}
		      	</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Slug</label>
            <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', !empty($adata) ? $adata->slug : '') }}" requied>
            @error('slug')
		      	<div class="invalid-feedback">
		      		{{ $message }}
		      	</div>
            @enderror
        </div>
        <a href="/dashboard/kategori" class="btn btn-sm btn-warning"> <i class="fa fa-angle-double-left"></i> Kembali </a>
        @if ($mode != 'view')
            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> {{ $btnaksi }}</button>
        @endif
    </form>
</div>

<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function(){
        fetch('/dashboard/kategori/checkSlug?name='+ name.value)
          .then(response => response.json())
          .then(data => slug.value = data.slug)
    });
</script>

@endsection