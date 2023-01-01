@extends('layouts.app')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row justify-content-center">

  <h2>Blog!!</h2>

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
          <a href="{{ route('blogs.create') }}" class="btn btn-primary">Add+</a>
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
          <th scope="col">Author</th>
          <th scope="col">Category</th>
          <th scope="col">Published</th>
          <th scope="col">Created At</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        @forelse($blogs as $key => $blog)

        <tr class="@if($blog->status == 0)inactive @endif">
          <td>{{$blogs->firstItem() + $key}}</td>
          <td>{{$blog->title}}</td>
          <td>{{$blog->author->name ?? 'NA'}}</td>
          <td>{{$blog->category->title ?? 'NA'}}</td>
          <td>{{$blog->is_enable ? "Yes" : "No"}}</td>
          <td>{{$blog->created_at}}</td>
          <td>{{$blog->status=='1' ? 'Active': 'Inactive'}}</td>
          <td>
            <ul class="list">
              <li class="list-item">
                <a href="{{route('blogs.edit',['id' => $blog->id])}}">
                  <i class="fas fa-edit"></i>
                </a>
              </li>
              <li class="list-item" onclick="handleClick(msg.delete_title,msg.delete_text,msg.delete_icon,'{{$blog->id}}','blog', '{{DELETED}}')"><i class="fas fa-trash"></i></li>
              @if($blog->status==ACTIVE)
              <li class="list-item" onclick="handleClick(msg.block_title,msg.block_text,msg.delete_icon,'{{$blog->id}}','blog', '{{INACTIVE}}')">
                <i class="fas fa-unlock"></i>
              </li>
              @else
              <li class="list-item" onclick="handleClick(msg.unblock_title,msg.unblock_text,msg.delete_icon,'{{$blog->id}}','blog', '{{ACTIVE}}')">
                <i class="fa fa-ban" aria-hidden="true"></i>
              </li>
              @endif
            </ul>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5">
            <p>No record found.</p>
          </td>
        </tr>
        @endforelse

      </tbody>
    </table>
    {!! $blogs->links() !!}
  </div>

</div>
<input type="hidden" id="actionUrl" value="{{route('change-status')}}">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="{{asset('js/common.js')}}"></script>
@endsection