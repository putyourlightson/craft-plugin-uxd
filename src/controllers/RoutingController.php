<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\pluginuxd\controllers;

use Craft;
use craft\web\Controller;
use putyourlightson\pluginuxd\models\SettingsModel;
use putyourlightson\pluginuxd\PluginUXD;
use yii\base\ErrorException;

class RoutingController extends Controller
{
    public function actionRoute()
    {
        /** @var SettingsModel $settings */
        $settings = PluginUXD::$plugin->getSettings();

        if (empty($settings->templateFilePath)) {
            return $this->redirect('plugin-uxd/stylesheet');
        }

        $view = Craft::$app->getView();
        $templateMode = $view->getTemplateMode();
        $view->setTemplateMode($view::TEMPLATE_MODE_SITE);
        $siteTemplatesPath = $view->getTemplatesPath();
        $view->setTemplateMode($templateMode);

        $templateFilePath = trim($settings->templateFilePath, '/').'.html';

        if (!is_file($siteTemplatesPath.'/'.$templateFilePath)) {
            throw new ErrorException('The template file path is not valid: '.$settings->templateFilePath);
        }

        $basePath = PluginUXD::$plugin->getBasePath();

        if (!is_dir($basePath.'/templates/temp')) {
            mkdir($basePath.'/templates/temp');
        }

        copy($siteTemplatesPath.'/'.$templateFilePath, $basePath.'/templates/temp/index.html');

        return $this->renderTemplate('plugin-uxd/temp/index');
    }
}
