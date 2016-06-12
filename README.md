This is an example demonstrating how to use the [sobolan/rest-negotiator](https://github.com/SoboLAN/rest-negotiator) library.

After cloning and installing the dependencies, the application is ready to go.

Feel free to explore the bundle for a better understanding about how it's used. It's kept very minimal, for an easy browse.

Don't forget to read the documentation of **sobolan/rest-negotiator** for more details.

# Examples

For "negotiating" the content, we rely solely on the **Accept** and **Content-Type** HTTP headers.

So, let's get a user:

```
GET http://localhost/rest-negotiator-example/web/app_dev.php/user/54321
Accept: application/myapp;format=json;version=1
```

Response:

```json
{
  "results": {
    "id": "54321",
    "name": "sobolan",
    "email": "radu.murzea@gmail.com",
    "age": 12345,
    "address": {
      "street": "somestreet",
      "nr": 12345,
      "city": "mycity",
      "country": "somebadcountry"
    }
  }
}
```

Now, if we change the format to "xml":

```
GET http://localhost/rest-negotiator-example/web/app_dev.php/user/54321
Accept: application/myapp;format=xml;version=1
```

we get this:

```xml
<?xml version="1.0"?>
<response>
    <results>
        <id>54321</id>
        <name>sobolan</name>
        <email>radu.murzea@gmail.com</email>
        <age>12345</age>
        <address>
            <street>somestreet</street>
            <nr>12345</nr>
            <city>mycity</city>
            <country>somebadcountry</country>
        </address>
    </results>
</response>
```

Getting back to json format and changing the version to "2":

```
GET http://localhost/rest-negotiator-example/web/app_dev.php/user/54321
Accept: application/myapp;format=json;version=2
```

we get:

```json
{
  "results": {
    "name": "sobolan",
    "email": "radu.murzea@gmail.com",
    "age": 12345,
    "address": {
      "street": "somestreet",
      "city": "mycity",
      "country": "somebadcountry"
    }
  }
}
```

Notice that the "id" information is missing.

Switching to version "3":

```
GET http://localhost/rest-negotiator-example/web/app_dev.php/user/54321
Accept: application/myapp;format=json;version=3
```

we get a response without the address:

```json
{
  "results": {
    "name": "sobolan",
    "email": "radu.murzea@gmail.com",
    "age": 12345
  }
}
```

Easy, right ?