@extends('layouts.books')


@section('content')


<div class="container">

  <hr>
  {{menu('Test')}}
  <table class="table table-striped">
    <thead>
      <th>Автор</th>
    </thead>
    <tbody>
      @forelse($authors as $author)
      <tr>
        <td>{{$author->name}}</td>
      </tr>
      @empty
      @endforelse

    </tbody>
    <tfoot>
      <tr>
        <td colspan="3">
          <ul class="pagination pull-right">
           
          </ul>
        </td>
      </tr>
    </tfoot>

  </table>
    <form class="form" action="{{route('book/author.add')}}" method="post">
      {{ csrf_field() }}
      <input type="text" class="form-control" name="name" placeholder="Автор">
      <input class="btn btn-primary" type="submit" name="submit" value="Добавить автора">
    </form>

</div>

@endsection

