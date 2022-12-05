## Laravel 9 REST API Example

Laravel 9.42.1

Example REST API - companies, employees CRUD 


##### Info
This API uses Bearer authentication, grab a login details in here:
`http://localhost/api/auth/register`

`POST: name, email, password, c_password` to register.

Once you have your account you can:
`POST: email, password` to `http://localhost/api/auth/login` to get access token.


##### CRUD URLs
`Companies end points`

    GET api/companies           - show all companies 
    POST api/companies          - add new company
    PUT api/companies/{id}      - update existing company
    DELETE api/companies/{id}   - delete extisting company & it's employees

`Employees end points`

    GET api/employees           - show all employees
    POST api/employees          - add new employee
    PUT api/employees/{id}      - update existing employee
    DELETE api/employees/{id}   - delete extisting employee

`Laravel edit & create form views are not supported!`
