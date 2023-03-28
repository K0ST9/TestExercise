# About Application

1. Copy `.env.example` to `.env` file anf fill the values if need 
2. Run `docker-compose up` form the directory root
3. Now you can call the API described in http://localhost:8100/


### Workflow
1. All routes are described in `routes/api.php`
2. For every route there is an action in the `App\Http\Controllers\VisitsController`
3. Income request and validation rules are described in the `App\Http\Requests` namespace
4. The main logic is in the service class `App\Services\VisitsCountProcessor`
5. By default, logs are written to the `storage\logs\laravel.log` file

## N.B.
1. Documentation is described in `docs\openapi.yaml` file and is proxied by `swagger_ui` container
2. `pgsql` container is just need for the `laravel/telescope` package for local debugging
