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

        <div class="blog-form">

            <form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data">
                @csrf
                <h2>Create Category</h2>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="inputTitle">Title <sup>*</sup> </label>
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Enter Title" required>

                    </div>
                    <div class="form-group col-md-9">
                        <label for="formControlTextarea">Enter Sort description <sup>*</sup></label>
                        <textarea class="form-control" name="comment" id="formControlTextarea" rows="7"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="thumbimg">Upload Thumbnail </label><br>
                        <input type="file" accept="image/*" onchange="loadFile(event)" name="thumb_img">
                        <img id="output" class="preview-img" />

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <input type="hidden" id="imageUpload" value="{{route('image.upload')}}" />
        </div>
    </div>

    <!-- </div> -->
</main>
@endsection
@section('js')

@endsection