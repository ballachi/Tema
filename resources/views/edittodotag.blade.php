
@extends('layouts.app')
@extends('layouts.navbar')
@section('content')
<!-- se va afisa todul care a fost selectat pentru modificare -->
    <tbody>
    <td class="table-text">
        <div>{{$todo->todo}}</div>
        <img src="/images/{{ $todo->path }}" width="300" />
        <!-- Verific daca exista taguri -->
        @if(($todo->tags != "N;"))
            <!-- unserialize  tag-urile si le afisez -->
            @foreach( (unserialize($todo->tags)) as $tag)
                 <div>{{$tag}}
            @endforeach
        @endif
        <!-- folosesc un drop-down list care va bifa toate tagurile existente si va permite  bifarea tagurilor noi sau stergerea-->
        <form action="{{url('/edittag2')}}" method="GET">
            <input type="hidden" id="todoId" name="todoId" value="{{$todo->id}}">
            <div class="container" style="width:600px;">
                <div class="form-group">
                 <label>Modifica taguri</label>
                 <select id="framework" name="taguri[]" multiple class="form-control" >
                    <!-- daca sunt taguri -->
                        @if($tags->count() > 0)
                        <!-- parcurg tagurile -->
                        @foreach($tags as $tag)
                                <!-- daca nu exista tag nu il bifam -->
                                @if( ($todo->tags === "N;"))
                                    <option value="{{$tag->name}}">{{$tag->name}}</option>
                                @else
                                    <!-- daca exista tagul il selectam -->
                                    @if( array_search($tag->name, unserialize($todo->tags)) > 0 
                                    || array_search($tag->name, unserialize($todo->tags)) === 0 )
                                        <option value="{{$tag->name}}" selected>{{$tag->name}}</option>
                                    @else
                                        <option value="{{$tag->name}}">{{$tag->name}}</option>
                                    @endif 
                                @endif 
                        @endForeach
                    @else
                     No Record Found
                    @endif 
                 </select>
                </div>
               <br />
              </div>
            <button class="btn btn-danger">
                edit todo
            </button>
        </form>
    </td>
</tbody>

@stop
