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
                        <form novalidate id="edit_admin_profile_form" enctype="multipart/form-data" method="POST">
                           <div id="edit_admin_profile_form_alert"></div>
                           <div class="row">
                              <div class="col-12">
                                 <div class="form-group">
                                    <h5>User Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required" value="{{$AdminData->name}}"> 
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <h5>Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="email" name="email" class="form-control" required data-validation-required-message="This field is required" value="{{$AdminData->email}}"> 
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <h5>Profile Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="file" name="avatar" class="form-control" required onchange="PreviewImage(this)"> 
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <img class="rounded-circle" src="{{(!empty($AdminData->avatar) ? url($AdminData->avatar) :url('upload/avatar-1.png') )}}" alt="User Avatar" id="previewImage" width="100px" height="100px">
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
   function PreviewImage(self) {
      const file = self.files;
      if (file && file[0]) {
         var previewImage = document.getElementById('previewImage');
         previewImage.src = URL.createObjectURL(file[0])
      } 
   }

   $(document).ready(function() {
      $('#edit_admin_profile_form').ajaxForm({
         url: "{{url('/admin/update_profile/' . $AdminData->id)}}",
         beforeSubmit: function() {
            $("#edit_admin_profile_btn").text("Please wait..");
            $("#edit_admin_profile_btn").attr('disabled', true);
         },
         success: function(data) {
            if (data.status == 200) {
               $('#edit_admin_profile_form_alert').html(AddAlert('success', data.message));
               setTimeout(function(argument) {
                  $('#edit_admin_profile_form_alert').html('');
               }, 2000);
               toastr.success(data.message);
            } else {
               $('#edit_admin_profile_form_alert').html(AddAlert('danger', data.message));
               toastr.error(data.message);
            }
            $("#edit_admin_profile_btn").text("Submit");
            $("#edit_admin_profile_btn").removeAttr('disabled');
         }
      });
   });
</script>
@endsection