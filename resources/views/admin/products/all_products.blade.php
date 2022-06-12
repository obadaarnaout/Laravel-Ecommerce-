@extends('admin.index')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
       <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="d-flex align-items-center">
             <div class="mr-auto">
                <h3 class="page-title">All Products</h3>
                <div class="d-inline-block align-items-center">
                   <nav>
                      <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                         <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                         <li class="breadcrumb-item active" aria-current="page">All Products</li>
                      </ol>
                   </nav>
                </div>
             </div>
          </div>
        </div>
		<section class="content">
		    <div class="row">
				<div class="col-8">
				    <div class="box">
				       <div class="box-header with-border">
				          <h3 class="box-title">All Products</h3>
				       </div>
				       <!-- /.box-header -->
				       <div class="box-body">
				          <div class="table-responsive">
				             <table id="product_table" class="table table-bordered table-striped">
				                <thead>
				                   <tr>
				                      <th>Name</th>
				                      <th>Image</th>
				                      <th>Action</th>
				                   </tr>
				                </thead>
				                <tbody>
				                	@foreach($products as $key => $product)
				                   <tr>
				                      <td>{{$product->name}}</td>
				                      <td><img src="{{url($product->thumb)}}" width="50px;" height="50px;"></td>
				                      <td>
				                      	<a href="{{route('edit_product',$product->id)}}" class="btn btn-info">Edit</a>
				                      	<a href="{{route('delete_product',$product->id)}}" class="btn btn-danger">Delete</a>
				                      </td>
				                   </tr>
				                   @endforeach
				                </tbody>
				                <tfoot>
				                   <tr>
				                      <th>Name</th>
				                      <th>Image</th>
				                      <th>Action</th>
				                   </tr>
				                </tfoot>
				             </table>
				          </div>
				       </div>
				       <!-- /.box-body -->
				    </div>          
				</div>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">

   $(document).ready(function() {
      $('#product_table').DataTable();
      $('#add_admin_brand_form').ajaxForm({
         url: "{{route('add_brand')}}",
         beforeSubmit: function() {
            $("#add_admin_brand_btn").text("Please wait..");
            $("#add_admin_brand_btn").attr('disabled', true);
         },
         success: function(data) {
            if (data.status == 200) {
               $('#add_admin_brand_form_alert').html(AddAlert('success', data.message));
               setTimeout(function(argument) {
                  $('#add_admin_brand_form_alert').html('');
                  location.reload();
               }, 2000);
               toastr.success(data.message);
            } else {
               $('#add_admin_brand_form_alert').html(AddAlert('danger', data.message));
               toastr.error(data.message);
            }
            $("#add_admin_brand_btn").text("Add");
            $("#add_admin_brand_btn").removeAttr('disabled');
         },
         error: function(data){
         	$("#add_admin_brand_btn").text("Add");
            $("#add_admin_brand_btn").removeAttr('disabled');
         	$('#add_admin_brand_form_alert').html(AddAlert('danger', data.responseJSON.message));
            toastr.error(data.responseJSON.message);
		 }
      });
   });
</script>
@endsection