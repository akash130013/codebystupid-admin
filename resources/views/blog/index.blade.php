@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

  <h2>Blog!!</h2>

  <div class="row">

    <div class="col-md-6">
      <!-- <label for="searchFormControlInput1" class="form-label">Search</label> -->
      <input type="search" class="form-control" id="searchFormControlInput1" placeholder="Search...">
    </div>

    <div class="col-md-6">
      <a href="{{ route('blogs.create') }}" class="btn btn-primary">Add+</a>
    </div>

  </div>


  <div class="p-4">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td colspan="2">Larry the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>
  </div>


</div>

@endsection