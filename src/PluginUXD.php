<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\pluginuxd;

use Craft;
use craft\base\Plugin;
use craft\events\RegisterUrlRulesEvent;
use craft\web\twig\variables\CraftVariable;
use craft\web\UrlManager;
use putyourlightson\pluginuxd\models\SettingsModel;
use putyourlightson\pluginuxd\variables\PluginUXDVariable;
use yii\base\Event;

class PluginUXD extends Plugin
{
    /**
     * @var PluginUXD
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();

        self::$plugin = $this;

        // Register variable
        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event) {
            /** @var CraftVariable $variable */
            $variable = $event->sender;
            $variable->set('pluginUXD', PluginUXDVariable::class);
        });

        // Register CP URL rules event
        Event::on(UrlManager::class, UrlManager::EVENT_REGISTER_CP_URL_RULES, function(RegisterUrlRulesEvent $event) {
            $event->rules = array_merge($event->rules, [
                'plugin-uxd' => 'plugin-uxd/routing/route',
                'plugin-uxd/<template>' => 'plugin-uxd/routing/route',
            ]);
        });

    }

    /**
     * @inheritdoc
     */
    public function getCpNavItem()
    {
        $settings = $this->getSettings();

        $parent = parent::getCpNavItem();
        $parent['label'] = $settings->navLabel ?: $parent['label'];
        $parent['icon'] = $settings->navIconMaskPath ?: $parent['icon'];

        return $parent;
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): SettingsModel
    {
        return new SettingsModel();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml()
    {
        return Craft::$app->getView()->renderTemplate('plugin-uxd/settings', [
            'settings' => $this->getSettings()
        ]);
    }
}