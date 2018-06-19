<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\pluginuxd\controllers;

use Craft;
use craft\web\Controller;
use craft\web\View;
use putyourlightson\pluginuxd\PluginUXD;
use yii\base\ErrorException;

class RoutingController extends Controller
{
    public function actionRoute()
    {
        /** @var SettingsModel $settings */
        $settings = PluginUXD::$plugin->getSettings();

        if (empty($settings->templateFolderPath)) {
            return;
        }

        //$view = Craft::$app->getView();

        // Get template mode so we can reset later
        //$templateMode = $view->getTemplateMode();

        // Set template mode to front-end site
        //$view->setTemplateMode(View::TEMPLATE_MODE_SITE);

        $templateFolderPath = '/Users/ben/Sites/craft3/templates'.'/'.trim($settings->templateFolderPath, '/').'/';

        // Reset template mode
        //$view->setTemplateMode($templateMode);

        if (!is_dir($templateFolderPath)) {
            throw new ErrorException('The template folder path is not valid: '.$templateFolderPath);
        }

        if (!($handle = opendir($templateFolderPath))) {
            throw new ErrorException('Unable to open the template folder path: '.$templateFolderPath);
        }

        $templates = [];

        while (($filename = readdir($handle)) !== false) {
            if ($filename[0] != '.') {
                $template = substr($filename, 0, strpos($filename, '.'));
                $templates[$template] = $templateFolderPath.$filename;
            }
        }

        closedir($handle);

        if (isset($templates['index'])) {
            $html = file_get_contents($templates['index']);

            return $this->renderFile($templates['index']);
        }

        return $this->redirect('plugin-uxd/stylesheet');
    }
}
