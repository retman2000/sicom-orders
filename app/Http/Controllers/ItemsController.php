<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;



class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in local storage.
     *
     * @param  Array  $request
     * @return JSON
     */ 
    public function add(Request $request)
    {   
        return $request;
    }

    public function remove(Request $request)
    {
        return $request;
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $order_id)
    {
        /* TODO: figure out how to make this work with AJAX
        $this->validate($request, [
            'order_id'  => 'required|numeric|min:1',
            'item_name' => 'required|string',
            'quantity' => 'required|numeric|min:1',
        ]);
        */
        
        $items = new Item;

        if($items->count() > 0) {
            $items->where("id", ">", 0)->delete();
        }
        
        $arrItems = [];
        foreach($request->items as $item) {
            $arrItems = ["order_id" => $order_id, "item_name" => $item["Item Name"], "quantity" => $item["Quantity"]];
            $items->create($arrItems);
        }
        
        $items->save();
        
        return with('success', 'Items have been saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($item_id)
    {
        return Item::find($item_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
