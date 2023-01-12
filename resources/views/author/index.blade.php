@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <h2>Author!!</h2>

    <div class="row">

        <form method="GET">
            <div class="d-flex justify-content-center">
                <div class="col-md-6 d-flex">
                    <input type="text" name="search" value="{{ request()->get('search') }}" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="button-addon2">
                    <button class="btn btn-success" type="submit" id="button-addon2">Search</button>
                </div>

                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ route('author.create') }}" class="btn btn-primary">Add+</a>
                </div>

            </div>

        </form>

    </div>


    <div class="p-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sr. No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>

                @forelse($authors as $key => $author)

                <tr class="@if($author->is_active == 0)inactive @endif">
                    <td>{{$authors->firstItem() + $key}}</td>
                    <td>{{$author->name}}</td>
                    <td>{{$author->created_at}}</td>
                    <td>{{$author->is_active ? "Active" : "Inactive"}}</td>
                    <td>
                        <ul class="list">
                            <li class="list-item">
                                <a href="{{route('author.edit',['id' => $author->id])}}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </li>
                            <li class="list-item" onclick="handleClick(msg.delete_title,msg.delete_text,msg.delete_icon,'{{$author->id}}','author', '{{DELETED}}')"><i class="fas fa-trash"></i></li>
                            @if($author->is_active==ACTIVE)
                            <li class="list-item" onclick="handleClick(msg.block_title,msg.block_text,msg.delete_icon,'{{$author->id}}','author', '{{INACTIVE}}')">
                                <i class="fas fa-unlock"></i>
                            </li>
                            @else
                            <li class="list-item" onclick="handleClick(msg.unblock_title,msg.unblock_text,msg.delete_icon,'{{$author->id}}','author', '{{ACTIVE}}')">
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            </li>
                            @endif

                        </ul>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="3">
                        <p>No record found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $authors->links() }}
    </div>
    <input type="hidden" id="actionUrl" value="{{route('change-status')}}">
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="{{asset('js/common.js')}}"></script>
@endsection