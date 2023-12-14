                                    Laravel Authentication and Authorization Guide

Introduction:

In this comprehensive guide, we will walk you through the process of setting up a Laravel project with a robust authentication and authorization system. Laravel, a popular PHP framework, offers an elegant solution for building secure and scalable web applications.

Prerequisites:

Before you embark on this guide, ensure that you have the following prerequisites in place:

1. Composer installed on your system.
2. A web server such as Apache or Nginx.
3. PHP installed, preferably version 7.4 or later.
4. A functional database server (e.g., MySQL).

Step 1: Create a New Laravel Project:
    Open your terminal and execute the following command to create a new Laravel project. Replace yourProjectName with your preferred project name:

       composer create-project laravel/laravel yourProjectName

This command initializes a fresh Laravel installation in a directory named yourProjectName.

Step 2: Configure Database Connection:
    Open the .env file in your project's root directory and configure your database connection settings:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=yourDatabaseName
        DB_USERNAME=databaseUserName
        DB_PASSWORD=yourDatabasePassword

Replace yourDatabaseName, databaseUserName, and yourDatabasePassword with your actual database details.

Step 3: Add Breeze Package for Login and Register Pages:
    Execute the following commands in your terminal to integrate the Breeze package into your Laravel project:

    composer require laravel/breeze
    php artisan breeze:install
    npm install
    npm run build

Breeze automates the setup of login, register, and dashboard pages.

Step 4: Modify the User Migration Table:    
    Add a new column user_type with a default value of "user" to the users table:

       $table->string("user_type")->default("user");

Step 5: Migrate the Database
    Run the following command in your terminal to execute the database migration:

       php artisan migrate

Step 6: Create Controllers:
    Generate controllers using the following command:

       php artisan make:controller YourControllerName

In the created controller, implement methods to handle different actions based on user roles.

        use Illuminate\Support\Facades\Auth;

        class YourControllerName extends Controller
        {
            public function functionName()
            {
                if (Auth::user()->user_type == 'admin') {
                    return view('dashboardView');
                } else if (Auth::user()->user_type == 'user') {
                    return view('anotherDashboardView');
                } else {
                    return redirect()->back();
                }
            }
        }
        
Step 7: Create View Files:
    Create additional view files for various functionalities, such as adding products and listing data.
    A dashboard view is already created for the both user and admin , so you have create view blade similar as dashboard to 
    set one for user and one for admin. 

Step 8: Add Users to Database
    Register users through the registration page, and update one user's user_type to "admin" using a SQL update query.

       UPDATE users SET user_type = "admin" WHERE id = specificId;

Step 9: Authentication Middleware
    Generate a middleware for authentication:

       php artisan make:middleware YourMiddlewareName

Update the middleware to restrict access based on user type:

        if (Auth()->user()->user_type == 'admin') {
            return $next($request);
        } else {
            return back();
        }

Step 10: Modify kernel.php File
    Add the middleware to the kernel.php file:

       'admin' => \App\Http\Middleware\YourMiddlewareName::class,

Step 11: Define Routes
    Define routes in the routes/web.php file:

        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\YourControllerName;

        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/list', function () {
            return view('new View File with any data');
        })->middleware(['auth', 'admin']);

        Route::get('/dashboard', [YourControllerName::class, 'functionName'])->middleware('auth')->name('dashboard');

        require __DIR__.'/auth.php';

Ensure to replace YourControllerName and update the route URLs to match your project's structure.

Step 12: Run the Project
    Execute the following commands to optimize and run your Laravel project:

       php artisan optimize
       php artisan cache:clear
       php artisan serve
        
Visit the provided URL (usually http://127.0.0.1:8000) in your web browser to access your Laravel project.
Congratulations! Your Laravel project, following the MVC pattern, is now equipped with a robust authentication and authorization system.
