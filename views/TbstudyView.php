<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$TbstudyView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tbstudy: currentTable } });
var currentForm, currentPageID;
var ftbstudyview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftbstudyview = new ew.Form("ftbstudyview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = ftbstudyview;
    loadjs.done("ftbstudyview");
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
<form name="ftbstudyview" id="ftbstudyview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tbstudy">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->study_id->Visible) { // study_id ?>
    <tr id="r_study_id"<?= $Page->study_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tbstudy_study_id"><?= $Page->study_id->caption() ?></span></td>
        <td data-name="study_id"<?= $Page->study_id->cellAttributes() ?>>
<span id="el_tbstudy_study_id">
<span<?= $Page->study_id->viewAttributes() ?>>
<?= $Page->study_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->study_name->Visible) { // study_name ?>
    <tr id="r_study_name"<?= $Page->study_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tbstudy_study_name"><?= $Page->study_name->caption() ?></span></td>
        <td data-name="study_name"<?= $Page->study_name->cellAttributes() ?>>
<span id="el_tbstudy_study_name">
<span<?= $Page->study_name->viewAttributes() ?>>
<?= $Page->study_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->study_level->Visible) { // study_level ?>
    <tr id="r_study_level"<?= $Page->study_level->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tbstudy_study_level"><?= $Page->study_level->caption() ?></span></td>
        <td data-name="study_level"<?= $Page->study_level->cellAttributes() ?>>
<span id="el_tbstudy_study_level">
<span<?= $Page->study_level->viewAttributes() ?>>
<?= $Page->study_level->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->study_studentcode->Visible) { // study_studentcode ?>
    <tr id="r_study_studentcode"<?= $Page->study_studentcode->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tbstudy_study_studentcode"><?= $Page->study_studentcode->caption() ?></span></td>
        <td data-name="study_studentcode"<?= $Page->study_studentcode->cellAttributes() ?>>
<span id="el_tbstudy_study_studentcode">
<span<?= $Page->study_studentcode->viewAttributes() ?>>
<?= $Page->study_studentcode->getViewValue() ?></span>
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
