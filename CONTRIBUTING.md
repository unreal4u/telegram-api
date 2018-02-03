# Want to colaborate?

Colaborations are **very** welcome!
You are free to do so, just send a pull request if you want to improve something. (Hint: [take a look at the open issues](https://github.com/unreal4u/telegram-api/issues)!) Try to respect the PSR-2 styling guide (or PSR-12 whenever it comes out). 

Instructions

* Clone this repo (or your fork)

* Execute: 
```bash
vagrant up # Might take a while :)
bash bin/composer-update.sh
cp examples/conf.php.sample examples/conf.php
# Don't forget to adjust values in your newly created examples/conf.php
```

* To unit test:
```bash
bash bin/run-tests.sh
```

* To unit test with code coverage, create a `phpunit.xml` (from the provided `phpunit.xml.dist`) and uncomment the logging options, then execute the following:
```bash
bash bin/run-tests.sh
```

Please note that running the unit tests with code coverage is a very slow process!

* That's all folks!
