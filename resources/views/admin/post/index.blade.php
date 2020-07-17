@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">



    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Post Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Post List
        <a href="{{ route('add.post') }}" class="btn btn-sm btn-warning" style="float:right">Add New</a></h6>

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
                <tr>
                    <th class="wd-15p">ID</th>
                    <th class="wd-15p">Category</th>
                    <th class="wd-15p">Post_title_en</th>
                    <th class="wd-15p">Post_title_in</th>
                    <th class="wd-15p">Image</th>
                    <th class="wd-15p">Details_en</th>
                    <th class="wd-15p">Details_in</th>
                    <th class="wd-20p">Action</th>
                  </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($posts as $post)

                  <td>{{$post->id}}</td>
                  <td>{{$post->postcategory->category_name_en}}</td>
                   <td>{{$post->post_title_en}}</td>
                   <td>{{$post->post_title_in}}</td>
                  <td><img height="50" src="{{url('public//images/post/'.$post->post_image)}}" /></td>
                <td>{{$post->details_en}}</>
                  <td>{{$post->details_in}}</td>
                  <td><a href="{{ URL::to('edit/post/'.$post->id) }}" class="btn btn-sm btn-info">Edit</a>|<a href="{{ URL::to('delete/post/'.$post->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a></td>
                </tr>
                @endforeach



          </tbody>
          </table>
        </div><!-- table-wrapper -->
      </div><!-- card -->
 </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->
   <!-- LARGE MODAL -->
@endsection
