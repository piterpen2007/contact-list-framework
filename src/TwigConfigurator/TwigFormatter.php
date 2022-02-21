<?php

namespace EfTech\ContactList\Infrastructure\TwigConfigurator;

use EfTech\ContactList\Infrastructure\ViewTemplate\TwigTemplate;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\FormRenderer;
use Twig\Environment;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

/**
 *  Класс загрузки расширений форм в twig
 */
class TwigFormatter
{
    public function getEnabledFormatters(TwigTemplate $twig): Environment
    {
        $twigExt = $twig->getTwig();
        $defaultFormTheme = 'form_div_layout.html.twig';
        $formEngine = new TwigRendererEngine([$defaultFormTheme], $twigExt);
        $twigExt->addRuntimeLoader(
            new FactoryRuntimeLoader([
                FormRenderer::class => function () use ($formEngine) {
                    return new FormRenderer($formEngine);
                },
            ])
        );

        $twigExt->addExtension(new TranslationExtension());

        $twigExt->addExtension(new FormExtension());


        return $twigExt;
    }

}