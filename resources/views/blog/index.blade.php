@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

  <h2>Blog!!</h2>

  <div class="row">

    <form method="GET">
      <div class="d-flex justify-content-center">
        <div class="col-md-6 d-flex">
          <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
          <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
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
          <th scope="col">Published</th>
          <th scope="col">Created At</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach($blogs as $key => $blog)

        <tr>
          <td>{{$blogs->firstItem() + $key}}</td>
          <td>{{$blog->title}}</td>
          <td>----</td>
          <td>{{$blog->is_enable ? "Yes" : "No"}}</td>
          <td>{{$blog->created_at}}</td>
          <td>
            <ul class="list">
              <li class="list-item">
                <a href="{{route('blogs.edit',['id' => $blog->id])}}">
                  <i class="fas fa-edit"></i>
                </a>
              </li>
              <li class="list-item"><i class="fas fa-trash"></i></li>
              <li class="list-item"><i class="fas fa-ban"></i></li>
            </ul>

          </td>
        </tr>

        @endforeach

      </tbody>
    </table>


    {!! $blogs->links() !!}


  </div>

</div>

@endsection