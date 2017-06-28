## Installation

```
composer require kilroyweb/email-verification
```

Add to the $routeMiddleware array in app/Http/Kernel.php


```php
'verified_email' => \KilroyWeb\EmailVerification\Middleware\RequireVerifiedEmail::class,
'non_verified_email' => \KilroyWeb\EmailVerification\Middleware\RequireNonVerifiedEmail::class,
```

Add the HasEmailVerification trait to your User class

```php
use \KilroyWeb\EmailVerification\Traits\HasEmailVerification;
```

## Routes

Use the supplied "verified_email" or "non_verified_email" middleware

```php
Route::namespace('Email')->prefix('/email')->group(function(){
    Route::namespace('Verification')->prefix('/verification')->group(function(){
        Route::get('/create', 'VerificationController@create')->middleware(['auth','non_verified_email']);
        Route::get('/{token}', 'VerificationController@show');
    });
});
```

## Controllers

A controller is easy to whip up using available methods inherited from the HasEmailVerification trait:

```php
<?php

namespace App\Http\Controllers\Email\Verification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{

    public function create(){
        $user = \Auth::user();
        $user->requestEmailVerification();
        return redirect('/account')->withSuccess('Verification email sent!');

    }

    public function show($token){
        $user = \App\User::findByEmailVerificationToken($token);
        if(!$user){
            abort(404);
        }
        $user->verifyEmail();
        \Auth::login($user);
        return redirect('/account')->withSuccess('Your email address has been verified!');
    }

}

```