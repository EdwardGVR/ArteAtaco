<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit771ad1f58b6f01f8ff1e8363056a3019
{
    public static $prefixesPsr0 = array (
        'I' => 
        array (
            'Imagine' => 
            array (
                0 => __DIR__ . '/..' . '/imagine/imagine/lib',
            ),
            'Imagick' => 
            array (
                0 => __DIR__ . '/..' . '/calcinai/php-imagick/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit771ad1f58b6f01f8ff1e8363056a3019::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}