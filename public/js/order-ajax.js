$(document).ready(function(){

    var data = "";
    var d = new Date();
    var title = {
    		itemName: "Item Name",
    		itemQty: "Quantity",
    		itemAction: "Action"
    };
    var settings = {
    		"time":   d.getTime(),      // Time stamp of when the object was created
    		"start":  1,               	// Display start point
    		"length": 10,               // Page length
    		"order":  [],             	// 2D array of column ordering information (see `order` option)
    		"search": {
    		    "search": "",          	// Search term
    		    "regex": 0,          	// Indicate if the search term should be treated as regex or not
    		    "smart": 0,           	// Flag to enable DataTables smart search
    		    "caseInsensitive": 0	// Case insensitive flag
    		},
    		"columns": [
    		    {
    		        "visible": 1,     	// Column visibility
    		        "search":  {}     	// Object containing column search information. Same structure as `search` above
    		    }
    		]
	};
    var tbl = $("#itemTable").DataTable( {
    	retrieve: true,
    	stateSave: true,
    	searching: false,
    	buttons: true,
    	data: data,
    	columns: [
    		{"data": title.itemName},
    		{"data": title.itemQty},
    		{"data": title.itemAction}
    	]
    }).on('stateSaveParams.dt', function (e, settings, data) {
    	data.search.search = "";
    });    	
    
    
    //display modal form for creating new item
    $("#btn_add_item").click(function(){
        $('#frmItems').trigger("reset");
    	$('#myModal').modal('show');    	
    });

    
    //delete item and remove it from list
    $("#itemTable").on("click", ".btn-danger", function() {
    	tbl.row($(this).parents('tr')).remove().draw();
	});

      
    //Add new item to DOM
    $("#btn_add").click(function () {    	
    	data = {
    			"Item Name" : $("#m_item_name").val(),
    			"Quantity" : $("#m_item_qty").val(),
    			"Action" : "<button type='button' class='btn btn-danger'>Delete</button>"
		};
    	
    	tbl.row.add(data).draw();
        $('#myModal').modal('hide');    	
    });
  
    
       
    //create new item / update existing item
    $("#btn_save").click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        
        var frmData = {
        		"order_id": $("#order_id").val(),
        		"order_date": $("input[type='date']").val(),
        		"comment": $("#comment").val(),
        		"items": $("#itemTable").DataTable().rows().data().toArray()
        };
        
        $.ajax({
            method: "POST",
            url: "/save",
            data: frmData,
            dataType: "json"
        })
    	.done(function (data, textStatus, jqXHR) {
            console.log("ajax response: "+ data);
            $(".alert-success").append(textStatus+": "+data);
        })
        .fail(function (jqXHR, textStatus, ex) {
                console.log(textStatus+": "+jqXHR.statusText+" - "+ex);
                $(".alert-danger").append(jqXHR.statusText)
        });
    });
});