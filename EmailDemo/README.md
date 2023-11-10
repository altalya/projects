Laravel Email Setup Guide

Introduction:

    In this guide, we will walk you through the process of setting up an email functionality in Laravel. Laravel, a leading PHP framework, is renowned for its ease of use and follows the MVC design pattern, which separates applications into Models, Views, and Controllers.

Prerequisites:

    Before you begin, ensure that you have the following prerequisites:

    Composer installed on your system.
    A web server like Apache or Nginx.
    PHP installed, preferably version 7.4 or later.
    A working database server, e.g., MySQL.
    Access to your email account via a web browser.

Step 1: Create a New Laravel Project

    Open your terminal and execute the following command to create a new Laravel project. Replace yourProjectName with the desired name for your project.

    " composer create-project laravel/laravel yourProjectName "

Step 2: Generate Email App Password

    Go to "Manage your Google Account" page.
    In the Security section, enable two-step verification.
    Generate an App password in the "App password" section.
    Copy the 16-digit generated password.

Step 3: Configure Database Connection

    Open the .env file in your project's root directory and configure your database connection settings.

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=yourDatabaseName
    DB_USERNAME=databaseUserName
    DB_PASSWORD=yourDatabasePassword

Step 4: Configure Email Connection

    Open the .env file and configure your Email connection settings.

    MAIL_MAILER=smtp
    MAIL_HOST=smtp.gmail.com
    MAIL_PORT=587
    MAIL_USERNAME=yourEmailAddress
    MAIL_PASSWORD=16-digit passsword
    MAIL_ENCRYPTION=tls
    MAIL_FROM_ADDRESS=yourEmailAddress
    MAIL_FROM_NAME=yourFromName

Step 5: Create Mail Access

    In the terminal, create a mail access file using the following command:

    " php artisan make:mail YourMailName "
    
    Modify the created file in the app/Mail directory according to your requirements.

    for example: 

        namespace App\Mail;
        use Illuminate\Bus\Queueable;
        use Illuminate\Contracts\Queue\ShouldQueue;
        use Illuminate\Mail\Mailable;
        use Illuminate\Mail\Mailables\Content;
        use Illuminate\Mail\Mailables\Envelope;
        use Illuminate\Queue\SerializesModels;

        class yourMailName extends Mailable
        {
            use Queueable, SerializesModels;
            public function __construct()
            { 
    
            }
            public function envelope(): Envelope
            {
                return new Envelope(
                    subject: 'your mail Subject',
                );
            }
            public function content(): Content
            {
                return new Content(
                    view: 'your view blade',       
                );
            }
            public function attachments(): array
            {
                return [];
            }
        }

Step 6: Create Controllers

    Create a controller using the following command:

    " php artisan make:controller YourControllerName "
    
    Import the necessary model and mail requirements into the controller:

    use Illuminate\Support\Facades\Mail;
    use App\Mail\YourMailName;
    Add a function to send emails:

    public function send()
    {
        Mail::to('ToMailaddress')->send(new YourMailName());
    }

Step 7: Create View Files

    - Create a view file acting as the body of your email.
    - And then in resources/views/welcome.blade.php, create a button inside an "a" tag with an href attribute set to "/mail" as a send button on the server.

Step 8: Define Routes

    Open the routes/web.php file and define routes to access your controller methods.

    use App\Http\Controllers\YourControllerName;

    " Route::get('/mail', [YourControllerName::class, 'send']); "

Step 9: Run the Project

    Run your Laravel project with the following commands:

    " php artisan optimize "
    " php artisan cache:clear "
    " php artisan serve "

    Visit the provided URL (usually http://127.0.0.1:8000) in your web browser.

Your Laravel project, following the MVC pattern, is now set up with email functionality.