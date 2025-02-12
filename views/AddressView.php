<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$AddressView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { address: currentTable } });
var currentForm, currentPageID;
var faddressview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    faddressview = new ew.Form("faddressview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = faddressview;
    loadjs.done("faddressview");
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
<form name="faddressview" id="faddressview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="address">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->address_id->Visible) { // address_id ?>
    <tr id="r_address_id"<?= $Page->address_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_address_address_id"><?= $Page->address_id->caption() ?></span></td>
        <td data-name="address_id"<?= $Page->address_id->cellAttributes() ?>>
<span id="el_address_address_id">
<span<?= $Page->address_id->viewAttributes() ?>>
<?= $Page->address_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address_studentcode->Visible) { // address_studentcode ?>
    <tr id="r_address_studentcode"<?= $Page->address_studentcode->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_address_address_studentcode"><?= $Page->address_studentcode->caption() ?></span></td>
        <td data-name="address_studentcode"<?= $Page->address_studentcode->cellAttributes() ?>>
<span id="el_address_address_studentcode">
<span<?= $Page->address_studentcode->viewAttributes() ?>>
<?= $Page->address_studentcode->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address_moo->Visible) { // address_moo ?>
    <tr id="r_address_moo"<?= $Page->address_moo->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_address_address_moo"><?= $Page->address_moo->caption() ?></span></td>
        <td data-name="address_moo"<?= $Page->address_moo->cellAttributes() ?>>
<span id="el_address_address_moo">
<span<?= $Page->address_moo->viewAttributes() ?>>
<?= $Page->address_moo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address_name->Visible) { // address_name ?>
    <tr id="r_address_name"<?= $Page->address_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_address_address_name"><?= $Page->address_name->caption() ?></span></td>
        <td data-name="address_name"<?= $Page->address_name->cellAttributes() ?>>
<span id="el_address_address_name">
<span<?= $Page->address_name->viewAttributes() ?>>
<?= $Page->address_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address_sub->Visible) { // address_sub ?>
    <tr id="r_address_sub"<?= $Page->address_sub->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_address_address_sub"><?= $Page->address_sub->caption() ?></span></td>
        <td data-name="address_sub"<?= $Page->address_sub->cellAttributes() ?>>
<span id="el_address_address_sub">
<span<?= $Page->address_sub->viewAttributes() ?>>
<?= $Page->address_sub->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address_district->Visible) { // address_district ?>
    <tr id="r_address_district"<?= $Page->address_district->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_address_address_district"><?= $Page->address_district->caption() ?></span></td>
        <td data-name="address_district"<?= $Page->address_district->cellAttributes() ?>>
<span id="el_address_address_district">
<span<?= $Page->address_district->viewAttributes() ?>>
<?= $Page->address_district->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address_province->Visible) { // address_province ?>
    <tr id="r_address_province"<?= $Page->address_province->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_address_address_province"><?= $Page->address_province->caption() ?></span></td>
        <td data-name="address_province"<?= $Page->address_province->cellAttributes() ?>>
<span id="el_address_address_province">
<span<?= $Page->address_province->viewAttributes() ?>>
<?= $Page->address_province->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->address_zip->Visible) { // address_zip ?>
    <tr id="r_address_zip"<?= $Page->address_zip->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_address_address_zip"><?= $Page->address_zip->caption() ?></span></td>
        <td data-name="address_zip"<?= $Page->address_zip->cellAttributes() ?>>
<span id="el_address_address_zip">
<span<?= $Page->address_zip->viewAttributes() ?>>
<?= $Page->address_zip->getViewValue() ?></span>
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
