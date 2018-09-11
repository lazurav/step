@extends('layouts.books')

@section('content')

<div class="container">

  <hr>
  <table class="table table-striped">
    <thead>
      <th><?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('title')?>&#9650;</a>Название<?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('title','DESC')?>&#9660;</a></th>
      <th><?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('price')?>&#9650;</a>Цена<?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('price','DESC')?>&#9660;</a></th>
      <th><?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('pages')?>&#9650;</a>Страниц<?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('pages','DESC')?>&#9660;</a></th>
      <th><?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('year')?>&#9650;</a>Год<?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('year','DESC')?>&#9660;</a></th>
      <th>Язык</th>
      <th>Статус</th>
      <th><?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('authorname')?>&#9650;</a>Автор<?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('authorname','DESC')?>&#9660;</a></th>
      <th><?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('janrename')?>&#9650;</a>Жанр<?=App\Http\Controllers\adminus\book\controllerBook::sortOrder('janrename','DESC')?>&#9660;</a></th>
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
@section('columnLeft')

<form id="filter" action="{{route('book/books.filter')}}" method="post">
                {{ csrf_field() }} 
                <h2>Author</h2>                          
               @foreach($authorNames as $authorName)
                  <input type="checkbox" name="author_id[]" value="{{$authorName->id}}" id="{{$authorName->id}}" 
                  <?php if (isset($aids)) {
                    foreach ($aids as $aid) {
                      if ($aid == $authorName->id) {
                        echo 'checked';
                      }
                    }
                  } ?>
                  /> <label for="{{$authorName->id}}">{{$authorName->name}}</label><br />
               
              @endforeach
              <h2>Janri</h2>
              @foreach($janreNames as $janreName)
                  <input type="checkbox" name="janre_id[]" value="{{$janreName->id}}" id="janre[{{$janreName->id}}]" 
                  <?php if (isset($jids)) {
                    foreach ($jids as $jid) {
                      if ($jid == $janreName->id) {
                        echo 'checked';
                      }
                    }
                  } ?>
                  /> <label for="janre[{{$janreName->id}}]">{{$janreName->name}}</label><br />
               
              @endforeach
              <input class="btn btn-success" type="submit" value="Submit" />                  
</form>
<form method="post">
   {{ csrf_field() }} 
    <input class="btn btn-danger" type="submit" name="reset" value="Reset">
</form>


@endsection

