<?php

/**
 * All routes array
 */


$routesMap = [
    "^$" => ["controller" => "Pages", "method" => "Index"],
    "^register/?$" => ["controller" => "Users", "method" => "Register"],
    "^login/?$" => ["controller" => "Users", "method" => "Login"],
    "^about-framework/?$" => ["controller" => "Pages", "method" => "aboutFramework"],
    "^logout/?$" => ["controller" => "Users", "method" => "Logout"],
    "^tasks/page/?(?P<page>[0-9]+)?$" => ["controller" => "Pages", "method" => "Index"],
    "^(?P<controller>[a-z-]+)/?(?P<method>[a-z-]+)?/(?P<id>[0-9]+)?/?$" => [],
];