@extends('layouts.app')

@section('css')
<style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }

    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }

    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>
@endsection

@section('content')

<main>
    <div class="row justify-content-center">


        @if(Session::has('success'))
        <div class="alert alert-success">
            <h1>This is a test data</h1>
            {{Session::get('success')}}
        </div>
        @endif


        <div class="blog-form">

            <form method="post" action="{{ route('author.store') }}">
                @csrf
                <h2>Create Author</h2>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="inputTitle">Name <sup>*</sup> </label>
                        <input type="text" name="name" class="form-control" id="inputTitle" placeholder="Enter Name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-9">
                        <input type="checkbox" name="is_enable" class="form-check-input" id="isEnable">
                        <label class="form-check-label" for="isEnable">Is Active</label>
                    </div>


                </div>

                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="thumbimg">Upload Profile </label><br>
                        <input type="file" accept="image/*" onchange="loadFile(event)">
                        <img id="output" class="preview-img" />

                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- </div> -->
</main>
@endsection
@section('js')

@endsection