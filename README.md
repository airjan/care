
## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

## Installation Guide
 - Requirements: PHP 8.2 or higher , Mysql , Composer latest version 
 - Clone / download this repository to your local machine
 - Go to your directory where this project is installed 
 - Copy .env.example to .env 
 - Run php artisan key:generate 
 - Create new database name in your favorite Mysql GUI 
 -  Edit .env file using your favorite editor or notepad 
    - update db credentials for mysql 
    - DB_HOST = host of your mysql
    - DB_PORT = default 3306, change this if you configure your mysql to use different port
    - DB_DATABASE  = name of database that you created
    - DB_USERNAME = username of database
    - DB_PASSWORD =  database password 
 - Run composer update     
 - Run php artisan migrate 
 - Run php artisan passport:install 


 ## Executing Guide : some guidelines you can follow 
   - Window OS -without using web server package (xampp,wamp). laravel has a mini service / container that can run laravel 
      - Go to folder where the package is installed 
        - Run php artisan serve 
        - visit http://localhost:8000

   - XAMPP, WAMP: create  virtual host and point the root to the project folder eg: c:xampp/htdocs/projects/Carevision/public for more specific detail visit https://medium.com/@ajtech.mubasheer/configure-a-virtual-host-for-laravel-project-in-xampp-for-windows-10-d3f0068e7e1b

   - Vagrant : create your own virtual host 
   		- go to /etc/apachec2/sites-available 
   		- create new virtual configuration file ending in .conf eg: carevision.local.conf 
   		- activate virtual host: run sudo a2ensite carevision.local.conf 
   		 - restart apache 

   - Docker: guidelines :  this guideline is  not tested in this application 
   		- https://phoenixnap.com/kb/laravel-docker


## Running guide : once everything is setup 
## created default username /  password and seed to table user when run migration (defaultuser@email.com / 12345678)
  
  - Api using postman 
   	- API Credentials endpoint 
      	- login : /api/v1/login
       		- method: post
            - Param field: email, password 
            - Header: Accept: application/json
            - return token 
      	- user create: /api/v1/user/create
           - method: post 
           - Param field: name,email,password, password_confirmation
           - Header: Accept: application/json
        - logout : /api/v1/logout
        	- method: post 
        	- Header: Accept: application/json
        	- Header: Authorization: Bearer <token>
    - API event endpoint 
    	- Create : /api/v1/event/create
    	    - method: post 
    	    - Header: Accept: application/json
        	- Header: Authorization: Bearer <token>
        	- Body: Json 
        	   eg: 
        	   {
        	   	"eventName":"event",
        	   	"frequency":"Once-Off",
        	   	"startDateTime": "2024-08-14 13:00",
        	   	"duration": 30,
        	   	"invitees": [1],
        	   }

        - list: /api/v1/event/instance
        	- method: GET
        	- parameters (all optional)
        		- invitee eg: 1,2
        		- from eg : 2024-08-14 13:00
        		- to  eg: 2024-08-14 13:00
        	- Header: Accept: application/json
        	- Header: Authorization: Bearer <token>




## TO DO 
 - Editing Event 
    - only the user who created the event can edit the event 
    - validate if there is no overlap in the event 
  - Deleting Event 
    - only the user who created the event can remove the event 
  - Listing event:
    - validate the parameters from and to 
    	- TO should always be the future
    	- FROM and TO should always a valid date 
    	- invitee should only accept 1,2,3 format  

  - Update user 
     - change password 
     - change email : validate if the new email exist or used by other user 
     