<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orchid\Attachment\File;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/createUser', function (Request $request) {
    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ];
    $user = User::create($data);

    if ($request->file('avatar')) {
        $file = new File($request->file('avatar'), 'public', 'avatar');
        $attachment = $file->allowDuplicates()->load();
        $user->avatar = $attachment->id;
        $user->save();
        $user->attachment()->syncWithoutDetaching([$attachment->id]);
    }

    $user->load('attachment');

    return response([
        'status' => 'success',
        'message' => 'User created successfully',
        'data' => $user

    ], 200);
});
