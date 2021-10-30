<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kategori.index', [
			'arrdata' => Kategori::all()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.kategori.form', [
			'mode' => 'create',
			'title' => 'Tambah',
			'btnaksi' => 'Simpan',
            'actionlink' => '',
            'newmethod' => '',
            'adata' => array()
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
        	'name' => 'required|unique:kategoris|max:255',
        	'slug' => 'required|unique:kategoris'
        ]);

        $credentials['created_by'] = auth()->user()->name;
        Kategori::create($credentials);

        return redirect('/dashboard/kategori')->with('cache-message', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        return view('dashboard.kategori.form', [
			'mode' => 'view',
            'newmethod' => '<input type="hidden" name="_method" value="viewonly">',
			'title' => 'Lihat',
			'btnaksi' => 'Lihat',
			'actionlink' => '',
			'adata' => $kategori
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        return view('dashboard.kategori.form', [
			'mode' => 'edit',
            'newmethod' => '<input type="hidden" name="_method" value="put">',
			'title' => 'Update',
			'btnaksi' => 'Update',
			'actionlink' => '/'.$kategori->slug,
			'adata' => $kategori
		]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        $rules = [
            'name' => '',
        	'slug' => '',
        ];

        if(strtolower($request->name) != strtolower($kategori->name)){
        	$rules['name'] = 'required|unique:kategoris|max:255';
        }

        if(strtolower($request->slug) != strtolower($kategori->slug)){
        	$rules['slug'] = 'required|unique:kategoris|max:255';
        }

        $credentials = $request->validate($rules);

        $credentials['updated_by'] = auth()->user()->name;

        Kategori::where('id', $kategori->id)->update($credentials);

        return redirect('/dashboard/kategori')->with('cache-message', 'Data berhasil diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        Kategori::destroy($kategori->id);
        return redirect('/dashboard/kategori')->with('cache-message', 'Data berhasil dihapus!');
    }


    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Kategori::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
