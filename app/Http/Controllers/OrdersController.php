<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Requests;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('items')->get();
        return view('index')->with('orders', $orders);
        
     }
    
    public function home()
    {
        return Order::with('items')->get();
        //return print_r($_POST);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* TODO: figure out how to make this work with AJAX
        $this->validate($request, [
            'order_date' => 'required|date|after:tomorrow',
            'comment' => 'string',
        ]);
        */
        
        $order = new Order;
        
        if(!empty($request->input("order_id"))) {
            $this->update($request, $request->input("order_id"));
        } else {
            $order->order_date = $request->input('order_date');
            $order->comment = $request->input('comment');
            $order->save();
            
            $ic = new ItemsController;
            $ic->store($request, $order->id);
            
            return with("success", "Successful creation of order #" . $order->id);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Order::with('items')->where('id', $id)->get();
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
        $order = Order::find($id);
        
        $order->order_date = $request->input('order_date');
        $order->comment = $request->input('comment');
        $order->save();
        
        $ic = new ItemsController;
        $ic->store($request, $id);
        
        return with("success", "Successful update of order #" . $id);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $order = Order::find($request->input('id'));
        $order->delete();
        
        return "Order successfully deleted #". $request->input('id');
    }
}
