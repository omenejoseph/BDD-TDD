<?php

namespace App\Http\Controllers;

use App\Actions\CreateClientAction;
use App\Actions\CreateCompanyAction;
use App\Actions\CreateUserAction;
use App\Actions\SendNotificationAction;
use App\Http\Requests\SetupUserRequest;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class ApiController extends Controller
{
    public function setupUser(SetupUserRequest $request)
    {
        $data = app(Pipeline::class)
            ->send($request->validated())
            ->through([
                CreateUserAction::class,
                CreateClientAction::class,
                CreateCompanyAction::class,
                SendNotificationAction::class,
            ])
            ->thenReturn();

        return response()->json([
            'status' => true
        ]);
    }
}
