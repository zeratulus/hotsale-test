<?php

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

final class Template
{
    private array $data = [];

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function render($template): string
    {
        // specify where to look for templates
        $loader = new FilesystemLoader(DIR_TEMPLATE);

        // initialize Twig environment
        $config = [
            'autoescape' => false,
        ];

        if ((defined('TWIG_CACHE') && constant('TWIG_CACHE'))) {
            $config['cache'] = DIR_CACHE;
        }

        $twig = new Environment($loader, $config);

        try {
            // load template
            $template = $twig->load($template . '.twig');

            return $template->render($this->data);
        } catch (Exception $e) {
            return "Error: Could not load template {$template}!";
        }
    }

}
