<!-- este folosita pt afisarea erorilor -->
@if(count($errors)>0)
	<div class="alert alert-danger">
		<strong>Sa produs o eroare</strong>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
@endif