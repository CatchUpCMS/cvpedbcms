@extends('adminlte::emails.default')

@section('content')
	<table>
		<tr>
			<td>
				<p>An admin just added you to the plateforme
					<a href="{{ env('APP_URL') }}">{{ env('APP_URL') }}</a>.</p>
				<p>He registered you with the following email
					: {{ $user->email }}</p>
				<!-- button -->
				<table class="btn-primary" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td align="center">
							<a href="{{ url('password/reset') }}">
								Click here to change your password
							</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
@endsection