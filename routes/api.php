<?php

use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\SearchController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::auth();

Route::get('establishments', [EstablishmentController::class, "index"])->middleware('auth:sanctum');

Route::post('establishments', [EstablishmentController::class, "store"])->middleware('auth:sanctum');

Route::get('establishments/{establishment}', [EstablishmentController::class, "show"])->middleware('auth:sanctum');

Route::put('establishments/{establishment}', [EstablishmentController::class, "update"])->middleware('auth:sanctum');

Route::delete('establishments/{establishment}', [EstablishmentController::class, "destroy"])->middleware('auth:sanctum');

Route::get('search/{q?}', SearchController::class);

Route::post('/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $token = $user->createToken($request->device_name)->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token,
    ];

    return response($response, 201);
});
