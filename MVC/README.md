                                Laravel MVC - Model, View, and Controller Setup Guide
Introduction
    In this guide, we will walk you through the process of setting up a Laravel project following the Model-View-Controller (MVC) architectural pattern. Laravel is a popular PHP framework for building web applications, and MVC is a design pattern that separates your application into three key components: Models, Views, and Controllers.

Prerequisites
    Before you begin, ensure that you have the following prerequisites:

    Composer installed on your system.
    A web server like Apache or Nginx.
    PHP installed, preferably version 7.4 or later.
    A working database server, e.g., MySQL.

Step 1: Create a New Laravel Project
    Open your terminal and execute the following command to create a new Laravel project. Replace yourProjectName with the desired name for your project.

    "composer create-project laravel/laravel yourProjectName"

    This command will set up a fresh Laravel installation in a directory named yourProjectName.

Step 2: Configure Your Database Connection
    Open the .env file in your project's root directory. Configure your database connection settings:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=yourDatabaseName
DB_USERNAME=databaseUserName
DB_PASSWORD=yourDatabasePassword
Make sure to replace yourDatabaseName, databaseUserName, and yourDatabasePassword with your actual database details.

Step 3: Create Database Migrations
    Migrations allow you to create and modify database tables. To create a migration for a new table, execute the following command in the terminal:


    "php artisan make:migration create_yourtablename"

    This will create a migration file in the database/migrations directory.

    Open the newly created migration file and define the table structure within the up method. Here's an example:

    public function up()
    {
        Schema::create('yourtablename', function (Blueprint $table) {
            $table->id();
            $table->string("product_name");
            $table->string("product_type");
            $table->integer("price");
            $table->timestamps();
        });
    }
    Replace yourtablename and define the table columns as needed.

Step 4: Create a Model
A model allows you to interact with the database table. To create a model, run the following command:

    "php artisan make:model YourModelName"

    In the created model file (located in the app/Models directory), specify the table name and the fillable attributes:


    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class YourModelName extends Model
    {
        use HasFactory;

        protected $table = 'yourtablename';
        protected $fillable = ['product_name', 'product_type', 'price'];
    }
    Replace YourModelName and ensure that the table name and fillable attributes match your database structure.

Step 5: Run Migrations
    Execute the following command to run the migrations and create the database table:

    "php artisan migrate"

    This will apply the changes defined in your migration file to your database.

Step 6: Create Controllers
    Controllers are responsible for handling the application's logic. To create a controller, run the following command:


    "php artisan make:controller YourControllerName"
    
    In the created controller file (located in the app/Http/Controllers directory), define the methods to perform actions such as displaying, adding, updating, and deleting data.

Step 7: Create View Files
    You should create three view files:

     - Add Data View: Create a Blade view file (e.g., addproduct.blade.php) that includes an HTML form for adding data.

     - List Data View: Create a Blade view file (e.g., productlist.blade.php) that displays data from the database in a table format.

     - Update Data View: Create a Blade view file (e.g., updateproduct.blade.php) with a form for updating data, pre-filled with existing values.

    Ensure you place these view files in the resources/views directory.

Step 8: Define Routes
    Open the routes/web.php file and define the routes to access your controller methods. For example:


    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\YourControllerName;

    Route::get('/addProduct', function () {
        return view('addproduct');
    });

    Route::get('/list', [YourControllerName::class, 'get']);

    Route::post('/add', [YourControllerName::class, 'add']);

    Route::get('/delete/{id}', [YourControllerName::class, 'delete']);

    Route::get('/update/{id}', [YourControllerName::class, 'update']);

    Route::post('/update_data/{id}', [YourControllerName::class, 'update_data']);
    Make sure to replace YourControllerName and update the route URLs to match your project's structure.

Step 9: Run the Project
    To run your Laravel project, open your terminal and execute the following commands:


    "php artisan optimize"
    "php artisan cache:clear"
    "php artisan serve"

    The last command will start the development server, and you can access your project by visiting the provided URL 
    (usually http://127.0.0.1:8000) in your web browser.

Your Laravel project following the MVC pattern is now up and running.