<?php

namespace Concrete\Package\V9PackageBoilerplate\Theme\ThemeBoilerplate;

use Concrete\Core\Page\Theme\BedrockThemeTrait;
use Concrete\Core\Page\Theme\Color\Color;
use Concrete\Core\Page\Theme\Color\ColorCollection;
use Concrete\Core\Page\Theme\Theme;

class PageTheme extends Theme
{
    use BedrockThemeTrait {
        getColorCollection as getBedrockColorCollection;
    }

    public function getThemeName()
    {
        return t('Boilerplate');
    }

    public function getThemeDescription()
    {
        return t('A Concrete CMS Theme.');
    }

    public function getColorCollection(): ?ColorCollection
    {
        $defaultBedrockColors = $this->getBedrockColorCollection();
        $defaultBedrockColors->add(new Color('fun', t('Fun')));
        $defaultBedrockColors->remove('dark');

        return $defaultBedrockColors;
    }
}
