<?php

namespace Kanboard\Plugin\MatomoAnalytics;

use Kanboard\Core\Plugin\Base;
use Kanboard\Core\Translator;

class Plugin extends Base
{
    public function initialize()
    {
        // CSS - Asset Hook
        //  - Keep filename lowercase
        $this->hook->on('template:layout:css', array('template' => 'plugins/MatomoAnalytics/Assets/css/matomo-analytics.css'));

        // Views - Template Hook
        //  - Override name should start lowercase e.g. pluginNameExampleCamelCase
        $this->template->hook->attach('template:layout:head', 'matomoAnalytics:layout/head');
        $this->template->hook->attach('template:layout:bottom', 'matomoAnalytics:layout/bottom');
        $this->template->hook->attach('template:config:sidebar', 'matomoAnalytics:config/sidebar');

        // MATOMO SETTINGS Page - Routes
        $this->route->addRoute('/settings/matomo', 'MatomoAnalyticsController', 'show', 'MatomoAnalytics');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginName()
    {
        // Plugin Name MUST be identical to namespace for Plugin Directory to detect updated versions
        return 'MatomoAnalytics';
    }

    public function getPluginDescription()
    {
        return t('Connect your Kanboard instance to Matomo Ananlytics to track visitors to your site.');
    }

    public function getPluginAuthor()
    {
        return 'aljawaid';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getCompatibleVersion()
    {
        // Examples:
        // >=1.0.37
        // <1.0.37
        // <=1.0.37
        return '>=1.2.20';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/aljawaid/MatomoAnalytics';
    }
}
