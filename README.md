# Create database and set .env file

- php artisan migrate

# To create a user with maximum permissions, you can run the following command with a username, email, and password:
- php artisan orchid:admin admin admin@admin.com password

# To start scheduler
- php artisan schedule:work

## Scheduler work every hour

# /admin route for admin panel