@extends('layouts.book')

 @section('content')
<div class="container">
    <div class="row justify-content-center">
       
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Наша книга</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        Наша книга
                    @foreach ($book as $boo)
                       <p>{{ $boo->title }}</p>
                          @endforeach

                       
                        

                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('columnLeft')   
    <h3>leftColumn</h3>
@endsection


