<?php

/**
 * Contao Open Source CMS
 * 
 * Copyright (C) 2005-2015
 * 
 * @package befilemanagerfavs
 * @link    http://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'befilemanagerfavs' => 'system/modules/be_filemanagerFavs/befilemanagerfavs.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_filemanagerFavs'         => 'system/modules/be_filemanagerFavs/templates',
));
