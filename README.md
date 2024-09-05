- Clone the repository.

- Create a ```.env``` file from ```.env.example``` and configure.

- Start Docker Compose: Run the following command to bring up the containers:

```docker compose up```

- Start queues: Run the command to start the queue worker:

```docker exec -it test_task-php-apache-dev-1 php artisan queue:work```

- Testing via PhpStorm: If you're using PhpStorm, there is a file located at /.requests/submission.http for testing the API.

- Testing via Postman or Curl: You can also use Postman or curl to send requests to the API:
```
curl -X POST http://localhost/api/submissions \
-H "Content-Type: application/json" \
-d '{"name": "John Doe", "email": "john.doe@example.com", "message": "Test message"}'
```

- To run the tests, execute the following command from the root directory of the project:

```docker exec -it test_task-php-apache-dev-1 php artisan test```
