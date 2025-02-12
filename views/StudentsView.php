<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$StudentsView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { students: currentTable } });
var currentForm, currentPageID;
var fstudentsview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fstudentsview = new ew.Form("fstudentsview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fstudentsview;
    loadjs.done("fstudentsview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<?php } ?>
<form name="fstudentsview" id="fstudentsview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="students">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->student_images->Visible) { // student_images ?>
    <tr id="r_student_images"<?= $Page->student_images->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_students_student_images"><?= $Page->student_images->caption() ?></span></td>
        <td data-name="student_images"<?= $Page->student_images->cellAttributes() ?>>
<span id="el_students_student_images">
<span>
<?= GetFileViewTag($Page->student_images, $Page->student_images->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->student_code->Visible) { // student_code ?>
    <tr id="r_student_code"<?= $Page->student_code->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_students_student_code"><?= $Page->student_code->caption() ?></span></td>
        <td data-name="student_code"<?= $Page->student_code->cellAttributes() ?>>
<span id="el_students_student_code">
<span<?= $Page->student_code->viewAttributes() ?>>
<?= $Page->student_code->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <tr id="r_name"<?= $Page->name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_students_name"><?= $Page->name->caption() ?></span></td>
        <td data-name="name"<?= $Page->name->cellAttributes() ?>>
<span id="el_students_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_students__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el_students__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->age->Visible) { // age ?>
    <tr id="r_age"<?= $Page->age->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_students_age"><?= $Page->age->caption() ?></span></td>
        <td data-name="age"<?= $Page->age->cellAttributes() ?>>
<span id="el_students_age">
<span<?= $Page->age->viewAttributes() ?>>
<?= $Page->age->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hobby->Visible) { // hobby ?>
    <tr id="r_hobby"<?= $Page->hobby->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_students_hobby"><?= $Page->hobby->caption() ?></span></td>
        <td data-name="hobby"<?= $Page->hobby->cellAttributes() ?>>
<span id="el_students_hobby">
<span<?= $Page->hobby->viewAttributes() ?>>
<?= $Page->hobby->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
<?php } ?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<?php
    $Page->DetailPages->ValidKeys = explode(",", $Page->getCurrentDetailTable());
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav<?= $Page->DetailPages->containerClasses() ?>" id="details_Page"><!-- tabs -->
    <ul class="<?= $Page->DetailPages->navClasses() ?>" role="tablist"><!-- .nav -->
<?php
    if (in_array("tbstudy", explode(",", $Page->getCurrentDetailTable())) && $tbstudy->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("tbstudy") ?><?= $Page->DetailPages->activeClasses("tbstudy") ?>" data-bs-target="#tab_tbstudy" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_tbstudy" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("tbstudy")) ?>"><?= $Language->tablePhrase("tbstudy", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("address", explode(",", $Page->getCurrentDetailTable())) && $address->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("address") ?><?= $Page->DetailPages->activeClasses("address") ?>" data-bs-target="#tab_address" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_address" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("address")) ?>"><?= $Language->tablePhrase("address", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("tb_ta", explode(",", $Page->getCurrentDetailTable())) && $tb_ta->DetailView) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("tb_ta") ?><?= $Page->DetailPages->activeClasses("tb_ta") ?>" data-bs-target="#tab_tb_ta" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_tb_ta" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("tb_ta")) ?>"><?= $Language->tablePhrase("tb_ta", "TblCaption") ?></button></li>
<?php
    }
?>
    </ul><!-- /.nav -->
    <div class="<?= $Page->DetailPages->tabContentClasses() ?>"><!-- .tab-content -->
<?php
    if (in_array("tbstudy", explode(",", $Page->getCurrentDetailTable())) && $tbstudy->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("tbstudy") ?><?= $Page->DetailPages->activeClasses("tbstudy") ?>" id="tab_tbstudy" role="tabpanel"><!-- page* -->
<?php include_once "TbstudyGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("address", explode(",", $Page->getCurrentDetailTable())) && $address->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("address") ?><?= $Page->DetailPages->activeClasses("address") ?>" id="tab_address" role="tabpanel"><!-- page* -->
<?php include_once "AddressGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("tb_ta", explode(",", $Page->getCurrentDetailTable())) && $tb_ta->DetailView) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("tb_ta") ?><?= $Page->DetailPages->activeClasses("tb_ta") ?>" id="tab_tb_ta" role="tabpanel"><!-- page* -->
<?php include_once "TbTaGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
    </div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
