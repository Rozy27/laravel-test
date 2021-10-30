<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Kategori;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\ItemResource;
use App\Http\Controllers\DB;

class ItemController extends Controller
{
    public function index()
	{
		return view('product', [
			'_posisi' => 'product', 
			'_title' => 'Products', 
			'arrdata' => Item::filter(request(['search','kategori']))->get(),
			'kategorilist' => Kategori::all()
		]);
	}

	public function showitems()
    {
		
			

        // $items = Item::all()->select('accounts.*', 'users.id as uid','users.user_name');
        $items = Item::all();


		$data = array();
		foreach ($items as $ky => $ai){

			$arrpajak = array();
			foreach ($ai->itempajak as $ditm => $itm){
					array_push($arrpajak, array(
						"id"   => $itm->pajak->id,
						"name" => $itm->pajak->name,
						"rate" => $itm->pajak->rate.'%',
					));
			}
			

			array_push($data, array(
				"id" 			=> $ai->id,
				"kategori_id" 	=> $ai->kategori_id,
				"kategori_name" => $ai->kategori->name,
				"name" 			=> $ai->name,
				"slug" 			=> $ai->slug,
				"description" 	=> $ai->description,
				"price" 		=> $ai->price,
				"image" 		=> asset('storage/'. $ai->image ),
				"created_by" 	=> $ai->created_by,
				"updated_by" 	=> $ai->updated_by,
				"created_at" 	=> $ai->created_at,
				"updated_at" 	=> $ai->updated_at,
				"pajak" 	    => $arrpajak,
			));
		}
		
		return ItemResource::collection($data);
    }

}
