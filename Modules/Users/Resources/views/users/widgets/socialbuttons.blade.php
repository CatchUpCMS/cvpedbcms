<div id="social_buttons" class="grid-stack-item" data-gs-width="3" data-gs-height="4"


	 {{--data-gs-auto-position--}}

	 data-gs-x="0" data-gs-y="0"

>
	<div class="grid-stack-item-content panel panel-default">
		<div class="panel-heading">{!! trans('users::widgets/profileusers.title') !!}</div>
		<div class="panel-body">
			@if (!empty($social_login))
				<div class="social-auth-links text-center">
					@if (in_array('bitbucket', $social_login))
						<a href="{{ route('login.provider', ['provider' => 'bitbucket']) }}"
						   class="btn btn-primary btn-social btn-bitbucket
						   	@if (Auth::user()->tokens->where('provider', 'bitbucket')->count())
								   disabled
							@endif">
							<i class="fa fa-bitbucket"></i> | {{ trans('users::frontend.login.signin_bitbucket') }}
						</a>
					@endif
					@if (in_array('facebook', $social_login))
						<a href="{{ route('login.provider', ['provider' => 'facebook']) }}" class="btn btn-primary btn-social btn-facebook
						   	@if (Auth::user()->tokens->where('provider', 'facebook')->count())
								disabled
						 @endif">
							<i class="fa fa-facebook"></i> | {{ trans('users::frontend.login.signin_facebook') }}
						</a>
					@endif
					@if (in_array('github', $social_login))
						<a href="{{ route('login.provider', ['provider' => 'github']) }}" class="btn btn-primary btn-social btn-github
						   	@if (Auth::user()->tokens->where('provider', 'github')->count())
								disabled
						 @endif">
							<i class="fa fa-github"></i> | {{ trans('users::frontend.login.signin_github') }}
						</a>
					@endif
					@if (in_array('google', $social_login))
						<a href="{{ route('login.provider', ['provider' => 'google']) }}" class="btn btn-primary btn-social btn-google
						   	@if (Auth::user()->tokens->where('provider', 'google')->count())
								disabled
						 @endif">
							<i class="fa fa-google-plus"></i> | {{ trans('users::frontend.login.signin_google_plus') }}
						</a>
					@endif
					@if (in_array('linkedin', $social_login))
						<a href="{{ route('login.provider', ['provider' => 'linkedin']) }}" class="btn btn-primary btn-social btn-linkedin
						   	@if (Auth::user()->tokens->where('provider', 'linkedin')->count())
								disabled
						 @endif">
							<i class="fa fa-linkedin"></i> | {{ trans('users::frontend.login.signin_linkedin') }}
						</a>
					@endif
					@if (in_array('twitter', $social_login))
						<a href="{{ route('login.provider', ['provider' => 'twitter']) }}" class="btn btn-primary btn-social btn-twitter
						   	@if (Auth::user()->tokens->where('provider', 'twitter')->count())
								disabled
						 @endif">
							<i class="fa fa-twitter"></i> | {{ trans('users::frontend.login.signin_twitter') }}
						</a>
					@endif
				</div>
			@endif
		</div>
	</div>
</div>
