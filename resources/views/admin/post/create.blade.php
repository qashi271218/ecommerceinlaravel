@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="index.html">Ecommerce</a>
          <span class="breadcrumb-item active">Post Section</span>
        </nav>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Add Product</h6>
                <form method="POST" action="{{ route('store.post') }}" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body pd-20">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Post title(english)</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="post_title_en" name="post_title_en">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Post title(hindi)</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="post_title_in" name="post_title_in">
                      </div>
                      <div class="form-group">
                        <label class="form-control-label">Post Details(en): <span class="tx-danger">*</span></label>

                  <textarea class="form-control" id="summernote"  name="details_en">

                   </textarea>

                      </div>
                      <div class="form-group">
                        <label class="form-control-label">Product Details (HINDI): <span class="tx-danger">*</span></label>

                  <textarea class="form-control" id="summernote1"  name="details_in">

                   </textarea>

                      </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="form-control-label">Image<span class="tx-danger">*</span></label>
                                   <label class="custom-file">
                            <input type="file" id="file" class="custom-file-input" name="post_image" onchange="readURL(this);">
                            <span class="custom-file-control"></span>
                             <img src="#" id="one">
                              </label>

                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">category Name</label>
                    <select class="form-control" name="postcategory_id">
                        <option>Select blog Category</option>
                    @foreach($blogs as $blog)
                    <option value="{{$blog->id}}">{{ $blog->category_name_en }}</option>
                    @endforeach
                    </select>
                                  </div>

                </div><!-- modal-body -->
                <div class="modal-footer">
                  <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                  <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                </div>
              </form>
        </div>
      </div><!-- sl-mainpanel -->
      <!-- ########## END: MAIN PANEL ########## -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
       $('select[name="category_id"]').on('change',function(){
            var category_id = $(this).val();
            if (category_id) {

              $.ajax({
                url: "{{ url('/get/subcategory/') }}/"+category_id,
                type:"GET",
                dataType:"json",
                success:function(data) {
                var d =$('select[name="subcategory_id"]').empty();
                $.each(data, function(key, value){

                $('select[name="subcategory_id"]').append('<option value="'+ value.id + '">' + value.subcategory_name + '</option>');

                });
                },
              });

            }else{
              alert('danger');
            }

              });
        });

   </script>
   <script type="text/javascript">
    function readURL(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#one')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <script type="text/javascript">
    function readURL2(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#two')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
  <script type="text/javascript">
    function readURL3(input){
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#three')
          .attr('src', e.target.result)
          .width(80)
          .height(80);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
      @endsection
