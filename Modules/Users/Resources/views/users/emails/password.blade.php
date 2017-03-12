@extends('adminlte::emails.default')

@section('content')
	<table>
		<tr>
			<td>
				<p>You required to reset your password on our platform</p>
				<p></p>
				<!-- button -->
				<table class="btn-primary" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td align="center">
							<a href="{{ url('password/reset', $token) }}">
								Click here to reset your password
							</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
@endsection
