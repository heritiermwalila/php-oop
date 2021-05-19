<?php

abstract class BasePageTemplate implements PageTemplete {
    protected $titleTemplate;
    public function __construct(TitleTemplate $titleTemplate){
        $this->titleTemplate = $titleTemplate;
    }
    public function getTemplateString(): string
    {
        // TODO: Implement getTemplateString() method.
    }
}

class TwigTemplate implements TemplateFactory {
    public function createPageTemplate(): PageTemplete
    {
        // TODO: Implement createPageTemplate() method.
    }

    public function createTitleTemplate(): TitleTemplate
    {
        // TODO: Implement createTitleTemplate() method.
        return new TwigTitleTemplate();
    }

    public function getRenderer(): TemplateRenderer
    {
        // TODO: Implement getRenderer() method.
    }
}

class TwigTitleTemplate implements TitleTemplate {
    public function getTemplateString(): string
    {
        // TODO: Implement getTemplateString() method.
        return "<h1>{{ title }}</h1>";
    }
}

class TwigPageTemplate extends  BasePageTemplate{
    public function getTemplateString(): string
    {
        $renderedTitle = $this->titleTemplate->getTemplateString();
        return <<<HTML
            <div class="page"></div>
                $renderedTitle
                <article>{{ content }}}</article>
            HTML;

        // TODO: Implement getTemplateString() method.

    }
}