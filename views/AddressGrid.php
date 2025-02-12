<?php

namespace PHPMaker2022\STUDENTT;

// Set up and run Grid object
$Grid = Container("AddressGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var faddressgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    faddressgrid = new ew.Form("faddressgrid", "grid");
    faddressgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { address: currentTable } });
    var fields = currentTable.fields;
    faddressgrid.addFields([
        ["address_id", [fields.address_id.visible && fields.address_id.required ? ew.Validators.required(fields.address_id.caption) : null], fields.address_id.isInvalid],
        ["address_studentcode", [fields.address_studentcode.visible && fields.address_studentcode.required ? ew.Validators.required(fields.address_studentcode.caption) : null], fields.address_studentcode.isInvalid],
        ["address_moo", [fields.address_moo.visible && fields.address_moo.required ? ew.Validators.required(fields.address_moo.caption) : null], fields.address_moo.isInvalid],
        ["address_name", [fields.address_name.visible && fields.address_name.required ? ew.Validators.required(fields.address_name.caption) : null], fields.address_name.isInvalid],
        ["address_sub", [fields.address_sub.visible && fields.address_sub.required ? ew.Validators.required(fields.address_sub.caption) : null], fields.address_sub.isInvalid],
        ["address_district", [fields.address_district.visible && fields.address_district.required ? ew.Validators.required(fields.address_district.caption) : null], fields.address_district.isInvalid],
        ["address_province", [fields.address_province.visible && fields.address_province.required ? ew.Validators.required(fields.address_province.caption) : null], fields.address_province.isInvalid],
        ["address_zip", [fields.address_zip.visible && fields.address_zip.required ? ew.Validators.required(fields.address_zip.caption) : null], fields.address_zip.isInvalid]
    ]);

    // Check empty row
    faddressgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["address_studentcode",false],["address_moo",false],["address_name",false],["address_sub",false],["address_district",false],["address_province",false],["address_zip",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    faddressgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    faddressgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("faddressgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> address">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="faddressgrid" class="ew-form ew-list-form">
<div id="gmp_address" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_addressgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->address_id->Visible) { // address_id ?>
        <th data-name="address_id" class="<?= $Grid->address_id->headerCellClass() ?>"><div id="elh_address_address_id" class="address_address_id"><?= $Grid->renderFieldHeader($Grid->address_id) ?></div></th>
<?php } ?>
<?php if ($Grid->address_studentcode->Visible) { // address_studentcode ?>
        <th data-name="address_studentcode" class="<?= $Grid->address_studentcode->headerCellClass() ?>"><div id="elh_address_address_studentcode" class="address_address_studentcode"><?= $Grid->renderFieldHeader($Grid->address_studentcode) ?></div></th>
<?php } ?>
<?php if ($Grid->address_moo->Visible) { // address_moo ?>
        <th data-name="address_moo" class="<?= $Grid->address_moo->headerCellClass() ?>"><div id="elh_address_address_moo" class="address_address_moo"><?= $Grid->renderFieldHeader($Grid->address_moo) ?></div></th>
<?php } ?>
<?php if ($Grid->address_name->Visible) { // address_name ?>
        <th data-name="address_name" class="<?= $Grid->address_name->headerCellClass() ?>"><div id="elh_address_address_name" class="address_address_name"><?= $Grid->renderFieldHeader($Grid->address_name) ?></div></th>
<?php } ?>
<?php if ($Grid->address_sub->Visible) { // address_sub ?>
        <th data-name="address_sub" class="<?= $Grid->address_sub->headerCellClass() ?>"><div id="elh_address_address_sub" class="address_address_sub"><?= $Grid->renderFieldHeader($Grid->address_sub) ?></div></th>
<?php } ?>
<?php if ($Grid->address_district->Visible) { // address_district ?>
        <th data-name="address_district" class="<?= $Grid->address_district->headerCellClass() ?>"><div id="elh_address_address_district" class="address_address_district"><?= $Grid->renderFieldHeader($Grid->address_district) ?></div></th>
<?php } ?>
<?php if ($Grid->address_province->Visible) { // address_province ?>
        <th data-name="address_province" class="<?= $Grid->address_province->headerCellClass() ?>"><div id="elh_address_address_province" class="address_address_province"><?= $Grid->renderFieldHeader($Grid->address_province) ?></div></th>
<?php } ?>
<?php if ($Grid->address_zip->Visible) { // address_zip ?>
        <th data-name="address_zip" class="<?= $Grid->address_zip->headerCellClass() ?>"><div id="elh_address_address_zip" class="address_address_zip"><?= $Grid->renderFieldHeader($Grid->address_zip) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif ($Grid->isGridAdd() && !$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isAdd() || $Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row attributes
        $Grid->RowAttrs->merge([
            "data-rowindex" => $Grid->RowCount,
            "id" => "r" . $Grid->RowCount . "_address",
            "data-rowtype" => $Grid->RowType,
            "class" => ($Grid->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Grid->isAdd() && $Grid->RowType == ROWTYPE_ADD || $Grid->isEdit() && $Grid->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Grid->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if (
            $Page->RowAction != "delete" &&
            $Page->RowAction != "insertdelete" &&
            !($Page->RowAction == "insert" && $Page->isConfirm() && $Page->emptyRow())
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->address_id->Visible) { // address_id ?>
        <td data-name="address_id"<?= $Grid->address_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_id" class="el_address_address_id"></span>
<input type="hidden" data-table="address" data-field="x_address_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_id" id="o<?= $Grid->RowIndex ?>_address_id" value="<?= HtmlEncode($Grid->address_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_id" class="el_address_address_id">
<span<?= $Grid->address_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_id->getDisplayValue($Grid->address_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="address" data-field="x_address_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_address_id" id="x<?= $Grid->RowIndex ?>_address_id" value="<?= HtmlEncode($Grid->address_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_id" class="el_address_address_id">
<span<?= $Grid->address_id->viewAttributes() ?>>
<?= $Grid->address_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="address" data-field="x_address_id" data-hidden="1" name="faddressgrid$x<?= $Grid->RowIndex ?>_address_id" id="faddressgrid$x<?= $Grid->RowIndex ?>_address_id" value="<?= HtmlEncode($Grid->address_id->FormValue) ?>">
<input type="hidden" data-table="address" data-field="x_address_id" data-hidden="1" name="faddressgrid$o<?= $Grid->RowIndex ?>_address_id" id="faddressgrid$o<?= $Grid->RowIndex ?>_address_id" value="<?= HtmlEncode($Grid->address_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="address" data-field="x_address_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_address_id" id="x<?= $Grid->RowIndex ?>_address_id" value="<?= HtmlEncode($Grid->address_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->address_studentcode->Visible) { // address_studentcode ?>
        <td data-name="address_studentcode"<?= $Grid->address_studentcode->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->address_studentcode->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_address_address_studentcode" class="el_address_address_studentcode">
<span<?= $Grid->address_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_studentcode->getDisplayValue($Grid->address_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_address_studentcode" name="x<?= $Grid->RowIndex ?>_address_studentcode" value="<?= HtmlEncode($Grid->address_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_address_address_studentcode" class="el_address_address_studentcode">
<input type="<?= $Grid->address_studentcode->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_studentcode" id="x<?= $Grid->RowIndex ?>_address_studentcode" data-table="address" data-field="x_address_studentcode" value="<?= $Grid->address_studentcode->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->address_studentcode->getPlaceHolder()) ?>"<?= $Grid->address_studentcode->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="address" data-field="x_address_studentcode" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_studentcode" id="o<?= $Grid->RowIndex ?>_address_studentcode" value="<?= HtmlEncode($Grid->address_studentcode->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->address_studentcode->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_address_address_studentcode" class="el_address_address_studentcode">
<span<?= $Grid->address_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_studentcode->getDisplayValue($Grid->address_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_address_studentcode" name="x<?= $Grid->RowIndex ?>_address_studentcode" value="<?= HtmlEncode($Grid->address_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_address_address_studentcode" class="el_address_address_studentcode">
<input type="<?= $Grid->address_studentcode->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_studentcode" id="x<?= $Grid->RowIndex ?>_address_studentcode" data-table="address" data-field="x_address_studentcode" value="<?= $Grid->address_studentcode->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->address_studentcode->getPlaceHolder()) ?>"<?= $Grid->address_studentcode->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_studentcode" class="el_address_address_studentcode">
<span<?= $Grid->address_studentcode->viewAttributes() ?>>
<?= $Grid->address_studentcode->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="address" data-field="x_address_studentcode" data-hidden="1" name="faddressgrid$x<?= $Grid->RowIndex ?>_address_studentcode" id="faddressgrid$x<?= $Grid->RowIndex ?>_address_studentcode" value="<?= HtmlEncode($Grid->address_studentcode->FormValue) ?>">
<input type="hidden" data-table="address" data-field="x_address_studentcode" data-hidden="1" name="faddressgrid$o<?= $Grid->RowIndex ?>_address_studentcode" id="faddressgrid$o<?= $Grid->RowIndex ?>_address_studentcode" value="<?= HtmlEncode($Grid->address_studentcode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->address_moo->Visible) { // address_moo ?>
        <td data-name="address_moo"<?= $Grid->address_moo->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_moo" class="el_address_address_moo">
<input type="<?= $Grid->address_moo->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_moo" id="x<?= $Grid->RowIndex ?>_address_moo" data-table="address" data-field="x_address_moo" value="<?= $Grid->address_moo->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->address_moo->getPlaceHolder()) ?>"<?= $Grid->address_moo->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_moo->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="address" data-field="x_address_moo" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_moo" id="o<?= $Grid->RowIndex ?>_address_moo" value="<?= HtmlEncode($Grid->address_moo->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_moo" class="el_address_address_moo">
<input type="<?= $Grid->address_moo->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_moo" id="x<?= $Grid->RowIndex ?>_address_moo" data-table="address" data-field="x_address_moo" value="<?= $Grid->address_moo->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->address_moo->getPlaceHolder()) ?>"<?= $Grid->address_moo->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_moo->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_moo" class="el_address_address_moo">
<span<?= $Grid->address_moo->viewAttributes() ?>>
<?= $Grid->address_moo->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="address" data-field="x_address_moo" data-hidden="1" name="faddressgrid$x<?= $Grid->RowIndex ?>_address_moo" id="faddressgrid$x<?= $Grid->RowIndex ?>_address_moo" value="<?= HtmlEncode($Grid->address_moo->FormValue) ?>">
<input type="hidden" data-table="address" data-field="x_address_moo" data-hidden="1" name="faddressgrid$o<?= $Grid->RowIndex ?>_address_moo" id="faddressgrid$o<?= $Grid->RowIndex ?>_address_moo" value="<?= HtmlEncode($Grid->address_moo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->address_name->Visible) { // address_name ?>
        <td data-name="address_name"<?= $Grid->address_name->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_name" class="el_address_address_name">
<input type="<?= $Grid->address_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_name" id="x<?= $Grid->RowIndex ?>_address_name" data-table="address" data-field="x_address_name" value="<?= $Grid->address_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->address_name->getPlaceHolder()) ?>"<?= $Grid->address_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="address" data-field="x_address_name" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_name" id="o<?= $Grid->RowIndex ?>_address_name" value="<?= HtmlEncode($Grid->address_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_name" class="el_address_address_name">
<input type="<?= $Grid->address_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_name" id="x<?= $Grid->RowIndex ?>_address_name" data-table="address" data-field="x_address_name" value="<?= $Grid->address_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->address_name->getPlaceHolder()) ?>"<?= $Grid->address_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_name" class="el_address_address_name">
<span<?= $Grid->address_name->viewAttributes() ?>>
<?= $Grid->address_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="address" data-field="x_address_name" data-hidden="1" name="faddressgrid$x<?= $Grid->RowIndex ?>_address_name" id="faddressgrid$x<?= $Grid->RowIndex ?>_address_name" value="<?= HtmlEncode($Grid->address_name->FormValue) ?>">
<input type="hidden" data-table="address" data-field="x_address_name" data-hidden="1" name="faddressgrid$o<?= $Grid->RowIndex ?>_address_name" id="faddressgrid$o<?= $Grid->RowIndex ?>_address_name" value="<?= HtmlEncode($Grid->address_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->address_sub->Visible) { // address_sub ?>
        <td data-name="address_sub"<?= $Grid->address_sub->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_sub" class="el_address_address_sub">
<input type="<?= $Grid->address_sub->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_sub" id="x<?= $Grid->RowIndex ?>_address_sub" data-table="address" data-field="x_address_sub" value="<?= $Grid->address_sub->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->address_sub->getPlaceHolder()) ?>"<?= $Grid->address_sub->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_sub->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="address" data-field="x_address_sub" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_sub" id="o<?= $Grid->RowIndex ?>_address_sub" value="<?= HtmlEncode($Grid->address_sub->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_sub" class="el_address_address_sub">
<input type="<?= $Grid->address_sub->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_sub" id="x<?= $Grid->RowIndex ?>_address_sub" data-table="address" data-field="x_address_sub" value="<?= $Grid->address_sub->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->address_sub->getPlaceHolder()) ?>"<?= $Grid->address_sub->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_sub->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_sub" class="el_address_address_sub">
<span<?= $Grid->address_sub->viewAttributes() ?>>
<?= $Grid->address_sub->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="address" data-field="x_address_sub" data-hidden="1" name="faddressgrid$x<?= $Grid->RowIndex ?>_address_sub" id="faddressgrid$x<?= $Grid->RowIndex ?>_address_sub" value="<?= HtmlEncode($Grid->address_sub->FormValue) ?>">
<input type="hidden" data-table="address" data-field="x_address_sub" data-hidden="1" name="faddressgrid$o<?= $Grid->RowIndex ?>_address_sub" id="faddressgrid$o<?= $Grid->RowIndex ?>_address_sub" value="<?= HtmlEncode($Grid->address_sub->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->address_district->Visible) { // address_district ?>
        <td data-name="address_district"<?= $Grid->address_district->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_district" class="el_address_address_district">
<input type="<?= $Grid->address_district->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_district" id="x<?= $Grid->RowIndex ?>_address_district" data-table="address" data-field="x_address_district" value="<?= $Grid->address_district->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->address_district->getPlaceHolder()) ?>"<?= $Grid->address_district->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_district->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="address" data-field="x_address_district" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_district" id="o<?= $Grid->RowIndex ?>_address_district" value="<?= HtmlEncode($Grid->address_district->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_district" class="el_address_address_district">
<input type="<?= $Grid->address_district->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_district" id="x<?= $Grid->RowIndex ?>_address_district" data-table="address" data-field="x_address_district" value="<?= $Grid->address_district->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->address_district->getPlaceHolder()) ?>"<?= $Grid->address_district->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_district->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_district" class="el_address_address_district">
<span<?= $Grid->address_district->viewAttributes() ?>>
<?= $Grid->address_district->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="address" data-field="x_address_district" data-hidden="1" name="faddressgrid$x<?= $Grid->RowIndex ?>_address_district" id="faddressgrid$x<?= $Grid->RowIndex ?>_address_district" value="<?= HtmlEncode($Grid->address_district->FormValue) ?>">
<input type="hidden" data-table="address" data-field="x_address_district" data-hidden="1" name="faddressgrid$o<?= $Grid->RowIndex ?>_address_district" id="faddressgrid$o<?= $Grid->RowIndex ?>_address_district" value="<?= HtmlEncode($Grid->address_district->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->address_province->Visible) { // address_province ?>
        <td data-name="address_province"<?= $Grid->address_province->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_province" class="el_address_address_province">
<input type="<?= $Grid->address_province->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_province" id="x<?= $Grid->RowIndex ?>_address_province" data-table="address" data-field="x_address_province" value="<?= $Grid->address_province->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->address_province->getPlaceHolder()) ?>"<?= $Grid->address_province->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_province->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="address" data-field="x_address_province" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_province" id="o<?= $Grid->RowIndex ?>_address_province" value="<?= HtmlEncode($Grid->address_province->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_province" class="el_address_address_province">
<input type="<?= $Grid->address_province->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_province" id="x<?= $Grid->RowIndex ?>_address_province" data-table="address" data-field="x_address_province" value="<?= $Grid->address_province->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->address_province->getPlaceHolder()) ?>"<?= $Grid->address_province->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_province->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_province" class="el_address_address_province">
<span<?= $Grid->address_province->viewAttributes() ?>>
<?= $Grid->address_province->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="address" data-field="x_address_province" data-hidden="1" name="faddressgrid$x<?= $Grid->RowIndex ?>_address_province" id="faddressgrid$x<?= $Grid->RowIndex ?>_address_province" value="<?= HtmlEncode($Grid->address_province->FormValue) ?>">
<input type="hidden" data-table="address" data-field="x_address_province" data-hidden="1" name="faddressgrid$o<?= $Grid->RowIndex ?>_address_province" id="faddressgrid$o<?= $Grid->RowIndex ?>_address_province" value="<?= HtmlEncode($Grid->address_province->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->address_zip->Visible) { // address_zip ?>
        <td data-name="address_zip"<?= $Grid->address_zip->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_zip" class="el_address_address_zip">
<input type="<?= $Grid->address_zip->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_zip" id="x<?= $Grid->RowIndex ?>_address_zip" data-table="address" data-field="x_address_zip" value="<?= $Grid->address_zip->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->address_zip->getPlaceHolder()) ?>"<?= $Grid->address_zip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_zip->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="address" data-field="x_address_zip" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_zip" id="o<?= $Grid->RowIndex ?>_address_zip" value="<?= HtmlEncode($Grid->address_zip->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_zip" class="el_address_address_zip">
<input type="<?= $Grid->address_zip->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_zip" id="x<?= $Grid->RowIndex ?>_address_zip" data-table="address" data-field="x_address_zip" value="<?= $Grid->address_zip->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->address_zip->getPlaceHolder()) ?>"<?= $Grid->address_zip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_zip->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_address_address_zip" class="el_address_address_zip">
<span<?= $Grid->address_zip->viewAttributes() ?>>
<?= $Grid->address_zip->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="address" data-field="x_address_zip" data-hidden="1" name="faddressgrid$x<?= $Grid->RowIndex ?>_address_zip" id="faddressgrid$x<?= $Grid->RowIndex ?>_address_zip" value="<?= HtmlEncode($Grid->address_zip->FormValue) ?>">
<input type="hidden" data-table="address" data-field="x_address_zip" data-hidden="1" name="faddressgrid$o<?= $Grid->RowIndex ?>_address_zip" id="faddressgrid$o<?= $Grid->RowIndex ?>_address_zip" value="<?= HtmlEncode($Grid->address_zip->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["faddressgrid","load"], () => faddressgrid.updateLists(<?= $Grid->RowIndex ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
    $Grid->RowIndex = '$rowindex$';
    $Grid->loadRowValues();

    // Set row properties
    $Grid->resetAttributes();
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_address", "data-rowtype" => ROWTYPE_ADD]);
    $Grid->RowAttrs->appendClass("ew-template");

    // Reset previous form error if any
    $Grid->resetFormError();

    // Render row
    $Grid->RowType = ROWTYPE_ADD;
    $Grid->renderRow();

    // Render list options
    $Grid->renderListOptions();
    $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->address_id->Visible) { // address_id ?>
        <td data-name="address_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_address_address_id" class="el_address_address_id"></span>
<?php } else { ?>
<span id="el$rowindex$_address_address_id" class="el_address_address_id">
<span<?= $Grid->address_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_id->getDisplayValue($Grid->address_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="address" data-field="x_address_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_address_id" id="x<?= $Grid->RowIndex ?>_address_id" value="<?= HtmlEncode($Grid->address_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="address" data-field="x_address_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_id" id="o<?= $Grid->RowIndex ?>_address_id" value="<?= HtmlEncode($Grid->address_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->address_studentcode->Visible) { // address_studentcode ?>
        <td data-name="address_studentcode">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->address_studentcode->getSessionValue() != "") { ?>
<span id="el$rowindex$_address_address_studentcode" class="el_address_address_studentcode">
<span<?= $Grid->address_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_studentcode->getDisplayValue($Grid->address_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_address_studentcode" name="x<?= $Grid->RowIndex ?>_address_studentcode" value="<?= HtmlEncode($Grid->address_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_address_address_studentcode" class="el_address_address_studentcode">
<input type="<?= $Grid->address_studentcode->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_studentcode" id="x<?= $Grid->RowIndex ?>_address_studentcode" data-table="address" data-field="x_address_studentcode" value="<?= $Grid->address_studentcode->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->address_studentcode->getPlaceHolder()) ?>"<?= $Grid->address_studentcode->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_address_address_studentcode" class="el_address_address_studentcode">
<span<?= $Grid->address_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_studentcode->getDisplayValue($Grid->address_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="address" data-field="x_address_studentcode" data-hidden="1" name="x<?= $Grid->RowIndex ?>_address_studentcode" id="x<?= $Grid->RowIndex ?>_address_studentcode" value="<?= HtmlEncode($Grid->address_studentcode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="address" data-field="x_address_studentcode" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_studentcode" id="o<?= $Grid->RowIndex ?>_address_studentcode" value="<?= HtmlEncode($Grid->address_studentcode->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->address_moo->Visible) { // address_moo ?>
        <td data-name="address_moo">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_address_address_moo" class="el_address_address_moo">
<input type="<?= $Grid->address_moo->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_moo" id="x<?= $Grid->RowIndex ?>_address_moo" data-table="address" data-field="x_address_moo" value="<?= $Grid->address_moo->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->address_moo->getPlaceHolder()) ?>"<?= $Grid->address_moo->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_moo->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_address_address_moo" class="el_address_address_moo">
<span<?= $Grid->address_moo->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_moo->getDisplayValue($Grid->address_moo->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="address" data-field="x_address_moo" data-hidden="1" name="x<?= $Grid->RowIndex ?>_address_moo" id="x<?= $Grid->RowIndex ?>_address_moo" value="<?= HtmlEncode($Grid->address_moo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="address" data-field="x_address_moo" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_moo" id="o<?= $Grid->RowIndex ?>_address_moo" value="<?= HtmlEncode($Grid->address_moo->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->address_name->Visible) { // address_name ?>
        <td data-name="address_name">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_address_address_name" class="el_address_address_name">
<input type="<?= $Grid->address_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_name" id="x<?= $Grid->RowIndex ?>_address_name" data-table="address" data-field="x_address_name" value="<?= $Grid->address_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->address_name->getPlaceHolder()) ?>"<?= $Grid->address_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_name->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_address_address_name" class="el_address_address_name">
<span<?= $Grid->address_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_name->getDisplayValue($Grid->address_name->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="address" data-field="x_address_name" data-hidden="1" name="x<?= $Grid->RowIndex ?>_address_name" id="x<?= $Grid->RowIndex ?>_address_name" value="<?= HtmlEncode($Grid->address_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="address" data-field="x_address_name" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_name" id="o<?= $Grid->RowIndex ?>_address_name" value="<?= HtmlEncode($Grid->address_name->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->address_sub->Visible) { // address_sub ?>
        <td data-name="address_sub">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_address_address_sub" class="el_address_address_sub">
<input type="<?= $Grid->address_sub->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_sub" id="x<?= $Grid->RowIndex ?>_address_sub" data-table="address" data-field="x_address_sub" value="<?= $Grid->address_sub->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->address_sub->getPlaceHolder()) ?>"<?= $Grid->address_sub->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_sub->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_address_address_sub" class="el_address_address_sub">
<span<?= $Grid->address_sub->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_sub->getDisplayValue($Grid->address_sub->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="address" data-field="x_address_sub" data-hidden="1" name="x<?= $Grid->RowIndex ?>_address_sub" id="x<?= $Grid->RowIndex ?>_address_sub" value="<?= HtmlEncode($Grid->address_sub->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="address" data-field="x_address_sub" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_sub" id="o<?= $Grid->RowIndex ?>_address_sub" value="<?= HtmlEncode($Grid->address_sub->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->address_district->Visible) { // address_district ?>
        <td data-name="address_district">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_address_address_district" class="el_address_address_district">
<input type="<?= $Grid->address_district->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_district" id="x<?= $Grid->RowIndex ?>_address_district" data-table="address" data-field="x_address_district" value="<?= $Grid->address_district->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->address_district->getPlaceHolder()) ?>"<?= $Grid->address_district->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_district->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_address_address_district" class="el_address_address_district">
<span<?= $Grid->address_district->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_district->getDisplayValue($Grid->address_district->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="address" data-field="x_address_district" data-hidden="1" name="x<?= $Grid->RowIndex ?>_address_district" id="x<?= $Grid->RowIndex ?>_address_district" value="<?= HtmlEncode($Grid->address_district->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="address" data-field="x_address_district" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_district" id="o<?= $Grid->RowIndex ?>_address_district" value="<?= HtmlEncode($Grid->address_district->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->address_province->Visible) { // address_province ?>
        <td data-name="address_province">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_address_address_province" class="el_address_address_province">
<input type="<?= $Grid->address_province->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_province" id="x<?= $Grid->RowIndex ?>_address_province" data-table="address" data-field="x_address_province" value="<?= $Grid->address_province->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->address_province->getPlaceHolder()) ?>"<?= $Grid->address_province->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_province->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_address_address_province" class="el_address_address_province">
<span<?= $Grid->address_province->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_province->getDisplayValue($Grid->address_province->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="address" data-field="x_address_province" data-hidden="1" name="x<?= $Grid->RowIndex ?>_address_province" id="x<?= $Grid->RowIndex ?>_address_province" value="<?= HtmlEncode($Grid->address_province->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="address" data-field="x_address_province" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_province" id="o<?= $Grid->RowIndex ?>_address_province" value="<?= HtmlEncode($Grid->address_province->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->address_zip->Visible) { // address_zip ?>
        <td data-name="address_zip">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_address_address_zip" class="el_address_address_zip">
<input type="<?= $Grid->address_zip->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_address_zip" id="x<?= $Grid->RowIndex ?>_address_zip" data-table="address" data-field="x_address_zip" value="<?= $Grid->address_zip->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->address_zip->getPlaceHolder()) ?>"<?= $Grid->address_zip->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->address_zip->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_address_address_zip" class="el_address_address_zip">
<span<?= $Grid->address_zip->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->address_zip->getDisplayValue($Grid->address_zip->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="address" data-field="x_address_zip" data-hidden="1" name="x<?= $Grid->RowIndex ?>_address_zip" id="x<?= $Grid->RowIndex ?>_address_zip" value="<?= HtmlEncode($Grid->address_zip->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="address" data-field="x_address_zip" data-hidden="1" name="o<?= $Grid->RowIndex ?>_address_zip" id="o<?= $Grid->RowIndex ?>_address_zip" value="<?= HtmlEncode($Grid->address_zip->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["faddressgrid","load"], () => faddressgrid.updateLists(<?= $Grid->RowIndex ?>, true));
</script>
    </tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="faddressgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("address");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
