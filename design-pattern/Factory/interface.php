<?php

interface TitleTemplate {
    public function getTemplateString(): string;
}

interface PageTemplete {
    public function getTemplateString(): string;
}

interface TemplateRenderer {

}


interface TemplateFactory
{
    public function createTitleTemplate(): TitleTemplate;
    public function createPageTemplate(): PageTemplete;
    public function getRenderer(): TemplateRenderer;
}


interface LampType {

}

interface TireType {

}

interface CarFactoryInterface {
    public function createBodyType(): BodyType;
    public function createLampType(): LampType;
    public function createTireType(): TireType;
}