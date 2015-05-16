<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/




Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


//Administrative Filter

Route::filter('admin', function()
{
	if(!Auth::check())
    	return Redirect::to("/login");
	
	if(Auth::user()->user_type!=2)
	{
		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");
	}
});



Route::filter('audit_trail', function()
{
	if(!Auth::check())
    	return Redirect::to("/login");
	
	if(Auth::user()->user_type!=1)
	{

		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");
	}

	$position = Position::find(Auth::user()->position_id);
	if($position->audit_trail!=1){
		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");

	}
});

Route::filter('transact_deposit', function()
{
	if(!Auth::check())
    	return Redirect::to("/login");
	
	if(Auth::user()->user_type!=1)
	{

		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");
	}

	$position = Position::find(Auth::user()->position_id);
	if($position->transact_deposit!=1){
		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");

	}
});

Route::filter('transact_withdraw', function()
{
	if(!Auth::check())
    	return Redirect::to("/login");
	
	if(Auth::user()->user_type!=1)
	{

		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");
	}

	$position = Position::find(Auth::user()->position_id);
	if($position->transact_withdraw!=1){
		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");

	}
});

Route::filter('transact_transfer', function()
{
	if(!Auth::check())
    	return Redirect::to("/login");
	
	if(Auth::user()->user_type!=1)
	{

		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");
	}

	$position = Position::find(Auth::user()->position_id);
	if($position->transact_transfer!=1){
		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");

	}
});

Route::filter('manage_staff', function()
{
	if(!Auth::check())
    	return Redirect::to("/login");
	
	if(Auth::user()->user_type!=1)
	{

		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");
	}

	$position = Position::find(Auth::user()->position_id);
	if($position->manage_staff!=1){
		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");

	}
});
Route::filter('manage_staff', function()
{
	if(!Auth::check())
    	return Redirect::to("/login");
	
	if(Auth::user()->user_type!=1)
	{

		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");
	}

	$position = Position::find(Auth::user()->position_id);
	if($position->manage_staff!=1){
		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");

	}
});
Route::filter('manage_acc_sav', function()
{
	if(!Auth::check())
    	return Redirect::to("/login");
	
	if(Auth::user()->user_type!=1)
	{

		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");
	}

	$position = Position::find(Auth::user()->position_id);
	if($position->manage_acc_sav!=1){
		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");

	}
});
Route::filter('manage_acc_tim', function()
{
	if(!Auth::check())
    	return Redirect::to("/login");
	
	if(Auth::user()->user_type!=1)
	{

		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");
	}

	$position = Position::find(Auth::user()->position_id);
	if($position->manage_acc_tim!=1){
		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");

	}
});
Route::filter('reg', function()
{
	if(!Auth::check())
    	return Redirect::to("/login");
	
	if(Auth::user()->user_type!=1)
	{

		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");
	}

	$position = Position::find(Auth::user()->position_id);
	if($position->reg!=1){
		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");

	}
});


Route::filter('staff', function()
{
	if(!Auth::check())
    	return Redirect::to("/login");
	
	if(Auth::user()->user_type!=1)
	{
		Session::put('msgfail', 'Unauthorized access denied.');
		
		return Redirect::to("/");
	}
});