@auth

	@if($appUser->user_role == 1)

	@elseif($appUser->user_role == 2)

	@elseif($appUser->user_role == 3)

	@endif
	
@endauth