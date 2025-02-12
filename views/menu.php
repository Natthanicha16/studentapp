<?php

namespace PHPMaker2022\STUDENTT;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(3, "mci_หน้าหลัก", $MenuLanguage->MenuPhrase("3", "MenuText"), "", -1, "", true, false, true, "	fa fa-bank", "", false);
$sideMenu->addMenuItem(2, "mi_students", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "studentslist", 3, "", true, false, false, "far fa-address-book", "", false);
$sideMenu->addMenuItem(4, "mci_ข้อมูลพื้นฐาน", $MenuLanguage->MenuPhrase("4", "MenuText"), "", -1, "", true, false, true, "fas fa-book", "", false);
$sideMenu->addMenuItem(1, "mi_hobby3", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "hobby3list", 4, "", true, false, false, "fas fa-briefcase", "", false);
echo $sideMenu->toScript();
