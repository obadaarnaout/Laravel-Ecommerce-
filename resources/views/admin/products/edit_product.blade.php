@extends('admin.index')
@section('admin')
<!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <div class="container-full">
         <section class="content">
            <!-- Basic Forms -->
            <div class="box">
               <div class="box-header with-border">
                  <h4 class="box-title">Edit Product</h4>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  <div class="row">
                     <div class="col">
                        <form novalidate id="edit_product_form" enctype="multipart/form-data" method="POST">
                           <div id="edit_product_form_alert"></div>
                           <div class="row">
                              <div class="col-6">
                                 <div class="form-group">
                                    <h5>Product Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="text" name="name" class="form-control" required data-validation-required-message="This field is required" value="{{$product->name}}"> 
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <h5>Brands <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <select name="brand" class="form-control" required>
                                          @foreach($brands as $key => $brand)
                                          <option value="{{$brand->id}}" {{$product->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <h5>Categories <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <select name="category" class="form-control" required id="category">
                                          @foreach($categories as $key => $category)
                                          <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <h5>Sub Categories <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <select name="sub_category" class="form-control" required id="sub_category">
                                          @foreach($categories as $key => $category)
                                          <optgroup class="sub_{{$category->id}}" required>
                                             @foreach($category->sub_category as $key => $sub_category)
                                             <option value="{{$sub_category->id}}" {{$product->sub_category_id == $sub_category->id ? 'selected' : ''}}>{{$sub_category->name}}</option>
                                             @endforeach
                                          </optgroup>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <h5>Product Price <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="number" name="price" class="form-control" required data-validation-required-message="This field is required" value="{{$product->price}}"> 
                                    </div>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="form-group">
                                    <h5>Product Description <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <textarea name="description" class="form-control" required>{{$product->description}}</textarea>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <h5>Product Thumbnail <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="file" name="thumb" class="form-control" required accept="image/png, image/gif, image/jpeg"> 
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <h5>Product Images <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                       <input type="file" name="images[]" class="form-control" required multiple accept="image/png, image/gif, image/jpeg"> 
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @csrf
                           <div class="text-xs-right">
                              <br>
                              <button type="submit" class="btn btn-rounded btn-info" id="edit_product_btn">Edit</button>
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

   $('#sub_category').find('optgroup').hide(); // initialize
   $('#sub_category').find('.sub_{{$product->category_id}}').show();
   $('#category').change(function() {
    var $cat = $(this).find('option:selected');
    var $subCat = $('#sub_category').find('.sub_' + $cat.val());
    $('#sub_category').find('optgroup').not("'"+ '.sub_' + $cat.val() + "'").hide(); // hide other optgroup
    $subCat.show();
    $subCat.find('option').removeAttr('selected');
    $subCat.find('option').first().attr('selected', 'selected');
   });

   $(document).ready(function() {
      $('#edit_product_form').ajaxForm({
         url: "{{url('/admin/update_product/'.$product->id)}}",
         beforeSubmit: function() {
            $("#edit_product_btn").text("Please wait..");
            $("#edit_product_btn").attr('disabled', true);
         },
         success: function(data) {
            if (data.status == 200) {
               $('#edit_product_form_alert').html(AddAlert('success', data.message));
               setTimeout(function(argument) {
                  $('#edit_product_form_alert').html('');
                  location.href = "{{route('all_products')}}";
               }, 2000);
               toastr.success(data.message);
            } else {
               $('#edit_product_form_alert').html(AddAlert('danger', data.message));
               toastr.error(data.message);
            }
            $("#edit_product_btn").text("Edit");
            $("#edit_product_btn").removeAttr('disabled');
         },
         error: function(data){
            $("#edit_product_btn").text("Edit");
            $("#edit_product_btn").removeAttr('disabled');
            $('#edit_product_form_alert').html(AddAlert('danger', data.responseJSON.message));
            toastr.error(data.responseJSON.message);
         }
      });
   });
</script>
@endsection