@extends('layouts.app')
@extends('layouts.navbar')
@section('content')

<!-- adaugarea unui nou tag -->
<div class="card-body">
	@include('errors')
	<form action="{{url('tag')}}" method="POST" class="form-horizontal">
		{{ csrf_field() }}
		<div class="row">
			<div class="form-group">
				<label for="Tag" class="col-sm-3 control-label">Tags</label>

				<div class="row">
					<div class="col-sm-5">
						<input type="text" name="name" id=tag-name class="form-control">
						<button type="submit" class="btn btn-success">Add tag</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- daca sunt daguri vor fi afisate -->
@if(count($tags) > 0)
	<div class="card">
		<div class="card-heading">
			Tagurile curente
		</div>
		<div class="card-body">
			<table class="table table-striped tags-table">
				<thead>
					<th>Tag</th>
					<th>&nbsp;</th>
				</thead>
				@foreach($tags as $tag)
					<tbody>
						<td class="table-text">
							<div>{{$tag->name}}</div>
						</td>
						<td>
							<!-- modificarea unui tag-->
							<form action="{{url('tagupdate/'.$tag->id)}}" method="POST">
								{{csrf_field()}}
								{{method_field('POST')}}

								<div class="col-sm-6">
									<input type="text" name="name" id=tag-name class="form-control">
								</div>
								<button class="btn btn-danger">
									update
								</button>	
							</form>
							<!-- stergerea unui tag-->
							<form action="{{url('tag/'.$tag->id)}}" method="POST">
								{{csrf_field()}}
								{{method_field('DELETE')}}

								<button class="btn btn-danger">
									Delete
								</button>
							</form>
						</td>
					</tbody>
				@endforeach
		</div>
	</div>
@endif

@endsection
