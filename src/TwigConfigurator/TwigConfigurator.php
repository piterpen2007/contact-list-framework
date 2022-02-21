<?php

namespace EfTech\ContactList\Infrastructure\TwigConfigurator;

use EfTech\ContactList\Infrastructure\ViewTemplate\TwigTemplate;

/**
 *  Конфигуратор twig
 */
class TwigConfigurator
{
    /**
     * Класс загрузки расширений для форм twig
     *
     * @var TwigFormatter
     */
    private TwigFormatter $twigFormatter;

    /**
     * @param TwigFormatter $twigFormatter - Класс загрузки расширений для форм twig
     */
    public function __construct(TwigFormatter $twigFormatter)
    {
        $this->twigFormatter = $twigFormatter;
    }

    /**
     * Конфигурация twig
     *
     * @param TwigTemplate $twigTemplate
     *
     * @return void
     */
    public function configure(TwigTemplate $twigTemplate): void
    {
        $this->twigFormatter->getEnabledFormatters($twigTemplate);
    }


}