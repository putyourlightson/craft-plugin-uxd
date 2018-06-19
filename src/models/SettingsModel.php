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
    public $navLabel;

    /**
     * @var string
     */
    public $navIconMaskPath;

    /**
     * @var string
     */
    public $templateFilePath;

    /**
     * @var string
     */
    public $cssFilePath;

    /**
     * @var string
     */
    public $jsFilePath;
}
