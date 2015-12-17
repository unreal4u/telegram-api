Telegram Log 
======

Enables sending messages to Telegram via Monolog.

Credits
--------

This class is made by unreal4u (Camilo Sperberg). [unreal4u.com/](http://unreal4u.com).

About this class
--------

* Can be used to verify whether a process is already running or not.
* Is platform independant: Can be used in Windows or Linux. In both, they will call OS specific functions to find out whether the process is running or not.
* It does not detect previous fatal errors, but it can omit the previous PID file if a given time has passed since the creation.

Detailed description
---------

This package will check if a certain PID file is present or not, and depending on that will:

Create a PID file.
If it already exists, will ask the OS to check whether it is still a running process.
If for whatever reason, the OS still thinks the process is still running and too much time has passed, the class can overwrite the previous PID file (Thus initiating a new instance).
When the object is destroyed, the corresponding PID file will be deleted as well.

Basic usage
----------

<pre>include('src/unreal4u/pid.php');
try {
    $pid = new unreal4u\pid();
} catch (\Exception $e) {
    echo $e->getMessage();
}

if ($pid->isAlreadyRunning) {
    echo 'Your process is already running';
}
</pre>
* `$pid->pid` will show you the pid number.
* **Please see examples for more options and advanced usage**
* There is only one caveat: if you are going to use this class inside a method within a class, ensure that the destructor gets executed when it should: variables are immediatly destroyed after the method finishes executing, so the PID will be destroyed as well. To ensure this, assign the PID class to an object inside the class, that way, whenever that object gets destroyed, this class will be as well.

