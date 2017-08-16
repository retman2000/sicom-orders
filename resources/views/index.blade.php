@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
        		@if(session('success'))
        			<div class="alert alert-success">
        				{{session('success')}}
        			</div>
				@endif
        		@if(count($errors) > 0)
    				<div class="alert alert-danger">
        				@foreach($errors as $error)
        					<p>{{$error}}</p>
        				@endforeach
    				</div>
				@endif                
				@php
					$order_date = \Carbon\Carbon::today();
					$comment = '';
					$order_id = '';
				@endphp				
				@if(count($orders) > 0)
					@foreach($orders as $order)
						@php
							$order_date = $order->order_date;
							$comment = $order->comment;
							$order_id = $order->id;
						@endphp
    				@endforeach
				@endif             
                <div class="panel-body">
    				<div class="lead">
        				<h1>Edit Order</h1>
					</div>
             <form method="post" id="frmOrder" name="frmOrder" novalidate="">
             	{{ csrf_field() }}
                	<div class="form-group">
                		{{Form::label('order date', 'Order Date')}}
                		{{Form::date('order date', $order_date, ['autofocus' => 'autofocus'])}}
                	</div>
                	<div class="form-group">
                		{{Form::label('comment', 'Comment')}}
                		{{Form::textarea('comment', $comment, 
                		[
                    		'class' => 'form-control', 
                    		'placeholder' => 'Leave a comment', 
                    		'rows' => '4',
                		]) }}
                	</div>
    				<div class="lead">
        				<h1>Items</h1>
					</div>
					<table id="itemTable" class="table table-bordered">
						<thead>
							<th>Item Name</th>
							<th>Quantity</th>
							<th>Action</th>
						</thead>
						<tbody id="items-list">
						@if(count($orders) > 0)
							@foreach($orders as $order)
								@foreach($order->items as $item)
        							<tr>
        								<td class="col-md-6" id="item_name{{$item->id}}" class="name-input">{{$item->item_name}}</td>
        								<td class="col-md-2" id="quantity">{{$item->quantity}}</td>
        								<td class="col-md-4">
        									<button type="button" class="btn btn-danger">Delete</button>
    									</td>
        							</tr>
    							@endforeach
							@endforeach
						@endif
						</tbody>
					</table>
				<input type="hidden" id="order_id" name="order_id" value="{{$order_id}}">
           </form>
					<br/>
					<div class="row">
                		<button type="button" id="btn_add_item" name="btn_add_item" class="btn btn-primary btn-right" value="">Add Item</button>
            		</div>
				</div><!-- End panel-body -->
 				<div class="panel-footer">
					<div class="row">
						<button type="button" id="btn_save" class="btn btn-primary btn-right" value="save">Save</button>
					</div>
				</div>
                <!-- Modal (Pop up when detail button clicked) -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myModalLabel">Item Editor</h4>
                            </div>
                            <div class="modal-body">
                            <!-- Begin Modal Form -->
                                <form id="frmItems" name="frmItems" class="form-horizontal" novalidate="">
       								<div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Item Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" min="4" class="form-control" id="m_item_name" name="m_item_name" required="required" placeholder="Description">
                                        </div>
                                    </div>
                                    <div class="form-group error">
                                        <label for="inputItem" class="col-sm-3 control-label">Quantity</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="m_item_qty" name="m_item_qty" required="required" placeholder="How many?">
                                        </div>
                                    </div>
    
                                </form>
                            <!-- End Modal Form -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="btn_add" name="btn_add" class="btn btn-primary" value="add">Add</button>
                                <input type="hidden" id="item_id" name="item_id" value="">
                            </div>
                        </div>
                    </div>
                </div><!-- End Modal -->						
            </div><!-- End panel-primary -->
        </div>
    </div><!-- End row -->
</div><!-- End container -->
@endsection
