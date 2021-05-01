<?php

abstract class Utility
{

    public static function redirect(string $path): void
    {
        header("Location: " . $GLOBALS['SITE_NAME'] . $path);
    }
}
