# Todo List with Lumen [BE]

In this project we have created a RESTful API backend for a Todo application, based on PHP Lumen framework. The app allows only authenticated users to manage their own todos, while being able to categorise them.

This application allows you to manage todo tasks with all API that you might need to build a front end application.
<br>
In addition to the basic features, it has the following:
- Reset Password Feature (By email)
- Sends email notification on registration
- List Tasks with all filter, sort, and pagination features

Now let's jump into the project testing :D

## Prerequisite 
- Docker and docker-compose installed in minimal version 1.24. You can check version with docker-compose -v If you're missing this requirement please refer docker-installation.md file.


## Insallation 

1. Clone this repository by running the following command in the desired directory:
```bash
git clone https://github.com/mhmdmousawi/todolumen.git
```

2. Change directory to access the root folder of the project:
```bash
cd todolumen
```

3. Run the docker container to start the project:
```bash
docker-compose up -d --build database && docker-compose up -d --build app && docker-compose up -d --build web
```

4. Access the container:
```bash
docker exec -it lumen_app bash
```

5. Run the migrations inside the container, and then clear the cache:
```bash
php artisan migrate
php artisan cache:clear
```
## Configuration

- In `.evn.prod` Set your mailer according to your own credentials in order to check the emails sent upon registering a new user or on password reset

To do that you can register to a cool tool called mailtrap (https://mailtrap.io/)
and get the configuration details from the settings section 

Note: Choose Laravel as the project for integration 
<br> 
Example: 
```bash 
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=313e5dfcbe3a5e
MAIL_PASSWORD=0d562b65d84515
MAIL_ENCRYPTION=tls
```
## Testing
Now that you have set your project up, it's time for fun testing. <br>
Since this is a Back End application, so you will have to download Postman (https://www.postman.com/downloads/)

Now to help you check all the API endpoints, I have prepared a Postman Collection that you can download as well:
https://drive.google.com/drive/folders/1aGWLXOk5IVAxol1lPrOKi6yv_ECMaD7d?usp=sharing

Happy Testing! :)
