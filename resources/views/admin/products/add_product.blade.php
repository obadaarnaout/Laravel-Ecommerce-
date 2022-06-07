@extends('admin.index')
@section('admin')
<!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <div class="container-full">
         <section class="content">
            <!-- Basic Forms -->
            <div class="box">
               <div class="box-header with-border">
                  <h4 class="box-title">Add Product</h4>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  <div class="row">
                     <div class="col">
                        <form novalidate id="add_product_form" enctype="multipart/form-data" method="POST">
                           <div id="add_product_form_alert"></div>
                           <div class="row">
                              <div class="col-12">
                                 <div class="form-group">
                                    <h5>Product Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required" value=""> 
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <h5>Product Images <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="file" name="images" class="form-control" required> 
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @csrf
                           <div class="text-xs-right">
                              <br>
                              <button type="submit" class="btn btn-rounded btn-info" id="add_product_btn">Submit</button>
                           </div>
                        </form>
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->
         </section>
         



      </div>
   </div>
<!-- /.content-wrapper -->
<script type="text/javascript">
   $(document).ready(function() {
      $('#add_product_form').ajaxForm({
         url: "{{url('/admin/add_new_product')}}",
         beforeSubmit: function() {
            $("#add_product_btn").text("Please wait..");
            $("#add_product_btn").attr('disabled', true);
         },
         success: function(data) {
            if (data.status == 200) {
               $('#add_product_form_alert').html(AddAlert('success', data.message));
               setTimeout(function(argument) {
                  $('#add_product_form_alert').html('');
               }, 2000);
               toastr.success(data.message);
            } else {
               $('#add_product_form_alert').html(AddAlert('danger', data.message));
               toastr.error(data.message);
            }
            $("#add_product_btn").text("Submit");
            $("#add_product_btn").removeAttr('disabled');
         }
      });
   });
</script>
@endsection