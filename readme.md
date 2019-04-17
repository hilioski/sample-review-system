# Simple Review System


## Development Environment First Time Setup
### Linux
1. Add `127.0.0.1 simple-review-system.local` in your `/etc/hosts` file.
2. Run `make dev` from the root of the project to run it in development environment. 
3. Access it in your browser at: http://simple-review-system.local/

Those 3 steps are related to initial development environment setup. After that you can start the project with one simple command `make start`

## Running tests

### Unit

##### Full test suite
```bash
docker-compose run --rm --no-deps phpfpm composer phpunit
```


## Clean all project including MySQL data
1. Run `make down` command which will execute `docker-compose down` command for you.
2. Run `make dev` to build project from scratch.

### Description
In the `build.sh` file on Line: 3 you can see that `nginx-proxy` docker service will be started which will work on port 80, and all requests will be sent through them. When you create the project based on Docker, you only need to add `VIRTUAL_HOST` environment variable to the docker service which will be a server (nginx, apache ...). After that you should put this host in your hosts file and that's it, your project will be accessible through that hostname.

You can read more details about `nginx-proxy` at https://github.com/jwilder/nginx-proxy

