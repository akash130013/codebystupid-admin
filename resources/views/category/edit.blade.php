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

            <form enctype="multipart/form-data" method="post" action="{{ route('category.update',['id' => $category->id]) }}">
                @csrf
                <h2>Edit !!</h2>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="inputTitle">Title <sup>*</sup> </label>
                        <input type="text" name="title" value="{{$category->title ?? ''}}" class="form-control" id="inputTitle" placeholder="Enter Title" required>
                    </div>
                    <div class="form-group col-md-9">
                        <label for="formControlTextarea">Enter Sort description <sup>*</sup></label>
                        <textarea class="form-control" name="comment" id="formControlTextarea" rows="7">{{$category->comment_desc ? trim($category->comment_desc) : ''}}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="thumbimg">Upload Thumbnail <sup>*</sup> </label><br>
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
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/super-build/ckeditor.js"></script>
<script src="{{URL::asset('js/ckeditor.js')}}"></script>
@endsection