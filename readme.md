# Authenticate user stored in json file in Laravel

This is simple laravel web app (can also be used in APIs) which demonstrate authentication of the user of which the data is stored in json file.

It is similar to simple laravel app created by `composer create-project --prefer-dist laravel/laravel blog` with addition/modification of the following files:
* **project/user_provider/\***
* **project/config/auth.php**
* **project/app/Extension/\***

No RDBMS like MySQL or NoSQL DB like mongoDB is required for this project.
This is mainly for educational purpose, use of above DBs in the projects are highly recommended for data storage.

Utilizing awesome concepts of generic user, user provider and so on of Laravel, you can also authenticated the users of which data are stored in csv, text, xlxs etc using the flow demonstrated here in above files.


### Installation and configuration
* Open terminal
* `git clone https://github.com/SOHELAHMED7/json_file_user_provider.git`
* `cd json_file_user_provider`
* `composer install`
* Rename .env.example file to .env `mv .env.example .env`
* Give write permissions to directories stored in /path/to/json_file_user_provider/storage like `sudo chown -R www-data:www-data storage/framework/views/`
* `php artisan key:generate`
* Open corresponding project url in the browser and login using the info provided in `user_provider/users.json` (for simplicity user passwords are stored as plain text in this file)

### When it can be used
If the users info are stored in separate DB and in case if it goes down, its exported backup file can be used here.

If initially the user info (in some cases) are only stored in excel sheet (or json file like here) and then you wish to authenticate your app on the top of that data, this might be helpful.


### Contributions
Contributions are welcome.

###  Reference
https://laravel.com/docs/5.5/authentication#adding-custom-user-providers

### License
GPL v3

test23
3
3
