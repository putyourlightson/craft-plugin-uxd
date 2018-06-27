<p align="center"><img width="200" src="src/icon.svg"></p>

# Plugin UXD for Craft CMS 3

The Plugin UXD plugin is a user experience designer for plugin control panel pages in [Craft CMS](https://craftcms.com/).

It provides a set of typography, field and table elements that enables you to quickly design and develop your plugin control panel pages. 

<p><img src="docs/images/typography-1.0.0.png"></p>
<p><img src="docs/images/fields-1.0.0.png"></p>
<p><img src="docs/images/tables-1.0.0.png"></p>

## Requirements

Craft CMS 3.0.0 or later.

## Installation

To install the plugin, search for "Plugin UXD" in the Craft Plugin Store, or install manually using composer.

        composer require putyourlightson/craft-plugin-uxd

## Settings

**Navigation Label**  
The label to give the plugin in the navigation sidebar.

**Navigation Icon Mask File Path**  
The full path to an icon mask SVG file to show in the navigation sidebar. It can begin with an alias, such as `@root`.

**Template Folder Path**  
The full path to your template folder. It can begin with an alias, such as `@root`.

Any references to your templates (included or extended) should be written as plugin-uxd/temp/{template-path}, for example:

    {% include "plugin-uxd/temp/_includes/header" %}

The stylesheet is always available at /admin/plugin-uxd/stylesheet

<p><img src="docs/images/settings-1.0.0.png"></p>

<small>Created by [PutYourLightsOn](https://www.putyourlightson.net/).</small>
