<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc85e7a7ce4e851f1f9b0327bac2bd7d0
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc85e7a7ce4e851f1f9b0327bac2bd7d0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc85e7a7ce4e851f1f9b0327bac2bd7d0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc85e7a7ce4e851f1f9b0327bac2bd7d0::$classMap;

        }, null, ClassLoader::class);
    }
}
