<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$TbstudyDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tbstudy: currentTable } });
var currentForm, currentPageID;
var ftbstudydelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftbstudydelete = new ew.Form("ftbstudydelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = ftbstudydelete;
    loadjs.done("ftbstudydelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftbstudydelete" id="ftbstudydelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tbstudy">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->study_id->Visible) { // study_id ?>
        <th class="<?= $Page->study_id->headerCellClass() ?>"><span id="elh_tbstudy_study_id" class="tbstudy_study_id"><?= $Page->study_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->study_name->Visible) { // study_name ?>
        <th class="<?= $Page->study_name->headerCellClass() ?>"><span id="elh_tbstudy_study_name" class="tbstudy_study_name"><?= $Page->study_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->study_level->Visible) { // study_level ?>
        <th class="<?= $Page->study_level->headerCellClass() ?>"><span id="elh_tbstudy_study_level" class="tbstudy_study_level"><?= $Page->study_level->caption() ?></span></th>
<?php } ?>
<?php if ($Page->study_studentcode->Visible) { // study_studentcode ?>
        <th class="<?= $Page->study_studentcode->headerCellClass() ?>"><span id="elh_tbstudy_study_studentcode" class="tbstudy_study_studentcode"><?= $Page->study_studentcode->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->study_id->Visible) { // study_id ?>
        <td<?= $Page->study_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tbstudy_study_id" class="el_tbstudy_study_id">
<span<?= $Page->study_id->viewAttributes() ?>>
<?= $Page->study_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->study_name->Visible) { // study_name ?>
        <td<?= $Page->study_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tbstudy_study_name" class="el_tbstudy_study_name">
<span<?= $Page->study_name->viewAttributes() ?>>
<?= $Page->study_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->study_level->Visible) { // study_level ?>
        <td<?= $Page->study_level->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tbstudy_study_level" class="el_tbstudy_study_level">
<span<?= $Page->study_level->viewAttributes() ?>>
<?= $Page->study_level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->study_studentcode->Visible) { // study_studentcode ?>
        <td<?= $Page->study_studentcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tbstudy_study_studentcode" class="el_tbstudy_study_studentcode">
<span<?= $Page->study_studentcode->viewAttributes() ?>>
<?= $Page->study_studentcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
