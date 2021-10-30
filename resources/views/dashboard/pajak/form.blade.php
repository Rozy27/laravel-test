@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h4">{{ $title }} Pajak</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="/dashboard/pajak{{ $actionlink }}" class="mb-5">
    {!! $newmethod !!}
    @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Pajak</label>
            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', !empty($adata) ? $adata->name : '') }}" requied autofocus>
            @error('name')
		      	<div class="invalid-feedback">
		      		{{ $message }}
		      	</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="rate" class="form-label">Nilai</label>
            <input type="text" onkeyup="hanyanumerik(this.id, this.value)" class="form-control form-control-sm @error('rate') is-invalid @enderror" id="rate" name="rate" value="{{ old('rate', !empty($adata) ? $adata->rate : '') }}" requied>
            @error('rate')
		      	<div class="invalid-feedback">
		      		{{ $message }}
		      	</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Keterangan</label>
            <input type="text" class="form-control form-control-sm @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description', !empty($adata) ? $adata->description : '') }}">
            @error('description')
		      	<div class="invalid-feedback">
		      		{{ $message }}
		      	</div>
            @enderror
        </div>

        <a href="/dashboard/pajak" class="btn btn-sm btn-warning"> <i class="fa fa-angle-double-left"></i> Kembali </a>
        @if ($mode != 'view')
            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> {{ $btnaksi }}</button>
        @endif
    </form>
</div>

@endsection