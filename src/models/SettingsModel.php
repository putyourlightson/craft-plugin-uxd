<?php
/**
 * @copyright Copyright (c) PutYourLightsOn
 */

namespace putyourlightson\pluginuxd\models;

use craft\base\Model;

class SettingsModel extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $templateFolderPath;

    /**
     * @var string
     */
    public $cssFilePath;

    /**
     * @var string
     */
    public $jsFilePath;
}
