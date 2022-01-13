<?php

namespace Concrete\Package\V9PackageBoilerplate\Theme\ThemeBoilerplate;

use Concrete\Core\Page\Theme\Theme;

class PageTheme extends Theme
{
    public function getThemeName()
    {
        return t('Boilerplate');
    }

    public function getThemeDescription()
    {
        return t('A Concrete CMS Theme.');
    }
}
