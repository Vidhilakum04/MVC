<?php

spl_autoload_register(function ($className) {
    $classPath = str_replace("_", "/", $className);
    echo $classPath;
    @include getcwd() . "/lib/log/" .  $classPath . '.php'; //@include==not getting warning
});
