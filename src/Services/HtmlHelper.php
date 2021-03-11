<?php

namespace App\Services;

use Twig\Environment;

class HtmlHelper
{
    private $twig;

    const DIR = 'snippets/';

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function sectionTitle($h2, $text)
    {

        return $this->twig->render(self::DIR . 'section_label.html.twig', [
            'h2' => $h2,
            'text' => $text,
        ]);
    }
}