<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Itempajak;
use App\Models\Kategori;
use App\Models\Pajak;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

class DashboardItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.items.index', [
			'arrdata' => Item::all(),
		]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('dashboard.items.form', [
			'mode' => 'create',
			'title' => 'Tambah',
			'btnaksi' => 'Simpan',
            'actionlink' => '',
            'newmethod' => '',
            'adata' => array(),
            'arpjk' => array(),
            'arrkategories' => Kategori::all(),
            'arrpajaks' => Pajak::all()
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

        if($request['pajaks']){
            $request['pajak'] = count($request['pajaks']);
        }else{
            $request['pajak'] = 0;
        }

        $rules = [
            'kategori_id' => 'required',
        	'name' => 'required|unique:items|max:255',
        	'slug' => 'required|unique:items',
        	'description' => '',
        	'price' => 'required|numeric',
            'image' => 'image|file|max:1024',
            'pajak' => 'integer|min:2',
        ];

        $credentials = $request->validate($rules);
        

        if($request->file('image')){
        	$credentials['image'] = $request->file('image')->store('items-images');
        }
        
        $credentials['created_by'] = auth()->user()->name;

        $newid = Item::create($credentials);

        for ($i = 0; $i < count($request->pajaks); $i++) {
            $apj[] = [
                'item_id' => $newid->id,
                'pajak_id' => $request->pajaks[$i],
            ];
        }
        Itempajak::insert($apj);

        return redirect('/dashboard/item')->with('cache-message', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('dashboard.items.form', [
			'mode' => 'view',
            'newmethod' => '<input type="hidden" name="_method" value="viewonly">',
			'title' => 'Lihat',
			'btnaksi' => 'Lihat',
			'actionlink' => '',
			'adata' => $item,
            'arrkategories' => Kategori::all(),
            'arrpajaks' => Pajak::all()
		]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('dashboard.items.form', [
			'mode' => 'edit',
            'newmethod' => '<input type="hidden" name="_method" value="put">',
			'title' => 'Update',
			'btnaksi' => 'Update',
			'actionlink' => '/'.$item->slug,
			'adata' => $item,
			'arpjk' => explode(",", $item->pajaks),
            'arrkategories' => Kategori::all(),
            'arrpajaks' => Pajak::all(),
		]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {   
        $request['pajak'] = isset($request['pajaks']) ? count($request['pajaks']) : 0;
        $rules = [
            'kategori_id' => 'required',
            'name' => '',
        	'description' => 'required|max:255',
        	'price' => 'required|numeric',
            'image' => 'image|file|max:1024',
            'slug' => '',
        ];

        if(strtolower($request->name) != strtolower($item->name)){
        	$rules['name'] = 'required|unique:items|max:255';
        }

        if(strtolower($request->slug) != strtolower($item->slug)){
        	$rules['slug'] = 'required|unique:items|max:255';
        }

        if($request['pajak'] < 2){
        	$rules['pajak'] = 'required|integer|min:2';
        }

        $credentials = $request->validate($rules);

        

        if($request->file('image')){
            if($request->oldimage){
                Storage::delete($request->oldimage);
            }
        	$credentials['image'] = $request->file('image')->store('items-images');
        }

        $credentials['updated_by'] = auth()->user()->name;

        Item::where('id', $item->id)->update($credentials);
        Itempajak::where('item_id', '=', $item->id)->delete();

        for ($i = 0; $i < count($request->pajaks); $i++) {
            $apj[] = [
                'item_id' => $item->id,
                'pajak_id' => $request->pajaks[$i],
            ];
        }

        Itempajak::insert($apj);

        return redirect('/dashboard/item')->with('cache-message', 'Data berhasil diubah!');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if(!empty($item->image) && ($item->image != 'items-images/default.jpg') ){
            Storage::delete($item->image);
        }
        Itempajak::where('item_id', '=', $item->id)->delete();
        Item::destroy($item->id);
        return redirect('/dashboard/item')->with('cache-message', 'Data berhasil dihapus!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Item::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
