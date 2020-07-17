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
      <div class="sl-page-title">
        <h5>Category Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Brand Lists Lists
        <a href="" class="btn btn-sm btn-warning" style="float:right" data-toggle="modal" data-target="#modaldemo3">Add New</a></h6>

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Brand</th>
                <th class="wd-15p">Logo</th>
                <th class="wd-15p">Craeted_at</th>
                <th class="wd-15p">Updated_at</>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  @foreach($brands as $brand)

                <td>{{$brand->id}}</td>
                <td>{{$brand->brand_name}}</td>
                <td><img height="50" src="{{url('/images/'.$brand->brand_logo)}}" /></td>
                <td>{{$brand->created_at?$brand->created_at->diffForHumans():'null'}}</td>
         <td>{{$brand->updated_at?$brand->updated_at->diffForHumans():'null'}}</td>
                         <td><a href="{{ URL::to('edit/brand/'.$brand->id) }}" class="btn btn-sm btn-info">Edit</a>|<a href="{{ URL::to('delete/brand/'.$brand->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a></td>

              </tr>
              @endforeach
                          </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->
 </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->
   <!-- LARGE MODAL -->
   <div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content tx-size-sm">
        <div class="modal-header pd-x-20">
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Brand</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('store.brand') }}" enctype="multipart/form-data">
            @csrf
        <div class="modal-body pd-20">

            <div class="form-group">
              <label for="exampleInputEmail1">Brand</label>
              <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Brand name" name="brand_name">
              {{-- @foreach($errors->get('category_name') as $error)
              <span class="help-block">{{ $error }}</span>
            @endforeach --}}
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Logo</label>
                <input type="file" class="form-control" aria-describedby="emailHelp" placeholder="Brand logo" name="brand_logo">
            </div>
        </div><!-- modal-body -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-info pd-x-20">Submit</button>
          <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div><!-- modal-dialog -->
  </div><!-- modal -->
@endsection
