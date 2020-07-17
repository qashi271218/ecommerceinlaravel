@extends('layouts.app')
@section('content')
@include('layouts.menubar')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/blog_single_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/blog_single_responsive.css') }}">

<!-- Single Blog Post -->

<div class="single_post">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="single_post_quote text-center">
                    <div class="quote_image"><img src={{ url('public/images/post/'.$post->post_image) }} alt=""></div>
                </div>
                <div class="single_post_title">
                    @if(Session()->get('lang')=='hindi')
                            {{$post->post_title_in}}

                                @else
                                {{$post->post_title_en}}

                            @endif
                </div>
                <div class="single_post_text">
                    @if(Session()->get('lang')=='hindi')
                   <p> {{$post->details_in}}</p>

                        @else
                        <p>{{$post->details_en}}</p>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('public/frontend/js/blog_single_custom.js') }}"></script>
@endsection
