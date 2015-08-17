@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">{{ Lang::get('copy.home') }}</div>

				<div class="panel-body">
                    {{ Lang::get('copy.login_success') }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
