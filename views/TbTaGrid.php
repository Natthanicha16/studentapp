<?php

namespace PHPMaker2022\STUDENTT;

// Set up and run Grid object
$Grid = Container("TbTaGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var ftb_tagrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftb_tagrid = new ew.Form("ftb_tagrid", "grid");
    ftb_tagrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { tb_ta: currentTable } });
    var fields = currentTable.fields;
    ftb_tagrid.addFields([
        ["ta_id", [fields.ta_id.visible && fields.ta_id.required ? ew.Validators.required(fields.ta_id.caption) : null], fields.ta_id.isInvalid],
        ["taprefic_name", [fields.taprefic_name.visible && fields.taprefic_name.required ? ew.Validators.required(fields.taprefic_name.caption) : null, ew.Validators.integer], fields.taprefic_name.isInvalid],
        ["ta_name", [fields.ta_name.visible && fields.ta_name.required ? ew.Validators.required(fields.ta_name.caption) : null], fields.ta_name.isInvalid],
        ["ta_surname", [fields.ta_surname.visible && fields.ta_surname.required ? ew.Validators.required(fields.ta_surname.caption) : null], fields.ta_surname.isInvalid],
        ["ta_studentcode", [fields.ta_studentcode.visible && fields.ta_studentcode.required ? ew.Validators.required(fields.ta_studentcode.caption) : null], fields.ta_studentcode.isInvalid]
    ]);

    // Check empty row
    ftb_tagrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["taprefic_name",false],["ta_name",false],["ta_surname",false],["ta_studentcode",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    ftb_tagrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftb_tagrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ftb_tagrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tb_ta">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="ftb_tagrid" class="ew-form ew-list-form">
<div id="gmp_tb_ta" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_tb_tagrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Grid->ta_id->Visible) { // ta_id ?>
        <th data-name="ta_id" class="<?= $Grid->ta_id->headerCellClass() ?>"><div id="elh_tb_ta_ta_id" class="tb_ta_ta_id"><?= $Grid->renderFieldHeader($Grid->ta_id) ?></div></th>
<?php } ?>
<?php if ($Grid->taprefic_name->Visible) { // taprefic_name ?>
        <th data-name="taprefic_name" class="<?= $Grid->taprefic_name->headerCellClass() ?>"><div id="elh_tb_ta_taprefic_name" class="tb_ta_taprefic_name"><?= $Grid->renderFieldHeader($Grid->taprefic_name) ?></div></th>
<?php } ?>
<?php if ($Grid->ta_name->Visible) { // ta_name ?>
        <th data-name="ta_name" class="<?= $Grid->ta_name->headerCellClass() ?>"><div id="elh_tb_ta_ta_name" class="tb_ta_ta_name"><?= $Grid->renderFieldHeader($Grid->ta_name) ?></div></th>
<?php } ?>
<?php if ($Grid->ta_surname->Visible) { // ta_surname ?>
        <th data-name="ta_surname" class="<?= $Grid->ta_surname->headerCellClass() ?>"><div id="elh_tb_ta_ta_surname" class="tb_ta_ta_surname"><?= $Grid->renderFieldHeader($Grid->ta_surname) ?></div></th>
<?php } ?>
<?php if ($Grid->ta_studentcode->Visible) { // ta_studentcode ?>
        <th data-name="ta_studentcode" class="<?= $Grid->ta_studentcode->headerCellClass() ?>"><div id="elh_tb_ta_ta_studentcode" class="tb_ta_ta_studentcode"><?= $Grid->renderFieldHeader($Grid->ta_studentcode) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_tb_ta",
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
    <?php if ($Grid->ta_id->Visible) { // ta_id ?>
        <td data-name="ta_id"<?= $Grid->ta_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_id" class="el_tb_ta_ta_id"></span>
<input type="hidden" data-table="tb_ta" data-field="x_ta_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ta_id" id="o<?= $Grid->RowIndex ?>_ta_id" value="<?= HtmlEncode($Grid->ta_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_id" class="el_tb_ta_ta_id">
<span<?= $Grid->ta_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ta_id->getDisplayValue($Grid->ta_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="tb_ta" data-field="x_ta_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ta_id" id="x<?= $Grid->RowIndex ?>_ta_id" value="<?= HtmlEncode($Grid->ta_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_id" class="el_tb_ta_ta_id">
<span<?= $Grid->ta_id->viewAttributes() ?>>
<?= $Grid->ta_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tb_ta" data-field="x_ta_id" data-hidden="1" name="ftb_tagrid$x<?= $Grid->RowIndex ?>_ta_id" id="ftb_tagrid$x<?= $Grid->RowIndex ?>_ta_id" value="<?= HtmlEncode($Grid->ta_id->FormValue) ?>">
<input type="hidden" data-table="tb_ta" data-field="x_ta_id" data-hidden="1" name="ftb_tagrid$o<?= $Grid->RowIndex ?>_ta_id" id="ftb_tagrid$o<?= $Grid->RowIndex ?>_ta_id" value="<?= HtmlEncode($Grid->ta_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="tb_ta" data-field="x_ta_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ta_id" id="x<?= $Grid->RowIndex ?>_ta_id" value="<?= HtmlEncode($Grid->ta_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->taprefic_name->Visible) { // taprefic_name ?>
        <td data-name="taprefic_name"<?= $Grid->taprefic_name->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_taprefic_name" class="el_tb_ta_taprefic_name">
<input type="<?= $Grid->taprefic_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_taprefic_name" id="x<?= $Grid->RowIndex ?>_taprefic_name" data-table="tb_ta" data-field="x_taprefic_name" value="<?= $Grid->taprefic_name->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->taprefic_name->getPlaceHolder()) ?>"<?= $Grid->taprefic_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->taprefic_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="tb_ta" data-field="x_taprefic_name" data-hidden="1" name="o<?= $Grid->RowIndex ?>_taprefic_name" id="o<?= $Grid->RowIndex ?>_taprefic_name" value="<?= HtmlEncode($Grid->taprefic_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_taprefic_name" class="el_tb_ta_taprefic_name">
<input type="<?= $Grid->taprefic_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_taprefic_name" id="x<?= $Grid->RowIndex ?>_taprefic_name" data-table="tb_ta" data-field="x_taprefic_name" value="<?= $Grid->taprefic_name->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->taprefic_name->getPlaceHolder()) ?>"<?= $Grid->taprefic_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->taprefic_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_taprefic_name" class="el_tb_ta_taprefic_name">
<span<?= $Grid->taprefic_name->viewAttributes() ?>>
<?= $Grid->taprefic_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tb_ta" data-field="x_taprefic_name" data-hidden="1" name="ftb_tagrid$x<?= $Grid->RowIndex ?>_taprefic_name" id="ftb_tagrid$x<?= $Grid->RowIndex ?>_taprefic_name" value="<?= HtmlEncode($Grid->taprefic_name->FormValue) ?>">
<input type="hidden" data-table="tb_ta" data-field="x_taprefic_name" data-hidden="1" name="ftb_tagrid$o<?= $Grid->RowIndex ?>_taprefic_name" id="ftb_tagrid$o<?= $Grid->RowIndex ?>_taprefic_name" value="<?= HtmlEncode($Grid->taprefic_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ta_name->Visible) { // ta_name ?>
        <td data-name="ta_name"<?= $Grid->ta_name->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_name" class="el_tb_ta_ta_name">
<input type="<?= $Grid->ta_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ta_name" id="x<?= $Grid->RowIndex ?>_ta_name" data-table="tb_ta" data-field="x_ta_name" value="<?= $Grid->ta_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ta_name->getPlaceHolder()) ?>"<?= $Grid->ta_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ta_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="tb_ta" data-field="x_ta_name" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ta_name" id="o<?= $Grid->RowIndex ?>_ta_name" value="<?= HtmlEncode($Grid->ta_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_name" class="el_tb_ta_ta_name">
<input type="<?= $Grid->ta_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ta_name" id="x<?= $Grid->RowIndex ?>_ta_name" data-table="tb_ta" data-field="x_ta_name" value="<?= $Grid->ta_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ta_name->getPlaceHolder()) ?>"<?= $Grid->ta_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ta_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_name" class="el_tb_ta_ta_name">
<span<?= $Grid->ta_name->viewAttributes() ?>>
<?= $Grid->ta_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tb_ta" data-field="x_ta_name" data-hidden="1" name="ftb_tagrid$x<?= $Grid->RowIndex ?>_ta_name" id="ftb_tagrid$x<?= $Grid->RowIndex ?>_ta_name" value="<?= HtmlEncode($Grid->ta_name->FormValue) ?>">
<input type="hidden" data-table="tb_ta" data-field="x_ta_name" data-hidden="1" name="ftb_tagrid$o<?= $Grid->RowIndex ?>_ta_name" id="ftb_tagrid$o<?= $Grid->RowIndex ?>_ta_name" value="<?= HtmlEncode($Grid->ta_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ta_surname->Visible) { // ta_surname ?>
        <td data-name="ta_surname"<?= $Grid->ta_surname->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_surname" class="el_tb_ta_ta_surname">
<input type="<?= $Grid->ta_surname->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ta_surname" id="x<?= $Grid->RowIndex ?>_ta_surname" data-table="tb_ta" data-field="x_ta_surname" value="<?= $Grid->ta_surname->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ta_surname->getPlaceHolder()) ?>"<?= $Grid->ta_surname->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ta_surname->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="tb_ta" data-field="x_ta_surname" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ta_surname" id="o<?= $Grid->RowIndex ?>_ta_surname" value="<?= HtmlEncode($Grid->ta_surname->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_surname" class="el_tb_ta_ta_surname">
<input type="<?= $Grid->ta_surname->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ta_surname" id="x<?= $Grid->RowIndex ?>_ta_surname" data-table="tb_ta" data-field="x_ta_surname" value="<?= $Grid->ta_surname->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ta_surname->getPlaceHolder()) ?>"<?= $Grid->ta_surname->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ta_surname->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_surname" class="el_tb_ta_ta_surname">
<span<?= $Grid->ta_surname->viewAttributes() ?>>
<?= $Grid->ta_surname->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tb_ta" data-field="x_ta_surname" data-hidden="1" name="ftb_tagrid$x<?= $Grid->RowIndex ?>_ta_surname" id="ftb_tagrid$x<?= $Grid->RowIndex ?>_ta_surname" value="<?= HtmlEncode($Grid->ta_surname->FormValue) ?>">
<input type="hidden" data-table="tb_ta" data-field="x_ta_surname" data-hidden="1" name="ftb_tagrid$o<?= $Grid->RowIndex ?>_ta_surname" id="ftb_tagrid$o<?= $Grid->RowIndex ?>_ta_surname" value="<?= HtmlEncode($Grid->ta_surname->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ta_studentcode->Visible) { // ta_studentcode ?>
        <td data-name="ta_studentcode"<?= $Grid->ta_studentcode->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->ta_studentcode->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_studentcode" class="el_tb_ta_ta_studentcode">
<span<?= $Grid->ta_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ta_studentcode->getDisplayValue($Grid->ta_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_ta_studentcode" name="x<?= $Grid->RowIndex ?>_ta_studentcode" value="<?= HtmlEncode($Grid->ta_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_studentcode" class="el_tb_ta_ta_studentcode">
<input type="<?= $Grid->ta_studentcode->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ta_studentcode" id="x<?= $Grid->RowIndex ?>_ta_studentcode" data-table="tb_ta" data-field="x_ta_studentcode" value="<?= $Grid->ta_studentcode->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->ta_studentcode->getPlaceHolder()) ?>"<?= $Grid->ta_studentcode->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ta_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="tb_ta" data-field="x_ta_studentcode" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ta_studentcode" id="o<?= $Grid->RowIndex ?>_ta_studentcode" value="<?= HtmlEncode($Grid->ta_studentcode->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->ta_studentcode->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_studentcode" class="el_tb_ta_ta_studentcode">
<span<?= $Grid->ta_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ta_studentcode->getDisplayValue($Grid->ta_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_ta_studentcode" name="x<?= $Grid->RowIndex ?>_ta_studentcode" value="<?= HtmlEncode($Grid->ta_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_studentcode" class="el_tb_ta_ta_studentcode">
<input type="<?= $Grid->ta_studentcode->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ta_studentcode" id="x<?= $Grid->RowIndex ?>_ta_studentcode" data-table="tb_ta" data-field="x_ta_studentcode" value="<?= $Grid->ta_studentcode->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->ta_studentcode->getPlaceHolder()) ?>"<?= $Grid->ta_studentcode->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ta_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tb_ta_ta_studentcode" class="el_tb_ta_ta_studentcode">
<span<?= $Grid->ta_studentcode->viewAttributes() ?>>
<?= $Grid->ta_studentcode->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tb_ta" data-field="x_ta_studentcode" data-hidden="1" name="ftb_tagrid$x<?= $Grid->RowIndex ?>_ta_studentcode" id="ftb_tagrid$x<?= $Grid->RowIndex ?>_ta_studentcode" value="<?= HtmlEncode($Grid->ta_studentcode->FormValue) ?>">
<input type="hidden" data-table="tb_ta" data-field="x_ta_studentcode" data-hidden="1" name="ftb_tagrid$o<?= $Grid->RowIndex ?>_ta_studentcode" id="ftb_tagrid$o<?= $Grid->RowIndex ?>_ta_studentcode" value="<?= HtmlEncode($Grid->ta_studentcode->OldValue) ?>">
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
loadjs.ready(["ftb_tagrid","load"], () => ftb_tagrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_tb_ta", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->ta_id->Visible) { // ta_id ?>
        <td data-name="ta_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_tb_ta_ta_id" class="el_tb_ta_ta_id"></span>
<?php } else { ?>
<span id="el$rowindex$_tb_ta_ta_id" class="el_tb_ta_ta_id">
<span<?= $Grid->ta_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ta_id->getDisplayValue($Grid->ta_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tb_ta" data-field="x_ta_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ta_id" id="x<?= $Grid->RowIndex ?>_ta_id" value="<?= HtmlEncode($Grid->ta_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tb_ta" data-field="x_ta_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ta_id" id="o<?= $Grid->RowIndex ?>_ta_id" value="<?= HtmlEncode($Grid->ta_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->taprefic_name->Visible) { // taprefic_name ?>
        <td data-name="taprefic_name">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_tb_ta_taprefic_name" class="el_tb_ta_taprefic_name">
<input type="<?= $Grid->taprefic_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_taprefic_name" id="x<?= $Grid->RowIndex ?>_taprefic_name" data-table="tb_ta" data-field="x_taprefic_name" value="<?= $Grid->taprefic_name->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Grid->taprefic_name->getPlaceHolder()) ?>"<?= $Grid->taprefic_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->taprefic_name->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tb_ta_taprefic_name" class="el_tb_ta_taprefic_name">
<span<?= $Grid->taprefic_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->taprefic_name->getDisplayValue($Grid->taprefic_name->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tb_ta" data-field="x_taprefic_name" data-hidden="1" name="x<?= $Grid->RowIndex ?>_taprefic_name" id="x<?= $Grid->RowIndex ?>_taprefic_name" value="<?= HtmlEncode($Grid->taprefic_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tb_ta" data-field="x_taprefic_name" data-hidden="1" name="o<?= $Grid->RowIndex ?>_taprefic_name" id="o<?= $Grid->RowIndex ?>_taprefic_name" value="<?= HtmlEncode($Grid->taprefic_name->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ta_name->Visible) { // ta_name ?>
        <td data-name="ta_name">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_tb_ta_ta_name" class="el_tb_ta_ta_name">
<input type="<?= $Grid->ta_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ta_name" id="x<?= $Grid->RowIndex ?>_ta_name" data-table="tb_ta" data-field="x_ta_name" value="<?= $Grid->ta_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ta_name->getPlaceHolder()) ?>"<?= $Grid->ta_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ta_name->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tb_ta_ta_name" class="el_tb_ta_ta_name">
<span<?= $Grid->ta_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ta_name->getDisplayValue($Grid->ta_name->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tb_ta" data-field="x_ta_name" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ta_name" id="x<?= $Grid->RowIndex ?>_ta_name" value="<?= HtmlEncode($Grid->ta_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tb_ta" data-field="x_ta_name" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ta_name" id="o<?= $Grid->RowIndex ?>_ta_name" value="<?= HtmlEncode($Grid->ta_name->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ta_surname->Visible) { // ta_surname ?>
        <td data-name="ta_surname">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_tb_ta_ta_surname" class="el_tb_ta_ta_surname">
<input type="<?= $Grid->ta_surname->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ta_surname" id="x<?= $Grid->RowIndex ?>_ta_surname" data-table="tb_ta" data-field="x_ta_surname" value="<?= $Grid->ta_surname->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->ta_surname->getPlaceHolder()) ?>"<?= $Grid->ta_surname->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ta_surname->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tb_ta_ta_surname" class="el_tb_ta_ta_surname">
<span<?= $Grid->ta_surname->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ta_surname->getDisplayValue($Grid->ta_surname->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tb_ta" data-field="x_ta_surname" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ta_surname" id="x<?= $Grid->RowIndex ?>_ta_surname" value="<?= HtmlEncode($Grid->ta_surname->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tb_ta" data-field="x_ta_surname" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ta_surname" id="o<?= $Grid->RowIndex ?>_ta_surname" value="<?= HtmlEncode($Grid->ta_surname->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ta_studentcode->Visible) { // ta_studentcode ?>
        <td data-name="ta_studentcode">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->ta_studentcode->getSessionValue() != "") { ?>
<span id="el$rowindex$_tb_ta_ta_studentcode" class="el_tb_ta_ta_studentcode">
<span<?= $Grid->ta_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ta_studentcode->getDisplayValue($Grid->ta_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_ta_studentcode" name="x<?= $Grid->RowIndex ?>_ta_studentcode" value="<?= HtmlEncode($Grid->ta_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_tb_ta_ta_studentcode" class="el_tb_ta_ta_studentcode">
<input type="<?= $Grid->ta_studentcode->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ta_studentcode" id="x<?= $Grid->RowIndex ?>_ta_studentcode" data-table="tb_ta" data-field="x_ta_studentcode" value="<?= $Grid->ta_studentcode->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->ta_studentcode->getPlaceHolder()) ?>"<?= $Grid->ta_studentcode->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ta_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_tb_ta_ta_studentcode" class="el_tb_ta_ta_studentcode">
<span<?= $Grid->ta_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ta_studentcode->getDisplayValue($Grid->ta_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tb_ta" data-field="x_ta_studentcode" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ta_studentcode" id="x<?= $Grid->RowIndex ?>_ta_studentcode" value="<?= HtmlEncode($Grid->ta_studentcode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tb_ta" data-field="x_ta_studentcode" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ta_studentcode" id="o<?= $Grid->RowIndex ?>_ta_studentcode" value="<?= HtmlEncode($Grid->ta_studentcode->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["ftb_tagrid","load"], () => ftb_tagrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="ftb_tagrid">
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
    ew.addEventHandlers("tb_ta");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
