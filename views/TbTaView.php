<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$TbTaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tb_ta: currentTable } });
var currentForm, currentPageID;
var ftb_taview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftb_taview = new ew.Form("ftb_taview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = ftb_taview;
    loadjs.done("ftb_taview");
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
<form name="ftb_taview" id="ftb_taview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tb_ta">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->ta_id->Visible) { // ta_id ?>
    <tr id="r_ta_id"<?= $Page->ta_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tb_ta_ta_id"><?= $Page->ta_id->caption() ?></span></td>
        <td data-name="ta_id"<?= $Page->ta_id->cellAttributes() ?>>
<span id="el_tb_ta_ta_id">
<span<?= $Page->ta_id->viewAttributes() ?>>
<?= $Page->ta_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->taprefic_name->Visible) { // taprefic_name ?>
    <tr id="r_taprefic_name"<?= $Page->taprefic_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tb_ta_taprefic_name"><?= $Page->taprefic_name->caption() ?></span></td>
        <td data-name="taprefic_name"<?= $Page->taprefic_name->cellAttributes() ?>>
<span id="el_tb_ta_taprefic_name">
<span<?= $Page->taprefic_name->viewAttributes() ?>>
<?= $Page->taprefic_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ta_name->Visible) { // ta_name ?>
    <tr id="r_ta_name"<?= $Page->ta_name->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tb_ta_ta_name"><?= $Page->ta_name->caption() ?></span></td>
        <td data-name="ta_name"<?= $Page->ta_name->cellAttributes() ?>>
<span id="el_tb_ta_ta_name">
<span<?= $Page->ta_name->viewAttributes() ?>>
<?= $Page->ta_name->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ta_surname->Visible) { // ta_surname ?>
    <tr id="r_ta_surname"<?= $Page->ta_surname->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tb_ta_ta_surname"><?= $Page->ta_surname->caption() ?></span></td>
        <td data-name="ta_surname"<?= $Page->ta_surname->cellAttributes() ?>>
<span id="el_tb_ta_ta_surname">
<span<?= $Page->ta_surname->viewAttributes() ?>>
<?= $Page->ta_surname->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ta_studentcode->Visible) { // ta_studentcode ?>
    <tr id="r_ta_studentcode"<?= $Page->ta_studentcode->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_tb_ta_ta_studentcode"><?= $Page->ta_studentcode->caption() ?></span></td>
        <td data-name="ta_studentcode"<?= $Page->ta_studentcode->cellAttributes() ?>>
<span id="el_tb_ta_ta_studentcode">
<span<?= $Page->ta_studentcode->viewAttributes() ?>>
<?= $Page->ta_studentcode->getViewValue() ?></span>
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
