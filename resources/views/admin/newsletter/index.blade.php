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
        <h5>Subscribers</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Subscriber Lists
        <a href="" class="btn btn-sm btn-warning" style="float:right" data-toggle="modal" data-target="#modaldemo3">Add New</a></h6>

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Eamil</th>
                <th class="wd-15p">Craeted_at</th>
                <th class="wd-15p">Updated_at</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  @foreach($newsletters as $newsletter)

                <td>{{$newsletter->id}}</td>
                <td>{{$newsletter->email}}</td>
                <td>{{$newsletter->created_at?$newsletter->created_at->diffForHumans():'null'}}</td>
         <td>{{$newsletter->updated_at?$newsletter->updated_at->diffForHumans():'null'}}</td>
                <td><a href="{{ URL::to('delete/newsletter/'.$newsletter->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</></td>
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
          <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Category</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('store.category') }}">
            @csrf
        <div class="modal-body pd-20">

            <div class="form-group">
              <label for="exampleInputEmail1">Category</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="category" name="category_name">
              {{-- @foreach($errors->get('category_name') as $error)
              <span class="help-block">{{ $error }}</span>
            @endforeach --}}
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

