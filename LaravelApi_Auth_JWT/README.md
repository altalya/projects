**LARAVEL API AUTHENTICATION USING JSON TOKEN**

**Introduction**

In this comprehensive guide, we will walk you through the process of setting up a Laravel project with a robust authentication and authorization system. Laravel, a popular PHP framework, offers an elegant solution for building secure and scalable web applications.

**Prerequisites**

Before you embark on this guide, ensure that you have the following prerequisites in place:

- Composer installed on your system.
- A web server such as Apache or Nginx.
- PHP installed, preferably version 7.4 or later.
- A functional database server (e.g., MySQL).

**step 1 : Create a New Laravel Project**
    
Open your terminal and execute the following command to create a new Laravel project. Replace yourProjectName with your preferred project name:

       composer create-project laravel/laravel yourProjectName

This command initializes a fresh Laravel installation in a directory named yourProjectName.

**step 2 : Configure Database Connection**

Open the .env file in your project's root directory and configure your database connection settings:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=yourDatabaseName
        DB_USERNAME=databaseUserName
        DB_PASSWORD=yourDatabasePassword

Replace yourDatabaseName, databaseUserName, and yourDatabasePassword with your actual database details.

**step 3 : Create a Json token package from composer to the Laravel Project**
    
Open your terminal and move to your project directory with command 'cd yourprojectName' and execute the following command to create a Json token package to the Laravel project:

        composer require php-open-source-saver/jwt-auth

This command initializes a JWT(Json web token) pacakge installation in your larvel project directory .

**step 4 : Publish the config**

By Run the following command to publish the package config file:

        php artisan vendor:publish --provider="PHPOpenSourceSaver\JWTAuth\Providers\LaravelServiceProvider"

You should now have a config/jwt.php file that allows you to configure the basics of this package.

**step 5 : Generate secret key**

Generate secret key by using the following command in terminal

        php artisan jwt:secret
    
This will update your .env file with something like JWT_SECRET=foobar.

It is the key that will be used to sign your tokens. How that happens exactly will depend on the algorithm that you choose to use.

**step 6 : Migrate the Database**
    
Run the following command in your terminal to execute the database migration:

        php artisan migrate

If it shows your migrations are already existed , then use the command to rollback your migrations

        php artisan migrate:rollback

**step 7 : Update your User model**

you can find the user model file in the directory [App -> Models -> User.php] 

Firstly you need to implement the PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject contract on your User model, which requires that you implement the 2 methods getJWTIdentifier() and getJWTCustomClaims().

The example below should give you an idea of how this could look. Obviously you should make any changes, as necessary, to suit your own needs.

        <?php
        namespace App;
        use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
        use Illuminate\Notifications\Notifiable;
        use Illuminate\Foundation\Auth\User as Authenticatable;

        class User extends Authenticatable implements JWTSubject
        {
            use Notifiable;

            // Rest omitted for brevity

            /**
            * Get the identifier that will be stored in the subject claim of the JWT.
            *
            * @return mixed
            */
            public function getJWTIdentifier()
            {
                return $this->getKey();
            }

            /**
            * Return a key value array, containing any custom claims to be added to the JWT.
            *
            * @return array
            */
            public function getJWTCustomClaims()
            {
                return [];
            }
        }

**step 8 : Configure Auth guard**

Note: This will only work if you are using Laravel 5.2 and above.

Inside the config/auth.php file you will need to make a few changes to configure Laravel to use the jwt guard to power your application authentication.

Make the following changes to the file:

        'defaults' => [
            'guard' => 'api',
            'passwords' => 'users',
        ],

        ...

        'guards' => [
            'api' => [
                'driver' => 'jwt',
                'provider' => 'users',
            ],
        ],

Here we are telling the api guard to use the jwt driver, and we are setting the api guard as the default.

We can now use Laravel's built in Auth system, with jwt-auth doing the work behind the scenes!

**step 9 : Create Register Request file**

Run the following command in your terminal to create a register request:

       php artisan make:request RegistrationRequest 

you can find the file in the directory [App -> Http -> Requests] 

The example below should give you an idea of how this could look. Obviously you should make any changes, as necessary, to suit your own needs.

        <?php
        namespace App\Http\Requests;
        use Illuminate\Foundation\Http\FormRequest;

        class RegistrationRequest extends FormRequest
        {
            /**
            * Determine if the user is authorized to make this request.
            */
            public function authorize(): bool
            {
                return true;
            }

            /**
            * Get the validation rules that apply to the request.
            *
            * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
            */
            public function rules(): array
            {
                return [
                    'name' => ['required', 'string', 'min:2'],
                    'email' => ['required', 'email:filter', 'unique:users'],
                    'password' => ['required', 'string', 'min:6', 'confirmed']
                ];
            }
        }

**step 10 : Create Login Request file**

Do same as per the register request **step,Run the following command in your terminal to create a login request:

       php artisan make:request LoginRequest 

you can find the file in the directory [App -> Http -> Requests]

The example below should give you an idea of how this could look. Obviously you should make any changes, as necessary, to suit your own needs.

        <?php
        namespace App\Http\Requests;
        use Illuminate\Foundation\Http\FormRequest;

        class LoginRequest extends FormRequest
        {
            /**
            * Determine if the user is authorized to make this request.
            */
            public function authorize(): bool
            {
                return true;
            }

            /**
            * Get the validation rules that apply to the request.
            *
            * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
            */
            public function rules(): array
            {
                return [
                    'email' => ['required', 'email:filter'],
                    'password' => ['required', 'string']
                ];
            }
        }


