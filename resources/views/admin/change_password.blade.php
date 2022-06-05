@extends('admin.index')
@section('admin')
<!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <div class="container-full">
         <section class="content">
            <!-- Basic Forms -->
            <div class="box">
               <div class="box-header with-border">
                  <h4 class="box-title">Edit Profile</h4>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  <div class="row">
                     <div class="col">
                        <form novalidate id="edit_admin_profile_form" method="POST">
                           <div id="edit_admin_profile_form_alert"></div>
                           <div class="row">
                              <div class="col-12">
                                 <div class="form-group">
                                    <h5>Current Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="password" name="current_password" class="form-control" required data-validation-required-message="This field is required"> 
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <h5>New Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="password" name="new_password" class="form-control" required data-validation-required-message="This field is required"> 
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <h5>Confirm Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="password" name="confirm_password" class="form-control" required data-validation-required-message="This field is required"> 
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @csrf
                           <div class="text-xs-right">
                              <br>
                              <button type="submit" class="btn btn-rounded btn-info" id="edit_admin_profile_btn">Submit</button>
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
      $('#edit_admin_profile_form').ajaxForm({
         url: "{{url('/admin/update_password')}}",
         beforeSubmit: function() {
            $("#edit_admin_profile_btn").text("Please wait..");
            $("#edit_admin_profile_btn").attr('disabled', true);
         },
         success: function(data) {
            if (data.status == 200) {
               $('#edit_admin_profile_form_alert').html(AddAlert('success', data.message));
               setTimeout(function(argument) {
                  $('#edit_admin_profile_form_alert').html('');
                  location.href = data.url;
               }, 2000);
               toastr.success(data.message);
            } else {
               $('#edit_admin_profile_form_alert').html(AddAlert('danger', data.message));
               toastr.error(data.message);
            }
            $("#edit_admin_profile_btn").text("Submit");
            $("#edit_admin_profile_btn").removeAttr('disabled');
         },
         error: function (data) {
            $("#edit_admin_profile_btn").text("Submit");
            $("#edit_admin_profile_btn").removeAttr('disabled');
            $('#edit_admin_profile_form_alert').html(AddAlert('danger', data.responseJSON.message));
            toastr.error(data.responseJSON.message);
         }
      });
   });
</script>
@endsection