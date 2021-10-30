@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h4">{{ $title }} Item</h1>
</div>

<form method="post" action="/dashboard/item{{ $actionlink }}" class="mb-5" enctype="multipart/form-data">
{!! $newmethod !!}
@csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Item</label>
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', !empty($adata) ? $adata->name : '') }}" requied autofocus>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', !empty($adata) ? $adata->slug : '') }}" requied>
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="description" class="form-label">Keterangan</label>
                <textarea class="form-control form-control-sm" id="description" name="description" rows="4">{{ old('description', !empty($adata) ? $adata->description : '') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-select form-select-sm" name="kategori_id" id="kategori_id" requied>
                        @foreach ($arrkategories as $kat)
                            @if (old('kategori_id') == $kat->id)
                                <option value="{{ $kat->id }}" selected>{{ $kat->name }}</option>
                            @else
                                <option value="{{ $kat->id }}">{{ $kat->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="col-lg-4 mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <input type="text" onkeyup="hanyanumerik(this.id, this.value)" class="form-control form-control-sm @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', !empty($adata) ? $adata->price : '') }}" requied>
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Pajak</label>
                    

                    @php
                        $arpjk = array();
                        if($adata){
                            foreach($adata->itempajak as $hj){
                                $arpjk[] = $hj->pajak_id;
                            }
                        }
                    @endphp

                    @foreach ($arrpajaks as $pj)
        

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" {{ in_array($pj->id, $arpjk) ? 'checked="checked"' : '' }} value="{{ $pj->id }}" id="pajaks_{{ $loop->iteration }}" name="pajaks[]">
                            <label class="form-check-label" for="pajak_{{ $loop->iteration }}">
                            {{ $pj->name }}
                            </label>
                        </div>
                    @endforeach

                    @error('pajak')
                        <p class="text-danger">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                @if( !empty($adata) && !empty($adata->image) && $adata->image != 'items-images/default.jpg'  )
                    @php $oldimage = $adata->image; @endphp
                    <img src="{{ asset('storage/'. $adata->image ) }}" class="img-preview img-fluid mb-3 col-sm-2 d-block">
                @else
                    @php $oldimage = ''; @endphp  
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif

                <input type="hidden" id="oldimage" name="oldimage" value="{{ $oldimage }}">
                
                <input class="form-control form-control-sm @error('image') is-invalid @enderror" id="image" name="image" type="file" onchange="previewImage()">
                @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
        <a href="/dashboard/item" class="btn btn-sm btn-warning"> <i class="fa fa-angle-double-left"></i> Kembali </a>
            @if ($mode != 'view')
                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> {{ $btnaksi }}</button>
            @endif
        </div>
    </div>
</form>

<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function(){
        fetch('/dashboard/item/checkSlug?name='+ name.value)
          .then(response => response.json())
          .then(data => slug.value = data.slug)
    });

    function previewImage() {
        const image = document.querySelector('#image');
        const imgPrev = document.querySelector('.img-preview');

        imgPrev.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPrev.src = oFREvent.target.result;
        }
    }
    
</script>

@endsection
