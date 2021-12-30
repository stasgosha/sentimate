<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1d289055e6471c1b80ef3306e9cb93c9
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1d289055e6471c1b80ef3306e9cb93c9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1d289055e6471c1b80ef3306e9cb93c9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1d289055e6471c1b80ef3306e9cb93c9::$classMap;

        }, null, ClassLoader::class);
    }
}
