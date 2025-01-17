<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit92d784aa049ad09142b81285001e98b7
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Larataj\\XmlHelpers\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Larataj\\XmlHelpers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit92d784aa049ad09142b81285001e98b7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit92d784aa049ad09142b81285001e98b7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit92d784aa049ad09142b81285001e98b7::$classMap;

        }, null, ClassLoader::class);
    }
}
