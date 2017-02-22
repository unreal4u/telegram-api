# Examples directory

This directory contains some of the examples this package is able to perform. Some have a screenshot to clarify in an
instant what the intent of the action is.

## Usage

Ensure you have copied `conf.php-sample` to `conf.php` and have edited the needed constants with the correct values.
After that, you can execute the following to execute an example:

```bash
vagrant up
vagrant ssh
cd /vagrant/examples
php send-video.php
```
