# Leaderboard
 Leaderboard App Allows you to Add employees to the leaderboard with details of name, age and address. default points for all new employees are 0. You can increse / decrease employees points using +/-. You can also delete employee using delete button. To See/ edit current employee details you can click on employee name.

 # Installation:

 Clone the repository:

 	https://github.com/uniquedeveloper/Leaderboard.git

 Install Dependency Using composer:
 
 	composer install

 Copy the example env file and make the required configuration changes in the .env file
 
	cp .env.example .env
	
Run the database migrations (Set the database connection in .env before migrating/ Change it in Config/Database.php)
	
	php artisan migrate

Start the local development server
	
	php artisan serve
	
You can now access the server at http://localhost:8000
