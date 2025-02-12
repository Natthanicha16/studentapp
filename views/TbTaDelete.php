<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$TbTaDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tb_ta: currentTable } });
var currentForm, currentPageID;
var ftb_tadelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftb_tadelete = new ew.Form("ftb_tadelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = ftb_tadelete;
    loadjs.done("ftb_tadelete");
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
<form name="ftb_tadelete" id="ftb_tadelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tb_ta">
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
<?php if ($Page->ta_id->Visible) { // ta_id ?>
        <th class="<?= $Page->ta_id->headerCellClass() ?>"><span id="elh_tb_ta_ta_id" class="tb_ta_ta_id"><?= $Page->ta_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->taprefic_name->Visible) { // taprefic_name ?>
        <th class="<?= $Page->taprefic_name->headerCellClass() ?>"><span id="elh_tb_ta_taprefic_name" class="tb_ta_taprefic_name"><?= $Page->taprefic_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ta_name->Visible) { // ta_name ?>
        <th class="<?= $Page->ta_name->headerCellClass() ?>"><span id="elh_tb_ta_ta_name" class="tb_ta_ta_name"><?= $Page->ta_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ta_surname->Visible) { // ta_surname ?>
        <th class="<?= $Page->ta_surname->headerCellClass() ?>"><span id="elh_tb_ta_ta_surname" class="tb_ta_ta_surname"><?= $Page->ta_surname->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ta_studentcode->Visible) { // ta_studentcode ?>
        <th class="<?= $Page->ta_studentcode->headerCellClass() ?>"><span id="elh_tb_ta_ta_studentcode" class="tb_ta_ta_studentcode"><?= $Page->ta_studentcode->caption() ?></span></th>
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
<?php if ($Page->ta_id->Visible) { // ta_id ?>
        <td<?= $Page->ta_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tb_ta_ta_id" class="el_tb_ta_ta_id">
<span<?= $Page->ta_id->viewAttributes() ?>>
<?= $Page->ta_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->taprefic_name->Visible) { // taprefic_name ?>
        <td<?= $Page->taprefic_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tb_ta_taprefic_name" class="el_tb_ta_taprefic_name">
<span<?= $Page->taprefic_name->viewAttributes() ?>>
<?= $Page->taprefic_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ta_name->Visible) { // ta_name ?>
        <td<?= $Page->ta_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tb_ta_ta_name" class="el_tb_ta_ta_name">
<span<?= $Page->ta_name->viewAttributes() ?>>
<?= $Page->ta_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ta_surname->Visible) { // ta_surname ?>
        <td<?= $Page->ta_surname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tb_ta_ta_surname" class="el_tb_ta_ta_surname">
<span<?= $Page->ta_surname->viewAttributes() ?>>
<?= $Page->ta_surname->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ta_studentcode->Visible) { // ta_studentcode ?>
        <td<?= $Page->ta_studentcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tb_ta_ta_studentcode" class="el_tb_ta_ta_studentcode">
<span<?= $Page->ta_studentcode->viewAttributes() ?>>
<?= $Page->ta_studentcode->getViewValue() ?></span>
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
