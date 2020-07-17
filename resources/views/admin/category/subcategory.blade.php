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
        <h5>Subcategory Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Subcategory Lists
        <a href="" class="btn btn-sm btn-warning" style="float:right" data-toggle="modal" data-target="#modaldemo3">Add New</a></h6>

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Subcategory</th>
                <th class="wd-15p">category</th>
                <th class="wd-15p">Craeted_at</th>
                <th class="wd-15p">Updated_at</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  @foreach($subcategories as $subcategory)

                <td>{{$subcategory->id}}</td>
                <td>{{$subcategory->subcategory_name}}</td>
                 <td>{{$subcategory->category->category_name}}</td>
                <td>{{$subcategory->created_at?$subcategory->created_at->diffForHumans():'null'}}</td>
         <td>{{$subcategory->updated_at?$subcategory->updated_at->diffForHumans():'null'}}</td>
                <td><a href="{{ URL::to('edit/subcategory/'.$subcategory->id) }}" class="btn btn-sm btn-info">Edit</a>|<a href="{{ URL::to('delete/subcategory/'.$subcategory->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a></td>
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
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Subcategory</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('store.subcategory') }}">
            @csrf
        <div class="modal-body pd-20">

            <div class="form-group">
              <label for="exampleInputEmail1">Subcategory</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="subcategory" name="subcategory_name">

            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">category Name</label>
<select class="form-control" name="category_id">
    <option>Select Category</option>
@foreach($categories as $category)
<option value="{{$category->id}}">{{ $category->category_name }}</option>
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
    </div><!-- modal-dialog -->
  </div><!-- modal -->
@endsection

