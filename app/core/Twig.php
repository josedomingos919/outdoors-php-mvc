<?php

namespace App\Core;

class Twig
{
    public static function render($path = "", $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\..\view');
        $twig   = new \Twig\Environment($loader, []);
        $super  = new Super();

        echo $twig->render($path . '.twig', array_merge($data, ['super' => $super]));
    }

    public static function getHtml($path = "", $data = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '\..\view');
        $twig   = new \Twig\Environment($loader, []);
        $super  = new Super();
        $html =  $twig->render($path . '.twig', array_merge($data, ['super' => $super]));

        return new \Twig\Markup($html, 'UTF-8');
    }
}
