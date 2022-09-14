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

            <form enctype="multipart/form-data" method="post" action="{{ route('blogs.update',['id' => $blog->id]) }}">
                @csrf
                <h2>Create Blog</h2>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="inputTitle">Title <sup>*</sup> </label>
                        <input type="text" name="title" value="{{$blog->title ?? ''}}" class="form-control" id="inputTitle" placeholder="Enter Title" required>

                    </div>
                    <div class="form-group col-md-9">
                        <label for="formControlTextarea">Enter Sort description <sup>*</sup></label>
                        <textarea class="form-control" name="short_desc" id="formControlTextarea" rows="7">{{$blog->short_desc ? trim($blog->short_desc) : ''}}</textarea>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="select-author">Author <sup>*</sup></label>
                        <select class="form-select" id="select-author" name="author_id" required>
                            <option value="">Select</option>
                            @foreach($authors as $value)
                            <option value="{{$value->id}}" @if($blog->author->id == $value->id) {{'selected'}} @endif>{{$value->name}}</option>
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
                        <input type="file" name="thumb_img" accept="image/*" onchange="loadFile(event)">
                        <img id="output" class="preview-img" src="{{ asset('/images/'.$blog->thumb_img_url)}}" />

                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col-md-9" id="container">
                        <label for="formControlTextarea">Enter Long description <sup>*</sup></label>
                        <textarea name="long_desc" id="editor">
                        {!!  html_entity_decode($blog->long_desc) !!}
                        </textarea>
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