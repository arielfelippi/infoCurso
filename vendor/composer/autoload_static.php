<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit40a8289e916862b69cc577c2026f9739
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Pecee\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Pecee\\' => 
        array (
            0 => __DIR__ . '/..' . '/pecee/simple-router/src/Pecee',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit40a8289e916862b69cc577c2026f9739::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit40a8289e916862b69cc577c2026f9739::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}