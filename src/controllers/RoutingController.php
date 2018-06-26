<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\pluginuxd\controllers;

use Craft;
use craft\helpers\FileHelper;
use craft\web\Controller;
use putyourlightson\pluginuxd\models\SettingsModel;
use putyourlightson\pluginuxd\PluginUXD;
use yii\base\ErrorException;

class RoutingController extends Controller
{
    public function actionRoute(string $template = 'index')
    {
        /** @var SettingsModel $settings */
        $settings = PluginUXD::$plugin->getSettings();

        if ($template === 'stylesheet' || empty($settings->templateFolderPath)) {
            return $this->renderTemplate('plugin-uxd/stylesheet');
        }

        $templateFolderPath = FileHelper::normalizePath(Craft::getAlias($settings->templateFolderPath));

        if (!is_dir($templateFolderPath)) {
            throw new ErrorException('The template folder path is not valid: '.$settings->templateFolderPath);
        }

        $filename = $template.'.html';

        if (!is_file($templateFolderPath.'/'.$filename)) {
            throw new ErrorException('The template file could not be found: '.$templateFolderPath.'/'.$filename);
        }

        $tempPath = PluginUXD::$plugin->getBasePath().'/templates/temp';

        if (!is_dir($tempPath)) {
            FileHelper::createDirectory($tempPath);
        }

        FileHelper::copyDirectory($templateFolderPath, $tempPath);

        return $this->renderTemplate('plugin-uxd/temp/'.$template);
    }
}
