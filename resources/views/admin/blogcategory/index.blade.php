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
        <h6 class="card-body-title">Blog category list
        <a href="" class="btn btn-sm btn-warning" style="float:right" data-toggle="modal" data-target="#modaldemo3">Add New</a></h6>

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Category_name(english)</th>
                <th class="wd-15p">Category_name(hindi)</th>
                <th class="wd-15p">Craeted_at</th>
                <th class="wd-15p">Updated_at</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  @foreach($postcategory as $post)

                <td>{{$post->id}}</td>
                <td>{{$post->category_name_en}}</td>
                <td>{{$post->category_name_in}}</td>
                <td>{{$post->created_at?$post->created_at->diffForHumans():'null'}}</td>
         <td>{{$post->updated_at?$post->updated_at->diffForHumans():'null'}}</td>
                <td><a href="{{ URL::to('edit/blog/'.$post->id) }}" class="btn btn-sm btn-info">Edit</a>|<a href="{{ URL::to('delete/blog/'.$post->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a></td>
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
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Blogcategory</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="{{ route('store.blogcategory') }}">
            @csrf
             <div class="modal-body pd-20">
            <div class="form-group">
              <label for="exampleInputEmail1">Category Name English</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category Name English" name="category_name_en">

            </div>

             <div class="form-group">
              <label for="exampleInputEmail1">Category Name Hindi</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category Name Hindi" name="category_name_in">

            </div>

                  </div><!-- modal-body -->
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Sumbit</button>
                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
                  </div>
                    </form>
      </div>
    </div><!-- modal-dialog -->
  </div><!-- modal -->
@endsection
