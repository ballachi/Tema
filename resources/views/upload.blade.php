@extends('layouts.app')
@extends('layouts.navbar')
@section('content')

<!-- se va adauga un todo nou -->
<div class="container">
	<h3 align="center"> Add todo </h3>
	<br />
	@include('errors')

<!-- Se adauga textul pentru todo -->
	<form method="post" action="{{url('/uploadfile')}}" enctype="multipart/form-data">
		{{ csrf_field() }}

		<div class="row">
			<div class="form-group">
				<label for="Todo" class="col-sm-3 control-label">Todo</label>

				<div class="row">
					<div class="col-sm-6">
						<input type="text" name="todo" id="todo-name" class="form-control">
					</div>
				</div>
			</div>
		</div>
<!-- se adauga tagurile -->
		<div class="container" style="width:600px;">
		    <div class="form-group">
		    	<label>Adauga taguri</label>
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
		<!-- se aduaga un fisier -->
		<div class="form-group">
			<table class="table">
				<tr>
					<td  align="right"><label>Select File for Upload</label></td>
					<td ><input type="file" name="select_file" /></td>
				</tr>
				<tr>
					<td width="40%" align="right"></td>
					<td width="30"><span class="text-muted">jpg, png</span></td>
					<td width="30%" align="left"></td>
				</tr>
			</table>
		</div>
			<div class="col-sm-6">
				<button type="submit" class="btn btn-success">Add todo</button>
			</div>
	</form>
	<br />
</div> 

@stop
