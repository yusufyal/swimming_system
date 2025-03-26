@if(count($errors) > 0)
<ul class="list-group">
	@foreach($errors->all() as $error)
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Error!</strong> {{ $error }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
	</div>
	@endforeach
</ul>
@endif
@if(Session::has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
	<strong>Success!</strong> {{ Session::get('success') }}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(Session::has('danger'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Success!</strong> {{ Session::get('danger') }}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif


@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Error!</strong> {{Session::get('error')}}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>

{{ Session::forget('error') }}
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script>
	$(document).ready(function() {
		
		setTimeout(function() {
			$('.alert').fadeOut('slow');
		}, 3000);

		setTimeout(function() {
			$('.alert').remove();
		}, 4000);
	});
</script>