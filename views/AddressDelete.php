<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$AddressDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { address: currentTable } });
var currentForm, currentPageID;
var faddressdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    faddressdelete = new ew.Form("faddressdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = faddressdelete;
    loadjs.done("faddressdelete");
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
<form name="faddressdelete" id="faddressdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="address">
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
<?php if ($Page->address_id->Visible) { // address_id ?>
        <th class="<?= $Page->address_id->headerCellClass() ?>"><span id="elh_address_address_id" class="address_address_id"><?= $Page->address_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address_studentcode->Visible) { // address_studentcode ?>
        <th class="<?= $Page->address_studentcode->headerCellClass() ?>"><span id="elh_address_address_studentcode" class="address_address_studentcode"><?= $Page->address_studentcode->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address_moo->Visible) { // address_moo ?>
        <th class="<?= $Page->address_moo->headerCellClass() ?>"><span id="elh_address_address_moo" class="address_address_moo"><?= $Page->address_moo->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address_name->Visible) { // address_name ?>
        <th class="<?= $Page->address_name->headerCellClass() ?>"><span id="elh_address_address_name" class="address_address_name"><?= $Page->address_name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address_sub->Visible) { // address_sub ?>
        <th class="<?= $Page->address_sub->headerCellClass() ?>"><span id="elh_address_address_sub" class="address_address_sub"><?= $Page->address_sub->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address_district->Visible) { // address_district ?>
        <th class="<?= $Page->address_district->headerCellClass() ?>"><span id="elh_address_address_district" class="address_address_district"><?= $Page->address_district->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address_province->Visible) { // address_province ?>
        <th class="<?= $Page->address_province->headerCellClass() ?>"><span id="elh_address_address_province" class="address_address_province"><?= $Page->address_province->caption() ?></span></th>
<?php } ?>
<?php if ($Page->address_zip->Visible) { // address_zip ?>
        <th class="<?= $Page->address_zip->headerCellClass() ?>"><span id="elh_address_address_zip" class="address_address_zip"><?= $Page->address_zip->caption() ?></span></th>
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
<?php if ($Page->address_id->Visible) { // address_id ?>
        <td<?= $Page->address_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_id" class="el_address_address_id">
<span<?= $Page->address_id->viewAttributes() ?>>
<?= $Page->address_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address_studentcode->Visible) { // address_studentcode ?>
        <td<?= $Page->address_studentcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_studentcode" class="el_address_address_studentcode">
<span<?= $Page->address_studentcode->viewAttributes() ?>>
<?= $Page->address_studentcode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address_moo->Visible) { // address_moo ?>
        <td<?= $Page->address_moo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_moo" class="el_address_address_moo">
<span<?= $Page->address_moo->viewAttributes() ?>>
<?= $Page->address_moo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address_name->Visible) { // address_name ?>
        <td<?= $Page->address_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_name" class="el_address_address_name">
<span<?= $Page->address_name->viewAttributes() ?>>
<?= $Page->address_name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address_sub->Visible) { // address_sub ?>
        <td<?= $Page->address_sub->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_sub" class="el_address_address_sub">
<span<?= $Page->address_sub->viewAttributes() ?>>
<?= $Page->address_sub->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address_district->Visible) { // address_district ?>
        <td<?= $Page->address_district->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_district" class="el_address_address_district">
<span<?= $Page->address_district->viewAttributes() ?>>
<?= $Page->address_district->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address_province->Visible) { // address_province ?>
        <td<?= $Page->address_province->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_province" class="el_address_address_province">
<span<?= $Page->address_province->viewAttributes() ?>>
<?= $Page->address_province->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->address_zip->Visible) { // address_zip ?>
        <td<?= $Page->address_zip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_zip" class="el_address_address_zip">
<span<?= $Page->address_zip->viewAttributes() ?>>
<?= $Page->address_zip->getViewValue() ?></span>
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
