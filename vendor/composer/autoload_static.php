<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd8581c6fb85271430ece356c86f83d6f
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'App\\DB\\Database' => __DIR__ . '/../..' . '/src/DB/Database.php',
        'App\\core\\CRUD\\CRUD' => __DIR__ . '/../..' . '/src/core/CRUD/CRUD.php',
        'App\\core\\CRUD\\CRUDC' => __DIR__ . '/../..' . '/src/core/CRUD/CRUDC.php',
        'App\\core\\CRUD\\CRUDG' => __DIR__ . '/../..' . '/src/core/CRUD/CRUDG.php',
        'App\\core\\Comment' => __DIR__ . '/../..' . '/src/core/Comment.php',
        'App\\core\\Group' => __DIR__ . '/../..' . '/src/core/Group.php',
        'App\\core\\User' => __DIR__ . '/../..' . '/src/core/User.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd8581c6fb85271430ece356c86f83d6f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd8581c6fb85271430ece356c86f83d6f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd8581c6fb85271430ece356c86f83d6f::$classMap;

        }, null, ClassLoader::class);
    }
}
