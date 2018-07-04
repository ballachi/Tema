
@extends('layouts.app')
@extends('layouts.navbar')

@section('content')
@if(count($todo) > 0)
@include('errors')
<!-- se vor afisa toate todo-urile si va permite filtrarea dupa data sau taguri -->
<form action="{{url('/find')}}" method="GET">
    <!-- se va alege data -->
    <div>data inceput </div>
    <input type="date"  name="startdata" value= "2000-12-17">
    <div>data sfarsit </div>
    <input type="date" name="enddata" value= "2020-12-17">
    <div class="container" style="width:600px;">
        <div class="form-group">
            <!-- se selecteaza tagurile -->
            <label>Selecteaza taguri</label>
            <select id="framework" name="taguri[]" multiple class="form-control" >
                @if($tags->count() > 0)
                    @foreach($tags as $tag)
                        <option value="{{$tag->name}}">{{$tag->name}}</option>
                    @endForeach
                @else
                    No Record Found
                @endif
            </select>
        </div>
        <br />
    </div>
    <button class="btn btn-danger">
        cauta
    </button>
​</form>
<!-- afisarea todo-urilor -->
<div class="card">
    <div class="card-body">
        <table class="table table-striped tags-table">
            <thead>
            <th>Todo</th>
            <th>&nbsp;</th>
            </thead>
            @foreach($todo as $t)
                <tbody>
                    <td class="table-text">
                        <div>Todo: {{$t->todo}}</div>
                        @if($t->path != "null")
                            <img src="/images/{{ $t->path }}" width="300" />
                        @endif

                        @if(($t->tags != "N;"))
                            <div>Tag: 
                                @foreach( (unserialize($t->tags)) as $tag)
                                     {{$tag}}
                                @endforeach
                            <div>
                        @endif
                    </td>
                </tbody>
            @endforeach
    </div>
</div>

@else
    <h3>Nu exista</h3>
@endif
@stop


