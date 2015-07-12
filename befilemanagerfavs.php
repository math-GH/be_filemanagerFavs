<?php

if (!defined('TL_ROOT'))
  die('You cannot access this file directly!');

/* * *
 * Contao Open Source CMS
 * Copyright (C) 2005-2015 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  µaTh 2015 
 * @author     µaTh
 * @package    befilemanagerfavs
 * @license    GNU/LGPL 
 * @filesource
 *
 */

class befilemanagerfavs extends BackendModule {
    public function compile() {
    
    }
  
    //put your code here
    function __construct() {
        // Super-Konstruktor (von BackendModule) aufrufen
        parent::__construct();
        
    }
    
    function insertFavs($strContent, $strTemplate) {
        if (($strTemplate == "be_main" && strpos($strContent, "header_new_folder")>0) || ($strTemplate == "be_picker")|| ($strTemplate == "be_files")){
            $text = "<div class='tl_listing_container' style='margin-top:10px'><script>";
            $path = explode(";", $GLOBALS["TL_CONFIG"]['filemanagerFavs']);
            for ($i = 0; $i < count($path); $i++) {
                $text = $text.'document.write("<div style=\"margin-right:10px;white-space:nowrap;display:inline-block;\"><a href=\""+window.location+"&node='.trim($path[$i]).'\" title=\"Zeige nur Ordner: '.trim($path[$i]).'\">&#10026; '.trim($path[$i]).'</a></div>");';
            }
            $text .= "</script></div>";
            //$text .= "document.write(window.location+'&node=".$path[0]."')</script>";
            
            $strContent = str_replace('<div class="tl_listing_container tree_view" id="tl_listing">', $text.'<div class="tl_listing_container tree_view" id="tl_listing">', $strContent);
            
            return $strContent;
        }
        

        
        return $strContent;
    }
}
