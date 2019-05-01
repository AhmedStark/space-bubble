# space-bubble
A web-app that allows users to check how busy rooms are in a certain building. (Can be customized for any building)(still in development).

This web-app is developed using Laravel.
# Server requirements

1. PHP >= 7.1.3
2. OpenSSL PHP Extension
3. PDO PHP Extension
4. Mbstring PHP Extension
5. Tokenizer PHP Extension
6. XML PHP Extension
7. Ctype PHP Extension
8. JSON PHP Extension
9. BCMath PHP Extension
10. NodeJs and NPM (node package manager)
11. MySQL database server

# Deployment

To deploy space-bubble on your server you need to run the following commands in the terminal to ensure that the dependencies needed are installed.

```
composer install
npm install
```

After that create a database in your MySQL server and give it a name that you want.

Copy `.env.example` file to `.env`

```
cp .env.example .env
```

Then run the following command to generate an app key :-

```
php artisan key:generate
```

After that add your database name, username and password to the `.env` file

```
DB_DATABASE=[YOUR_DATABASE_NAME]
DB_USERNAME=[YOUR_USER_NAME]
DB_PASSWORD=[YOUR_PASSWORD]
```
To create the framework needed tables run the following command:-

```
php artisan migrate
```

To run the development server you need to run

```
php artisan serve
```
Another command you will need to ensure that when a map is uploaded the site will update is :

```
npm run watch
```
# How it works
## Creating an admin
To create an admin for the website you need to run the following command in the terminal in the project directory :-

```
php artisan mkAdmin
```
Which will ask you for your username and password
Password must be more than 8 characters

## Making you first building
After you have created your admin login credentials. Go to `THE_SITE_DOMAIN/admin`
and login.
You will see the dashboard you can click on add building to create your first building.

You can add levels to each building and add areas to each level.
You can upload svg maps to each level.

Areas can have seats which you can add by clicking on edit on any area. There will be token shown to each seat which you can add to your sensors or use to integrate your system with space-bubble API

## The seats/table API
To update the seat status you need to send a json request containing the following
to `THE_SITE_DOMAIN/api/table`:-

1. Incase the seat/table is taken
```
{
   "token":"THE_GENERATED_TOKEN",
   "taken":true
}
```
2. Incase the seat/table is empty
```
{
   "token":"THE_GENERATED_TOKEN",
   "taken":false
}
```
## Android sensor example
In the project directory you can see a file called `android-sensor`.
It is an android phone app that can represent what a sensor should do.
It sends signal every short period of time to the server to update the seat/table status

To modify the sensor to send signals to your server go to the `string.xml` file located in `android-sensor/app/src/main/res/values/` and modify the `token` value and the `api_link` value
