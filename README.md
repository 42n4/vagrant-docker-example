# Development environment using Vagrant and Docker

This is an example project on how to use Vagrant and Docker to build development environments. It consists of a simple
web application and a Vagrantfile that makes use of several Dockerfiles to create the development environment. The
example consists of two parts: a simpler and a more complex part.

## Single container development environment

The simplest part, consists of a single container that makes use of the internal built-in PHP web server to run the
application. To run this single container you have to execute from the directory root

```bash
$ vagrant up php
```

## Multi container development environment

Aditionally, an example of a development environment consisting of multiple containers is provided. To run it you have
to execute this command in the application root directory

```bash
$ vagrant up --no-parallel
```