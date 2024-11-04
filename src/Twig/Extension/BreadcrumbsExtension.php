<?php

namespace App\Twig\Extension;

use App\Entity\Category;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BreadcrumbsExtension extends AbstractExtension
{
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('breadcrumbs', [$this, 'generateBreadcrumbs'], ['is_safe' => ['html']]),
        ];
    }

    public function generateBreadcrumbs(?Category $category): string
    {
        if (!$category) {
            return '';
        }

        $breadcrumbs = [];
        while ($category) {
            $url = $this->urlGenerator->generate('app_category_show', ['id' => $category->getId()]);
            $breadcrumbs[] = sprintf('<a href="%s">%s</a>', $url, htmlspecialchars($category->getName(), ENT_QUOTES));
            $category = $category->getParent();
        }

        // Reverse to start from the root category
        $breadcrumbs = array_reverse($breadcrumbs);

        return implode(' / ', $breadcrumbs);
    }
}
