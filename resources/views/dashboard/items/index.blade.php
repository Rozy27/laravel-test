@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h4">Item</h1>
  <a href="/dashboard/item/create" class="btn btn-sm btn-primary position-absolute px-3 py-1" style="right:20px;"> 
    <i class="fa fa-plus"></i> Tambah 
  </a>
</div>


@if(session()->has('cache-message') )
<div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
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
        <th scope="col" width="150">Kategori</th>
        <th scope="col" width="300">Nama Item</th>
        <th scope="col">Pajak</th>
        <th scope="col" width="100" style="text-align:right">Harga</th>
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
                  Pilih
                </a>
                <ul class="dropdown-menu" style="font-size:13px;" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="/dashboard/item/{{ $r->slug }}"><i class="fa fa-search"></i> Lihat</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="/dashboard/item/{{ $r->slug }}/edit"><i class="fa fa-edit"></i> Ubah</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li>
                    <form action="/dashboard/item/{{ $r->slug }}" method="post">
                      @method('delete')
                      @csrf
                      <button type="submit" class="dropdown-item" onclick="return confirm('Yakin hapus data ini ?')">
                        <i class="fa fa-trash"></i> Hapus
                      </button>
                    </form>  
                </ul>
            </li>
          </ul>
        </td>
        <td>{{ $r->kategori->name }}</td>
        <td>{{ $r->name }}</td>
        <td>

          @php
              $arpjk = '';
              foreach($r->itempajak as $kdi){
                $arpjk .= $arpjk == '' ? '' : ', ';
                $arpjk .= $kdi->pajak->name.' ( '.$kdi->pajak->rate.'% )';

              }
              
          @endphp

              {{ $arpjk }}
            

         
        </td>
        <td style="text-align:right">{{ number_format($r->price) }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
