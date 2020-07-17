@extends('admin.admin_layouts')

@section('admin_content')
<div class="sl-mainpanel">



    <div class="sl-pagebody">
      <div class="sl-page-title">
        <h5>Product Table</h5>
      </div><!-- sl-page-title -->

      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">Product Lists
        <a href="{{ route('add.product') }}" class="btn btn-sm btn-warning" style="float:right">Add New</a></h6>

        <div class="table-wrapper">
          <table id="datatable1" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">ID</th>
                <th class="wd-15p">Name</th>
                <th class="wd-15p">product code</th>
                <th class="wd-15p">Image</th>
                <th class="wd-15p">Category</th>
                <th class="wd-15p">Subcategory</th>
                <th class="wd-15p">Brand</th>
                <th class="wd-15p">Status</th>
                <th class="wd-20p">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                  @foreach($products as $product)

                <td>{{$product->id}}</td>
                <td>{{$product->product_name}}</td>
                <td>{{$product->product_code}}</td>
                <td><img height="50" src="{{url('public//images/product/'.$product->image_one)}}" /></td>
                <td>{{$product->category->category_name}}</>
                <td>{{$product->subcategory->subcategory_name}}</td>
                <td>{{$product->brand->brand_name}}</td>
                <td>
                @if($product->status==1)
         	    <form action="{{route('product.status.update',$product->id)}}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="POST">
    <input type="hidden" name="is_active" value="0">
    <input type="submit"class="btn btn-success" value="Unapprove">
  </form>
  @else
         	    <form action="{{route('product.status.update',$product->id)}}" method="POST">
    @csrf
    <input type="hidden" name="_method" value="POST">
    <input type="hidden" name="is_active" value="1">
    <input type="submit"class="btn btn-primary" value="Approve">
  </form>
         	@endif
         </td>
         <td><a href="{{ URL::to('view/product/'.$product->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>|<a href="{{ URL::to('edit/product/'.$product->id) }}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>|<a href="{{ URL::to('delete/product/'.$product->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></a></td>

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
