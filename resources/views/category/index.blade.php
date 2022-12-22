@extends('layouts.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row justify-content-center">

  <h2>Category!!</h2>

  <div class="row">

    <form method="GET">
      <div class="d-flex justify-content-center">
        <!-- <div class="col-md-6 d-flex">
          <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
          <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
        </div> -->

        <div class="col-md-6 mx-auto">
          <div class="small fw-light">search...</div>
          <div class="input-group">
            <input placeholder="Search by title..." class="form-control border-end-0 border rounded-pill" type="search" value="{{ request()->get('search') }}" name="search">
            <span class="input-group-append">
              <button type="submit" class="btn btn-outline-secondary bg-white border-bottom-0 border rounded-pill ms-n5" type="button">
                <i class="fa fa-search"></i>
              </button>
            </span>
          </div>
        </div>

        <div class="col-md-6 d-flex justify-content-end">
          <a href="{{ route('category.create') }}" class="btn btn-primary">Add+</a>
        </div>

      </div>

    </form>


  </div>


  <div class="p-4">
    <table class="table table-responsive">
      <thead>
        <tr>
          <th scope="col">Sr. No</th>
          <th scope="col">Title</th>
          <th scope="col">Created At</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        @forelse($categories as $key => $category)

        <tr class="@if($category->status == 2)inactive @endif">
          <td>{{$categories->firstItem() + $key}}</td>
          <td>{{$category->title}}</td>
          <td>{{$category->created_at}}</td>
          <td>{{$category->status=='1' ? 'Active': 'Inactive'}}</td>
          <td>
            <ul class="list">
              <li class="list-item">
                <a href="{{route('category.edit',['id' => $category->id])}}">
                  <i class="fas fa-edit"></i>
                </a>
              </li>
              <li class="list-item" onclick="handleClick(msg.delete_title,msg.delete_text,msg.delete_icon,'{{$category->id}}','category', 3)"><i class="fas fa-trash"></i></li>
              @if($category->status=='1')
              <li class="list-item" onclick="handleClick(msg.block_title,msg.block_text,msg.delete_icon,'{{$category->id}}','category', 0)">
                <i class="fas fa-unlock"></i>
              </li>
              @else
              <li class="list-item" onclick="handleClick(msg.unblock_title,msg.unblock_text,msg.delete_icon,'{{$category->id}}','category', 1)">
                <i class="fa fa-ban" aria-hidden="true"></i>
              </li>
              @endif

            </ul>

          </td>
        </tr>
        @empty
        <tr>
          <td>
            <p>No record found.</p>
          </td>
        </tr>
        @endforelse

      </tbody>
    </table>


    {!! $categories->links() !!}

  </div>

</div>
<input type="hidden" id="actionUrl" value="{{route('change-status')}}">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="{{asset('js/common.js')}}"></script>
@endsection