<?php

test('Create user action create a user', function () {
   $data = [
     'name' => fake()->name,
     'email' => fake()->email,
     'password' => fake()->password,
     'company_name' => fake()->company,
     'company_email' => fake()->email,
     'number_of_employees' => random_int(20, 100)
   ];

    (new \App\Actions\CreateUserAction)->handle($data);

    $this->assertDatabaseHas('users', [
        'name' => $data['name'],
        'email' => $data['email'],
    ]);
})->group('admin-management');

test('create client action create a client', function () {
    $data = [
        'name' => fake()->name,
        'email' => fake()->email,
        'password' => fake()->password,
        'company_name' => fake()->company,
        'company_email' => fake()->email,
        'number_of_employees' => random_int(20, 100),
        'user' => \App\Models\User::factory()->create()
    ];

    (new \App\Actions\CreateClientAction)->handle($data);

    $this->assertDatabaseHas('clients', [
        'name' => $data['company_name'],
    ]);
})->group('admin-management');

test('create company action creates a company', function () {
    $data = [
        'name' => fake()->name,
        'email' => fake()->email,
        'password' => fake()->password,
        'company_name' => fake()->company,
        'company_email' => fake()->email,
        'number_of_employees' => random_int(20, 100),
        'user' => \App\Models\User::factory()->create(),
        'client' => \App\Models\Client::factory()->create()
    ];

    (new \App\Actions\CreateCompanyAction)->handle($data);

    $this->assertDatabaseHas('companies', [
        'name' => $data['company_name'],
        'number_of_employees' => $data['number_of_employees'],
        'client_id' => $data['client']->id
    ]);
});


test('send notification action sends a notification to the user', function () {
    \Illuminate\Support\Facades\Notification::fake();
    $user = \App\Models\User::factory()->create();

    $data = [
        'name' => fake()->name,
        'email' => fake()->email,
        'password' => fake()->password,
        'company_name' => fake()->company,
        'company_email' => fake()->email,
        'number_of_employees' => random_int(20, 100),
        'user' => $user,
        'client' => \App\Models\Client::factory()->create(),
        'company' => \App\Models\Company::factory()->create(),
    ];

    (new \App\Actions\SendNotificationAction())->handle($data);

    \Illuminate\Support\Facades\Notification::assertSentTo(
        [$user], \App\Notifications\YourRegistrationIsCompleteNotification::class
    );
});
