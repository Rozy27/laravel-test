@extends('dashboard.layouts.main')

@section('container')


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h4">List Pajak</h1>
  <a href="/dashboard/pajak/create" class="btn btn-sm btn-primary position-absolute px-3 py-1" style="right:20px;"> 
    <i class="fa fa-plus"></i> Tambah 
  </a>
</div>

@if(session()->has('cache-message') )
<div class="alert alert-success alert-dismissible fade show col-lg-5" role="alert">
  {{ session('cache-message') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
        
<div class="table-responsive" style="display:block;height:450px;max-height:450px;overflow-y:auto;-ms-overflow-style:-ms-autohiding-scrollbar;">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col" width="30" class="text-center">#</th>
        <th scope="col" width="50" class="text-center">Aksi</th>
        <th scope="col" width="200">Nama</th>
        <th scope="col" width="100" style="text-align: right;">Nilai (%)</th>
        <th scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($arrdata as $r)
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td class="text-center">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Aksi
                </a>
                <ul class="dropdown-menu" style="font-size:13px;" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="/dashboard/pajak/{{ $r->id }}"><i class="fa fa-search"></i> Lihat</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="/dashboard/pajak/{{ $r->id }}/edit"><i class="fa fa-edit"></i> Ubah</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form action="/dashboard/pajak/{{ $r->id }}" method="post">
                      @method('delete')
                      @csrf
                      <button type="submit" class="dropdown-item" onclick="return confirm('Yakin hapus data ini ?')">
                        <i class="fa fa-trash"></i> Hapus </a>
                      </button>
                    </form>  
                </ul>
            </li>
        </ul>
        </td>
        <td>{{ $r->name }}</td>
        <td style="text-align: right;">{{ $r->rate }}</td>
        <td>{{ $r->description }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection