@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">

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
        <h6 class="card-body-title">Edit Blog

        <div class="table-wrapper">
            <form method="POST" action="{{url('update/blog/'.$blog->id)}}">
                @csrf
            <div class="modal-body pd-20">

                <div class="form-group">
                  <label for="exampleInputEmail1">Category(english)</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $blog->category_name_en }}" name="category_name_en">
                  {{-- @foreach($errors->get('category_name') as $error)
                  <span class="help-block">{{ $error }}</span>
                @endforeach --}}
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category(Hindi)</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $blog->category_name_in }}" name="category_name_in">
                    {{-- @foreach($errors->get('category_name') as $error)
                    <span class="help-block">{{ $error }}</span>
                  @endforeach --}}
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
