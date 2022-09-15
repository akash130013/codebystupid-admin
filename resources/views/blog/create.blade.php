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

            <form method="post" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                @csrf
                <h2>Create Blog</h2>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="inputTitle">Title <sup>*</sup> </label>
                        <input type="text" name="title" class="form-control" id="inputTitle" placeholder="Enter Title" required>

                    </div>
                    <div class="form-group col-md-9">
                        <label for="formControlTextarea">Enter Sort description <sup>*</sup></label>
                        <textarea class="form-control" name="short_desc" id="formControlTextarea" rows="7"></textarea>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="select-author">Author <sup>*</sup></label>
                        <select class="form-select" id="select-author" name="author_id" required>
                            <option value="">Select</option>
                            @foreach($authors as $value)
                            <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-9">
                        <input type="checkbox" name="is_enable" class="form-check-input" id="isEnable">
                        <label class="form-check-label" for="isEnable">Enable</label>
                    </div>


                </div>

                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="thumbimg">Upload Thumbnail <sup>*</sup> </label><br>
                        <input type="file" accept="image/*" onchange="loadFile(event)" name="thumb_img">
                        <img id="output" class="preview-img" />

                    </div>
                </div>



                <div class="form-row">

                    <div class="form-group col-md-9" id="container">
                        <label for="formControlTextarea">Enter Long description <sup>*</sup></label>
                        <textarea name="long_desc" id="editor"></textarea>
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
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/super-build/ckeditor.js"></script>
<script src="{{URL::asset('js/ckeditor.js')}}"></script>
@endsection