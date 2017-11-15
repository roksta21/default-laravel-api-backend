# Set Up
 - Clone the repo and run composer install
 - Copy .env.example to .env and input the correct database configuration.
 - Run ```php artisan migrate --seed```
 - Run ```php artisan passport:install``` and take note of the password_grant_id and secret generated

# Log In
To log in, send a post request to '/oauth/token' tith the following data
```javascript
{
    grant_type: 'password',
    client_id: 'password grant client id after running passport install',
    client_secret: 'password grant client secret after running passport install',
    username: 'from the login form'
    password: 'from the login form'
}
```

If the authentication fails, it will return 
```json
{"error":"invalid_credentials","message":"The user credentials were incorrect."}
```

If authentication is successful, it will return 
```json
{
    "token_type":"Bearer",
    "expires_in":31536000,
    "access_token":"long_string_access_token",
    "refresh_token":"long_string_refresh_token"
}
```
Save this in the local storage, you will need to send the access_token with each request for authenticated routes. Create a hedder in axios that fetches this token if set.
```javascript
window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + 'the_access_token';
```
# Register
## Request
```javascript
{
    type: 'post',
    url: '/api/register',
    form_data: {
        name: 'name',
        email: 'email',
        password: 'password',
        password_confirmation: 'password confirmation'
    }
}
```

## Response
### Success
```javascript
{
    user: {
        id: 'id',
        name: 'name',
        email: 'email'
    } 
}
```
### Error
```javascript
{
    "message": "error message",
    "errors": {
        'field_name': 'error data'
    }
}
```
### Fatal Error
```javascript
{
    message: 'Error message'
}
```
# Public
## Get Bus Routes
### Request
```javascript
{
    type: 'get',
    url: '/api/fetch-bus-routes'
}
```
### Response
#### Success
```javascript
{
    routes: [{to: 'destination', from: 'origin'}]
}
```
#### Fatal Error
```javascript
{
    message: 'error message'
}
```

## Search
### Request
```javascript
{
    type: 'post',
    url: '/api/v1/search',
    form_data: {
        to: 'Nairobi',
        from: 'Mombasa',
        travel_date: '20-10-2012'
    }
}
```
### Response
#### Success
```javascript
[{
    "bus_trip_id": 1,
    "bus_company": "Modern Coast",
    "from": "Nairobi",
    "to": "Mombasa",
    "departure": "Wed, Oct 18, 2017 9:51 AM",
    "pricing": {
        "vip": 3251,
        "business": 2674,
        "economy": 1323
    }
}]
```
#### Error
No results would return an empty array.

## Show bus layout
### Request
```javascript
{
    type: 'get',
    url: '/api/v1/trips/{bus_trip_id: 'from search response'}'
}
```
### Response
#### Success
```javascript
{
    "bus_trip_id": 1,
    "bus_company": "Modern Coast",
    "from": "Nairobi",
    "to": "Mombasa",
    "departure": "Wed, Oct 18, 2017 9:51 AM",
    "pricing": {
        "vip": 3251,
        "business": 2674,
        "economy": 1323
    },
    "layout" => []
}
```
Sample layout is contained in ```BusTemplatesTableSeeder::class```
#### Error
```javascript
{
    message: 'error message'
}
```