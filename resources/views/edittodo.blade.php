@extends('layouts.app')
@extends('layouts.navbar')

<!-- se vor afisa toate todo-urile si va avea posibilitatea de a selecta tudo-ul care doreste sa il modifice-->
@if(count($todo) > 0)
        <div class="card">
            <div class="card-body">
                <table class="table table-striped tags-table">
                    <thead>
                    </thead>
                        
                        @foreach($todo as $t)
                        <tbody>
                            <td class="table-text">
                                <div>Todo: {{$t->todo}}</div>
                                <!-- daca exista imagine -->
                                 @if($t->path != "null")
                                    <img src="/images/{{ $t->path }}" width="300" />
                                @endif
                                <!-- daca exista taguri -->
                                @if(($t->tags != "N;"))
                                    <div> Tag: 
                                        @foreach( (unserialize($t->tags)) as $tag)
                                            {{$tag}}
                                        @endforeach
                                    </div>
                                @endif
                                <!-- butonul pentru modificare -->
                                <form action="{{url('/edittag')}}" method="GET">
                                    <input type="hidden" id="todoId" name="todoId" value="{{$t->id}}">
                                    <button class="btn btn-danger">
                                        edit todo
                                    </button>
                                </form>
                            </td>
                            </tbody>
                        @endforeach
            </div>
        </div>
    @endif