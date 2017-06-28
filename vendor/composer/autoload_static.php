<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6f03440b709c4e1697b0618806de7eb3
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'KilroyWeb\\EmailVerification\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'KilroyWeb\\EmailVerification\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6f03440b709c4e1697b0618806de7eb3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6f03440b709c4e1697b0618806de7eb3::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
