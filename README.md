# 🥗 Food Share Hub
Food Share Hub is a web-based mini-project designed to moderate and manage the distribution of free meal programs. Built with Laravel and Blade, this platform allows users to request meal aid for their schools, track request status, and manage their personal data. The project is created as part of an initiative to build meaningful software that contributes to social good.


## 🌟 Key Features
- **Submit Meal Request**: A page that allows users to request free meal assistance for their schools by filling out the number of meals needed and other relevant information.

- **Request Status**: A page to track the status of submitted requests — whether they are pending, approved, or rejected.

- **Aid History**: A page that displays a list of previously submitted and processed aid requests.

- **User Settings**: A page that allows users to view and update their profile or personal data.

## 🛠️ Technologies Used
- Framework: Laravel
- Database: MySQL
- Programming Language: PHP
- Frontend: Blade Template Engine
- Server: Apache (XAMPP / LAMP / WAMP)
  
## Instalasi
1. Clone this repository:  
   ```
   git clone https://github.com/NandoG1/food-share-hub-Project.git
   ```
2. Navigate into the project directory:
   ```
   cd foodShareHub
   ```
3. Install all PHP dependencies using Composer:
   ```
   composer install
   ```
4. Create the environment configuration file:
   ```
   cp .env.example .env
   ```
5. Generate the application key:  
   ```
   php artisan key:generate
   ```
6. Open the project in Visual Studio Code (optional):  
   ```
   code .
   ```
7. Start XAMPP and create a new database:  
   Open XAMPP, start Apache and MySQL, then create a database named "laravel" using phpMyAdmin.
8. Run the database migrations:  
   ```
   php artisan migrate
   ```
9. Start the Laravel development server:  
   ```
   php artisan serve
   ```
After completing these steps, open the provided localhost link to use the app in your browser.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
