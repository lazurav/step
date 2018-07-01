@extends('layouts.books')


@section('content')

<div class="container">

  <hr>
  {{menu('Test')}}
  <table class="table table-striped">
    <thead>
      <th>Название</th>
      <th>Цена</th>
      <th>Страниц</th>
      <th>Год</th>
      <th>Язык</th>
      <th>Статус</th>
      <th>Автор</th>
      <th>Жанр</th>
    </thead>
    <tbody>
      @forelse($books as $book)
      <tr>
        <td>{{$book->title}}</td>
        <td>{{$book->price}}</td>
        <td>{{$book->pages}}</td>
        <td>{{$book->year}}</td>
        <td>{{$book->lang}}</td>
        <td>{{$book->status}}</td>
        <td>@foreach($book->author as $author){{$author->name}}<br />@endforeach</td>
        <td>@foreach($book->janre as $janre){{$janre->name}}<br />@endforeach</td>
        <td><!--{{$book->id}}-->
         
            <form id="delete" action="{{route('book/book.delete')}}" method="post">
             {{ csrf_field() }}
             <input type="text" hidden class="form-control" name="id" value="{{$book->id}}" />
             <input class="btn btn-danger" type="submit" value="-" />
            </form>
        </td>


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

         <form id="add" action="{{route('book/book.add')}}" method="post">
                {{ csrf_field() }}                           
              <input type="text" class="form-control" name="title" placeholder="Название" required />
              <Label for="author">Авторы: </Label><br /><select multiple id="author" name="author[]">
                @foreach($authorNames as $authorName)
                  <option value="{{$authorName->id}}"> {{$authorName->name}} </option>
                @endforeach
              </select>
              <br/>
               <Label for="janre">Жанры: </Label><br /><select multiple id="janre" name="janre[]">
                @foreach($janreNames as $janreName)
                  <option value="{{$janreName->id}}"> {{$janreName->name}} </option>
                @endforeach
              </select>
              <br />
               <Label for="lang">Язык книги </Label><br /><select id="lang" name="lang">
                <option selected value="UA">UA</option>
                <option value="RU">RU</option>
                <option value="ENG">ENG</option>
              </select>
              <br />
              <input type="text" class="form-control" name="price" placeholder="Цена" required />
              <input type="text" class="form-control" name="pages" placeholder="Количество страниц" required />
              <input type="text" class="form-control" name="year" placeholder="Год выпуска" required />
              <input class="btn btn-success" type="submit" value="Добавить книгу" />                     
         </form>
</div>

@endsection

