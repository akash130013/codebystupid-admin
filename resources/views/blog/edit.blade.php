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
                <div class="form-row p-1 mb-1">
                    <div class="form-group col-md-9">
                        <label for="inputTitle">Title <sup>*</sup> </label>
                        <input type="text" name="title" value="{{$blog->title ?? ''}}" class="form-control" id="inputTitle" placeholder="Enter Title" required>
                    </div>

                </div>

                <div class="form-row p-1 mb-1">
                    <div class="form-group col-md-9">
                        <label for="formControlTextarea">Enter Sort description <sup>*</sup></label>
                        <textarea class="form-control" name="short_desc" id="formControlTextarea" rows="7">{{$blog->short_desc ? trim($blog->short_desc) : ''}}</textarea>
                    </div>
                </div>

                <div class="form-row d-flex p-1 mb-1">
                    <div class="form-group col-md-5">
                        <label for="select-author">Author <sup>*</sup></label>
                        <select class="form-select" id="select-author" name="author_id" required>
                            <option value="">Select</option>
                            @foreach($authors as $value)
                            <option value="{{$value->id}}" @if($blog->author->id == $value->id) {{'selected'}} @endif>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="select-category">Category <sup>*</sup></label>
                        <select class="form-select" id="select-category" name="category_id" required>
                            <option value="">Select</option>
                            @foreach($category as $value)
                            <option value="{{$value->id}}" @if($blog->category->id == $value->id) {{'selected'}} @endif>{{$value->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="select-category">Category <sup>*</sup></label>
                        <select class="form-select" id="select-category" name="category_id" required>
                            <option value="">Select</option>
                            @foreach($category as $value)
                            <option value="{{$value->id}}" @if($blog->category->id == $value->id) {{'selected'}} @endif>{{$value->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> -->

                <div class="form-row d-flex p-1 mb-1">
                    <div class="form-group col-md-6">
                        <label for="thumbimg">Upload Thumbnail <sup>*</sup> </label><br>
                        <input type="file" name="thumb_img" accept="image/*" onchange="loadFile(event)">
                        <img id="output" class="preview-img" src="{{ asset('/images/'.$blog->thumb_img_url)}}" />
                    </div>

                    <div class="form-group col-md-3">
                        <label for="imgAltTag">Thumbnail alt tag <sup>*</sup> </label>
                        <input type="text" name="altTag" value="{{$blog->thumb_alt_tag ?? ''}}" class="form-control" id="imgAltTag" placeholder="Enter thumb img Alt Tag" required>
                    </div>
                </div>

                <div class="form-row p-1 mb-1">
                    <div class="form-group col-md-9" id="container">
                        <label for="formControlTextarea">Enter Long description <sup>*</sup></label>
                        <textarea name="long_desc" id="editor">
                        {!!  html_entity_decode($blog->long_desc) !!}
                        </textarea>
                    </div>
                </div>

                <div class="form-row d-flex p-1 mb-1">
                    <div class="form-group col-md-5">
                        <label for="select-duration">Duraion <sup>*</sup></label>
                        <select class="form-select" id="select-duration" name="duration" required>
                            <option value="">Select</option>
                            @foreach($duration as $value)
                            <option value="{{$value}}" @if($blog->duration == $value) {{'selected'}} @endif>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4 d-flex justify-content-end mt-3">
                        <input type="checkbox" name="is_enable" class="form-check-input" id="isEnable" @if($blog->is_enable == 1) {{'checked'}} @endif>
                        <label class="form-check-label" for="isEnable">Save as a draft</label>
                    </div>
                </div>

                <!-- <div class="form-row">
                    <div class="form-group col-md-9">
                        <input type="checkbox" name="is_enable" class="form-check-input" id="isEnable" @if($blog->is_enable == 1) {{'checked'}} @endif>
                        <label class="form-check-label" for="isEnable">Save as a draft</label>
                    </div>
                </div> -->

                <div class="d-flex justify-content-center justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary mx-auto">Submit</button>
                </div>
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