<p align="center"> <b>PetroApp tasks </b> </p>
<p align="center"> Task 1 (Multi-Vendor Portal) :BackEnd </p>

## Requirements:
- Customer Registration (Customer name, Email, Password)
- Customer Login Can login with Email/Password.
- Logged Customer Can do the below
** Create Users that can login to the solution.
** (List/Delete) Sales module
- Logged users created by Customers can do the below
** (Create/Delete/List his own) Sales module
> Sales table: (id,date,payments,created_by) eg: ('1','2021-05-28', '100,000','10'),
('2','2020-03-15', '20,0000','10')

``` 
    Platform: Laravel 8.
```

## run project by command line:

``` 
    $ git clone https://github.com/harbii/PetroAppTasks.git mahmoudSamyTask
    $ cd mahmoudSamyTask
    $ composer install
    $ cp .env.example .env
    // set database name in .env file and create databese by that name
    $ nano .env
    $ php artisan migrate
    4 ./vendor/bin/phpunit // to run unit test by phpunit
    $ php artisan serve    // to run unit test by server
```