**step 11 : Create Controllers**

Generate controllers using the following command to control the action to the Authentication:

       php artisan make:Controller Api/Auth/AuthController

In the created controller, implement methods to handle different actions based on user roles.

        <?php
        namespace App\Http\Controllers\Api\Auth;
        use Illuminate\Support\Facades\Auth;
        use App\Http\Controllers\Controller;
        use App\Http\Requests\RegistrationRequest;
        use App\Http\Requests\LoginRequest;
        use Illuminate\Http\Request;
        use App\Models\User;

        class AuthController extends Controller
        {
            public function login(LoginRequest $request){
                $token = auth()->attempt($request->validated());

                if($token){
                return $this->responseWithToken($token, auth()->user());
                }else{
                    return response()->json([
                        'status' => 'failed',
                        'mesage' => 'Invalid credentials'
                    ],401);
                }
            }

            public function register(RegistrationRequest $request){
                $user = User::create($request->validated());

                if($user){
                    $token = auth()->login($user);
                    return $this->responseWithToken($token, $user);
                }else{
                    return response()->json([
                        'status' => 'failed',
                        'mesage' => 'An error occur while trying to create user'
                    ],500);
                }
            }

            public function responseWithToken($token, $user){
                return response()->json([
                    'status' => 'success',
                    'user' => $user,
                    'access_token' => $token,
                    'type' => 'bearer'
                ]);
            }
        }



**step 12: Define Routes**

Define routes in the routes/api.php file:

        <?php
        use Illuminate\Http\Request;
        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\Api\Auth\AuthController;

        /*
        |--------------------------------------------------------------------------
        | API Routes
        |--------------------------------------------------------------------------
        |
        | Here is where you can register API routes for your application. These
        | routes are loaded by the RouteServiceProvider and all of them will
        | be assigned to the "api" middleware group. Make something great!
        |
        */

        Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
            return $request->user();
        });

        Route::post('auth/register',[AuthController::class, 'register']);
        Route::post('auth/login',[AuthController::class, 'login']);


Ensure to replace YourControllerName and update the route URLs to match your project's structure.

**step 13 : View the Route List**
    
Open your terminal and execute the following command to view your route list:

        php artisan route:list

This will display a list of all the defined routes in your application.

**step 14 : Run the Project**
    
To run your Laravel project, open your terminal and execute the following commands:

        php artisan optimize
        php artisan cache:clear
        php artisan serve

The last command will start the development server, and you can access your project by visiting the provided URL 
(usually http://127.0.0.1:8000) in your web browser.

Your Laravel project, following the MVC pattern, is now up and running.

**step 15 : Using Postman Application for API Testing**
    
Open Postman and paste your Laravel localhost server URL. Ensure your server is running at the specified URL

        http://127.0.0.1:8000
 
**step 16 : Register Records in the Database**
    
To add data to the database table, set the method to POST and use the URL

        http://127.0.0.1:8000/api/auth/register 

In the request body, change the radio button to form-data and then provide the field names like(name, email, password, confirmation_password) and values as per your table column requirements and then click the "Send" button.

If the code execute success, it show "200 code" in green color and return the json data as per we declare in our controller file.

for example:

{
  "status": "success",
  "user": {
    "name": "abc",
    "email": "abc@gmail.com",
    "updated_at": "2023-12-21T06:58:47.000000Z",
    "created_at": "2023-12-21T06:58:47.000000Z",
    "id": 1
  },
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvcmVnaXN0ZXIiLCJpYXQiOjE3MDMxNDE5MjcsImV4cCI6MTcwMzE0NTUyNywibmJmIjoxNzAzMTQxOTI3LCJqdGkiOiJXOG05Y05DNFZGYVNmbFczIiwic3ViIjoiNCIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.lamyGlJqzECTt4OIJs8FXWwW1_VYb_VnWO4Fe-bhBFQ",
  "type": "bearer"
}

Otherwise it returns an error code in Red color.

**step 17 : Login Records to check the Authentication in the Database**
    
To login to the database table, set the method to POST and use the URL

        http://127.0.0.1:8000/api/auth/login

In the request body, change the radio button to form-data and then provide the field names like(email, passoword) and values as per your table column requirements and then click the "Send" button.

If the code execute success, it shows "200 code" in green color and return the json data as per we declare in our controller file.

for example:

{
  "status": "success",
  "user": {
    "id": 1,
    "name": "abc",
    "email": "abc@gmail.com",
    "email_verified_at": null,
    "created_at": "2023-12-21T06:58:47.000000Z",
    "updated_at": "2023-12-21T06:58:47.000000Z"
  },
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MDMxNDIyNjQsImV4cCI6MTcwMzE0NTg2NCwibmJmIjoxNzAzMTQyMjY0LCJqdGkiOiJCd3k5d1ZtdG93Zk1rdFZ3Iiwic3ViIjoiNCIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.70S9eMJkDnLiTPgfwBHlZS9UwujIkbq11spgGMN1q4A",
  "type": "bearer"
}

Otherwise it returns an error code in Red color.

By following these steps, you can create a professional Laravel project to perform Registe and Login operation with a file using API system with the help of JWT(JSON web token) token with clear and organized documentation.
