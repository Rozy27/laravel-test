<?php

namespace App\Http\Controllers;

use App\Models\Pajak;
use Illuminate\Http\Request;

class DashboardPajakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.pajak.index', [
			'arrdata' => Pajak::all()
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.pajak.form', [
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
        	'name' => 'required|unique:pajaks|max:255',
        	'rate' => 'required|between:0,99.99',
        	'description' => ''
        ]);

        $credentials['created_by'] = auth()->user()->name;

        Pajak::create($credentials);

        return redirect('/dashboard/pajak')->with('cache-message', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pajak  $pajak
     * @return \Illuminate\Http\Response
     */
    public function show(Pajak $pajak)
    {
        return view('dashboard.pajak.form', [
			'mode' => 'view',
            'newmethod' => '<input type="hidden" name="_method" value="viewonly">',
			'title' => 'Lihat',
			'btnaksi' => 'Lihat',
			'actionlink' => '',
			'adata' => $pajak
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pajak  $pajak
     * @return \Illuminate\Http\Response
     */
    public function edit(Pajak $pajak)
    {
        return view('dashboard.pajak.form', [
			'mode' => 'edit',
            'newmethod' => '<input type="hidden" name="_method" value="put">',
			'title' => 'Update',
			'btnaksi' => 'Update',
			'actionlink' => '/'.$pajak->id,
			'adata' => $pajak
		]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pajak  $pajak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pajak $pajak)
    {
        $rules = [
        	'rate' => 'required|numeric|between:0,99.99',
        	'description' => '',
        	'name' => '',
        ];

        if(strtolower($request->name) != strtolower($pajak->name)){
        	$rules['name'] = 'required|unique:pajaks|max:255';
        }

        $credentials = $request->validate($rules);
        
        $credentials['updated_by'] = auth()->user()->name;

        Pajak::where('id', $pajak->id)->update($credentials);

        return redirect('/dashboard/pajak')->with('cache-message', 'Data berhasil diubah!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pajak  $pajak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pajak $pajak)
    {
        Pajak::destroy($pajak->id);
        return redirect('/dashboard/pajak')->with('cache-message', 'Data berhasil dihapus!');
    }
}
