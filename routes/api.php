<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;

# GET/categories -> index()
# GET/categories/{id} -> show()
# POST/categories -> store()
# PUT/categories/{id} -> update()
# DELETE/categories/{id} -> destroy()


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/categories', CategoryApiController::class);

Route::post('/login', function(){
    $email = request()->email;
    $password = request()->password;

    $user = App\Models\User::where("email", $email)->first();
    if(!$user) return response("Incorrect email", 403);

    if(password_verify($password, $user->password))
    {
        return $user->createToken("chrome")->plainTextToken;
    }

    return response("Incorrect Password", 403);

});

Route::delete('/logout', function(){
    request()->user()->tokens()->delete();

    return "Logout Successfully";
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
