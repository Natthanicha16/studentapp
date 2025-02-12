<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$StudentsDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { students: currentTable } });
var currentForm, currentPageID;
var fstudentsdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fstudentsdelete = new ew.Form("fstudentsdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fstudentsdelete;
    loadjs.done("fstudentsdelete");
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
<form name="fstudentsdelete" id="fstudentsdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="students">
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
<?php if ($Page->student_images->Visible) { // student_images ?>
        <th class="<?= $Page->student_images->headerCellClass() ?>"><span id="elh_students_student_images" class="students_student_images"><?= $Page->student_images->caption() ?></span></th>
<?php } ?>
<?php if ($Page->student_code->Visible) { // student_code ?>
        <th class="<?= $Page->student_code->headerCellClass() ?>"><span id="elh_students_student_code" class="students_student_code"><?= $Page->student_code->caption() ?></span></th>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <th class="<?= $Page->name->headerCellClass() ?>"><span id="elh_students_name" class="students_name"><?= $Page->name->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_students__email" class="students__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->age->Visible) { // age ?>
        <th class="<?= $Page->age->headerCellClass() ?>"><span id="elh_students_age" class="students_age"><?= $Page->age->caption() ?></span></th>
<?php } ?>
<?php if ($Page->hobby->Visible) { // hobby ?>
        <th class="<?= $Page->hobby->headerCellClass() ?>"><span id="elh_students_hobby" class="students_hobby"><?= $Page->hobby->caption() ?></span></th>
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
<?php if ($Page->student_images->Visible) { // student_images ?>
        <td<?= $Page->student_images->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_students_student_images" class="el_students_student_images">
<span>
<?= GetFileViewTag($Page->student_images, $Page->student_images->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->student_code->Visible) { // student_code ?>
        <td<?= $Page->student_code->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_students_student_code" class="el_students_student_code">
<span<?= $Page->student_code->viewAttributes() ?>>
<?= $Page->student_code->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
        <td<?= $Page->name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_students_name" class="el_students_name">
<span<?= $Page->name->viewAttributes() ?>>
<?= $Page->name->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_students__email" class="el_students__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->age->Visible) { // age ?>
        <td<?= $Page->age->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_students_age" class="el_students_age">
<span<?= $Page->age->viewAttributes() ?>>
<?= $Page->age->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->hobby->Visible) { // hobby ?>
        <td<?= $Page->hobby->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_students_hobby" class="el_students_hobby">
<span<?= $Page->hobby->viewAttributes() ?>>
<?= $Page->hobby->getViewValue() ?></span>
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
