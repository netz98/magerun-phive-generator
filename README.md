# Phive XML Generator

Generates a phive.xml file for your phar files to publish them.
The tool is inspired by Sebastian Bergmann's tool [phar-site-generator](https://github.com/sebastianbergmann/phar-site-generator).

## Installation

```shell
composer install
```

## Setup

Copy the file `.env.dist` to `.env` and set the base url of your phar files.
The phar files must be accessable.

Set the path to your .phar files on your local machine.

## Run

```shell
php bin/phive_generate.php > path/to/your/phive.xml
```

## License

MIT
