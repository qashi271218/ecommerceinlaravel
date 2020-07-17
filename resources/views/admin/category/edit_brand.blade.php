@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">
    {{-- <img height="100" src="{{url('/images/'.$brand->brand_logo)}}" /> --}}

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
        <h6 class="card-body-title">Edit Brand

        <div class="table-wrapper">
            <form method="POST" action="{{url('update/brand/'.$brand->id)}}" enctype="multipart/form-data">
                @csrf
            <div class="modal-body pd-20">

                <div class="form-group">
                  <label for="exampleInputEmail1">Brand</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $brand->brand_name }}" name="brand_name">
                  {{-- @foreach($errors->get('category_name') as $error)
                  <span class="help-block">{{ $error }}</span>
                @endforeach --}}
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Photo</label>
                    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="brand_logo">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Current photo</label>
                    <img height="100" src="{{url('/images/'.$brand->brand_logo)}}" />
                    <input type="hidden" name="old_logo" value="{{ $brand->brand_logo }}">
                </div>

            </div><!-- modal-body -->
            <div class="modal-footer">
              <button type="submit" class="btn btn-info pd-x-20">Update</button>
            </div>
          </form>
        </div><!-- table-wrapper -->
      </div><!-- card -->
 </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->
   <!-- LARGE MODAL -->

@endsection
