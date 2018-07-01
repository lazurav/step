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
      @forelse($janres as $janre)
      <tr>
        <td>{{$janre->name}}</td>
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
    <form class="form" action="{{route('book/janre.add')}}" method="post">
      {{ csrf_field() }}
      <input type="text" class="form-control" name="name" placeholder="Жанр">
      <input class="btn btn-primary" type="submit" name="submit" value="Добавить жанр">
    </form>

</div>

@endsection

