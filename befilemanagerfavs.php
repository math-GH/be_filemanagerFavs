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
        if (($strTemplate == "be_main" && $_GET["do"]== "files") || ($strTemplate == "be_picker")|| ($strTemplate == "be_files")){
            
            $template = new BackendTemplate('be_filemanagerFavs');
            $template->lang = (object) $GLOBALS['TL_LANG']['be_filemanagerFavs'];

            
            
            // hole die Einstellungen (Format: OrdnerPfad1|Beschreibung1;OrdnerPfad2|Beschreibung2 usw.)
            $path = explode(";", $GLOBALS["TL_CONFIG"]['filemanagerFavs']);
            $fav = 0;
            
            
            for ($i = 0; $i < count($path); $i++) {
                $ordnerbeschreibung = explode("|",trim($path[$i])); // [0] => OrdnerPfad; [1] => optionale Beschreibung
                $ordner = trim($ordnerbeschreibung[0]); //Leerzeichen vor und nach dem OrdnerPfad entfernen
                
                
                // Pruefen, ob User ueberhaupt Zugriff auf den Ordner hat
                if (\BackendUser::getInstance()->hasAccess($ordner, 'filemounts')) {
                    
                    if (count($ordnerbeschreibung)>1) { // falls Beschreibung vorhanden ist
                        $beschreibung = trim($ordnerbeschreibung[1]); // Beschreibung = Beschreibung
                        } 
                        else {
                            $beschreibung = $ordner; // Beschreibung = Ordnerpfad
                    }

                    $favorites[$fav][0] = $ordner;
                    $favorites[$fav][1] = $beschreibung;
                    

                    $fav++;
                }
            }
            
            $link = $_SERVER['PHP_SELF']."?";
            foreach ($_GET as $key => $value) {
                        $link.= $key."=".$value."&amp;";
            }

            $link .= "rt=".REQUEST_TOKEN;
            $template->link = $link;
            $template->favorites = $favorites;

            //$template->content = $jsScriptContent;
            //$text .= "</script></div>";
            //$text .= "document.write(window.location+'&node=".$path[0]."')</script>";
            
            
            $text = $template->parse();
            
            $strContent = str_replace('<div class="tl_listing_container tree_view" id="tl_listing">', $text.'<div class="tl_listing_container tree_view" id="tl_listing">', $strContent);
            
            
            
            return $strContent;
        }
        

        
        return $strContent;
    }
}
