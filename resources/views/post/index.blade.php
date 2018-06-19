@extends('layouts.post')

 @section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Post</div>

                <div class="card-body">

                       Работа с постами                 

                        @foreach ($posts as $post)
                        <p> {{ $post->title }} </p>
                        @endforeach
                        

                </div>
            </div>
        </div>

    </div>
</div>
@endsection

