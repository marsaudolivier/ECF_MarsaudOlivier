<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit999f755cc23c31014db56d4729135215
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit999f755cc23c31014db56d4729135215::$classMap;

        }, null, ClassLoader::class);
    }
}
