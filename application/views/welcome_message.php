<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script> 
</head>
<body>

<div class="container">
	<!-- Page Heading --> 
        <div class="row">
            <div class="col-md-12"> 
            		 
                     <a href="javascript:void(0);" class="btn btn-success float-right" data-toggle="modal" data-target="#add_cat"><span class="fa fa-plus"></span> Add New</a>  
               <h1>Product List</h1>
                
            </div>
            
            <table class="table table-striped" id="mydata">
                <thead>
                    <tr>
                        <th>Category Id</th>
                        <th>Category Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody id="show_data">
                    
                </tbody>
            </table>
        </div>
    </div>
         

<!--  for model [add data ] --> 
<div class="modal fade" id="add_cat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border:none;">
        <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
      		<div class="form-group">
                <label class="col-md-2 col-form-label">Category Name</label>
                <div class="col-md-10">
                  <input type="text" name="cat_name" id="cat_name" class="form-control" placeholder="Category Name">
                </div>
            </div>   
      		<div class="form-group">
                <label class="col-md-2 col-form-label">Category Price</label>
                <div class="col-md-10">
                  <input type="text" name="price" id="price" class="form-control" placeholder="Category Price">
                </div>
            </div>  
      		<div class="form-group">
                <label class="col-md-2 col-form-label">Description</label>
                <div class="col-md-10">
                  <textarea name="desc" id="desc" class="form-control" placeholder="Category Description"></textarea> 
                </div> 
      	</div>   
      </div>
      <div class="modal-footer pt-3 mt-3" style="border:none;">
        <button type="button" class="btn btn-secondary mt-2" data-dismiss="modal">Close</button>
        <button type="button" type="submit" id="save" class="btn btn-success mt-2">Save</button>
      </div>
    </div>
  </div>
</div> 
        <!--end add data -->


<!-- edit data  -->
<div class="modal fade" id="edit_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Category Data</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Category Id</label>
            <div class="col-md-10">
              <input type="text" name="cat_id" id="cat_id" class="form-control" placeholder="Cat Id" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Category Name</label>
            <div class="col-md-10">
              <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Cat Name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Price</label>
            <div class="col-md-10">
              <input type="text" name="category_price" id="category_price" class="form-control" placeholder="Price">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label">Description</label>
            <div class="col-md-10">
              <textarea type="text" name="category_description" id="category_description" class="form-control" placeholder="category_description"></textarea>
            </div>
        </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" type="submit" id="update_cat" class="btn btn-info">Update</button>
  </div>
</div>
</div>
</div>
<!-- end of update form -->

<!-- popup delete form  -->
<div class="modal fade" id="delete_cat1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content"> 
  <div class="modal-body">
       <strong>are you sure delete this data ?</strong>
  </div>
  <div class="modal-footer">
    <input type="hidden" name="cat_id1" id="cat_id1" class="form-control">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
    <button type="button" type="submit" id="delete" class="btn btn-primary">Yes</button>
  </div>
</div>
</div>
</div>



<!-- script started on  -->
<script type="text/javascript">
$(document).ready(function(){
/*call this function auto load data */
$('#mydata').dataTable();
show_cat();	
function show_cat(){
	console.log('log 1.1');
    $.ajax({
        type  : 'ajax',
        url   : '?/welcome/cat_data',
        async : false,
        dataType : 'json',
        success : function(data){
            var html = '';
            var i;
            console.log(data);
            for(i=0; i<data.length; i++){
                html += '<tr>'+
                  		'<td>'+data[i].cat_id+'</td>'+
                        '<td>'+data[i].category_name+'</td>'+
                        '<td>'+data[i].category_price+'</td>'+
                        '<td>'+data[i].category_description+'</td>'+
                        '<td style="text-align:right;">'+
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm cat_edit" data-cat_id="'+data[i].cat_id+'" data-category_name="'+data[i].category_name+'" data-category_price="'+data[i].category_price+'" data-category_description="'+data[i].category_description+'">Edit</a>'+' '+
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm delete_cat" data-cat_id="'+data[i].cat_id+'">Delete</a>'+
                        '</td>'+
                        '</tr>';
            }
            $('#show_data').html(html);
        }

         

    });
}
/*end of get data --- -*/
		 $('#save').on('click',function(){
            var cat_name = $('#cat_name').val();
            var price = $('#price').val();
            var desc        = $('#desc').val();
            console.log('log 1.0 init insert');
            $.ajax({
                type : "POST",
                url  : "?/welcome/insert_cat",
                dataType : "JSON",
                data : {category_name:cat_name ,category_price:price,category_description:desc},
                success: function(data){
                	console.log('log 1.1 succ insert');
                    $('[name="cat_name"]').val("");
                    $('[name="price"]').val("");
                    $('[name="desc"]').val("");
                    $('#add_cat').modal('hide');
                    show_cat();
                }
            });
            return false;
        });

/*data[i].cat_id+'</td>'+
		                        '<td>'+data[i].category_name+'</td>'+
		                        '<td>'+data[i].category_price+'</td>'+
		                        '<td>'+data[i].category_description*/
		 /*end of insert operation */


		 /* for show data in popup menu */
		 $('#show_data').on('click','.cat_edit',function(){
            var cat_id = $(this).data('cat_id');
            var category_name = $(this).data('category_name');
            var category_price = $(this).data('category_price');
            var category_description = $(this).data('category_description');
            
            $('#edit_model').modal('show');
            $('[name="cat_id"]').val(cat_id);
            $('[name="category_name"]').val(category_name);
            $('[name="category_price"]').val(category_price);
            $('[name="category_description"]').val(category_description);
        });


		 /*   for update  categorys */
		 $('#update_cat').on('click',function(){
            var cat_id = $('#cat_id').val();
            var category_name = $('#category_name').val();
            var category_price =$('#category_price').val();
            var category_description =$('#category_description').val();
            console.log('log 1.0 init update operation');
            console.log('log cat'+cat_id);
            $.ajax({
                type : "POST",
                url  : "?/welcome/update_cat/"+cat_id,
                dataType : "JSON",
                data : {category_name:category_name ,category_price:category_price,category_description:category_description},
                success: function(data){
                	console.log('log 1.1 succ update');
            $('[name="cat_id"]').val(cat_id);
            $('[name="category_name"]').val(category_name);
            $('[name="category_price"]').val(category_price);
            $('[name="category_description"]').val(category_description);
                    $('#edit_model').modal('hide');
                    show_cat();
                }
            });
            return false;
        });


		 /*for popup alert delete form */
		$('#show_data').on('click','.delete_cat',function(){
            var cat_id = $(this).data('cat_id'); 
            $('#delete_cat1').modal('show'); 
            $('[name="cat_id1"]').val(cat_id);
        });

        /* delete cat id with data */
        $('#delete').on('click',function(){
            var cat_id = $('#cat_id1').val();
            
            console.log('log 1.0 init delete operation');
            console.log('log cat delete 1.0'+cat_id);
            $.ajax({
                type : "POST",
                url  : "?/welcome/delete_cat/"+cat_id,
                dataType : "JSON", 
                success: function(data){
                	console.log('log 1.1 succ delete');
           
                    $('#delete_cat1').modal('hide');
                    show_cat();
                }
            });
            return false;
        });
 

	});

</script>
</body>
</html>