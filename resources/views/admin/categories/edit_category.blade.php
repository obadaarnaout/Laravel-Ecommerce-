@extends('admin.index')
@section('admin')
<div class="content-wrapper">
    <div class="container-full">
       <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="d-flex align-items-center">
             <div class="mr-auto">
                <h3 class="page-title">Edit Category</h3>
                <div class="d-inline-block align-items-center">
                   <nav>
                      <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                         <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                         <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                      </ol>
                   </nav>
                </div>
             </div>
          </div>
        </div>
		<section class="content">
		    <div class="row">
				<div class="col-4">
				    <div class="box">
				       <div class="box-header with-border">
				          <h3 class="box-title">Edit Category</h3>
				       </div>
				       <!-- /.box-header -->
				       <div class="box-body">
				          <div class="row">
		                     <div class="col">
		                        <form novalidate id="edit_admin_category_form" enctype="multipart/form-data" method="POST">
		                           <div id="edit_admin_category_form_alert"></div>
		                           <div class="row">
		                              <div class="col-12">
		                                 <div class="form-group">
		                                    <h5>Category Name <span class="text-danger">*</span></h5>
		                                    <div class="controls">
		                                       <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required" value="{{$category->name}}"> 
		                                    </div>
		                                 </div>
		                                 <div class="form-group">
		                                    <h5>Category Image <span class="text-danger">*</span></h5>
		                                    <div class="controls">
		                                       <input type="file" name="image" class="form-control" required> 
		                                    </div>
		                                    <img class="rounded-circle" src="{{url($category->image)}}" alt="User Avatar" id="previewImage" width="100px" height="100px">
		                                 </div>
		                              </div>
		                           </div>
		                           @csrf
		                           <div class="text-xs-right">
		                              <br>
		                              <button type="submit" class="btn btn-rounded btn-info" id="edit_admin_category_btn">Update</button>
		                           </div>
		                        </form>
		                     </div>
		                     <!-- /.col -->
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
      $('#edit_admin_category_form').ajaxForm({
         url: "{{route('update_category',$category->id)}}",
         beforeSubmit: function() {
            $("#edit_admin_category_btn").text("Please wait..");
            $("#edit_admin_category_btn").attr('disabled', true);
         },
         success: function(data) {
            if (data.status == 200) {
               $('#edit_admin_category_form_alert').html(AddAlert('success', data.message));
               setTimeout(function(argument) {
                  $('#edit_admin_category_form_alert').html('');
                  location.href = "{{route('all_categories')}}";
               }, 2000);
               toastr.success(data.message);
            } else {
               $('#edit_admin_category_form_alert').html(AddAlert('danger', data.message));
               toastr.error(data.message);
            }
            $("#edit_admin_category_btn").text("Update");
            $("#edit_admin_category_btn").removeAttr('disabled');
         },
         error: function(data){
         	$("#edit_admin_category_btn").text("Update");
            $("#edit_admin_category_btn").removeAttr('disabled');
         	$('#edit_admin_category_form_alert').html(AddAlert('danger', data.responseJSON.message));
            toastr.error(data.responseJSON.message);
		 }
      });
   });
</script>
@endsection