<?php

namespace PHPMaker2022\STUDENTT;

// Set up and run Grid object
$Grid = Container("TbstudyGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var ftbstudygrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftbstudygrid = new ew.Form("ftbstudygrid", "grid");
    ftbstudygrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { tbstudy: currentTable } });
    var fields = currentTable.fields;
    ftbstudygrid.addFields([
        ["study_id", [fields.study_id.visible && fields.study_id.required ? ew.Validators.required(fields.study_id.caption) : null], fields.study_id.isInvalid],
        ["study_name", [fields.study_name.visible && fields.study_name.required ? ew.Validators.required(fields.study_name.caption) : null], fields.study_name.isInvalid],
        ["study_level", [fields.study_level.visible && fields.study_level.required ? ew.Validators.required(fields.study_level.caption) : null], fields.study_level.isInvalid],
        ["study_studentcode", [fields.study_studentcode.visible && fields.study_studentcode.required ? ew.Validators.required(fields.study_studentcode.caption) : null], fields.study_studentcode.isInvalid]
    ]);

    // Check empty row
    ftbstudygrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["study_name",false],["study_level",false],["study_studentcode",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    ftbstudygrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftbstudygrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ftbstudygrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tbstudy">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="ftbstudygrid" class="ew-form ew-list-form">
<div id="gmp_tbstudy" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_tbstudygrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Grid->study_id->Visible) { // study_id ?>
        <th data-name="study_id" class="<?= $Grid->study_id->headerCellClass() ?>"><div id="elh_tbstudy_study_id" class="tbstudy_study_id"><?= $Grid->renderFieldHeader($Grid->study_id) ?></div></th>
<?php } ?>
<?php if ($Grid->study_name->Visible) { // study_name ?>
        <th data-name="study_name" class="<?= $Grid->study_name->headerCellClass() ?>"><div id="elh_tbstudy_study_name" class="tbstudy_study_name"><?= $Grid->renderFieldHeader($Grid->study_name) ?></div></th>
<?php } ?>
<?php if ($Grid->study_level->Visible) { // study_level ?>
        <th data-name="study_level" class="<?= $Grid->study_level->headerCellClass() ?>"><div id="elh_tbstudy_study_level" class="tbstudy_study_level"><?= $Grid->renderFieldHeader($Grid->study_level) ?></div></th>
<?php } ?>
<?php if ($Grid->study_studentcode->Visible) { // study_studentcode ?>
        <th data-name="study_studentcode" class="<?= $Grid->study_studentcode->headerCellClass() ?>"><div id="elh_tbstudy_study_studentcode" class="tbstudy_study_studentcode"><?= $Grid->renderFieldHeader($Grid->study_studentcode) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_tbstudy",
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
    <?php if ($Grid->study_id->Visible) { // study_id ?>
        <td data-name="study_id"<?= $Grid->study_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_id" class="el_tbstudy_study_id"></span>
<input type="hidden" data-table="tbstudy" data-field="x_study_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_study_id" id="o<?= $Grid->RowIndex ?>_study_id" value="<?= HtmlEncode($Grid->study_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_id" class="el_tbstudy_study_id">
<span<?= $Grid->study_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->study_id->getDisplayValue($Grid->study_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="tbstudy" data-field="x_study_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_study_id" id="x<?= $Grid->RowIndex ?>_study_id" value="<?= HtmlEncode($Grid->study_id->CurrentValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_id" class="el_tbstudy_study_id">
<span<?= $Grid->study_id->viewAttributes() ?>>
<?= $Grid->study_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tbstudy" data-field="x_study_id" data-hidden="1" name="ftbstudygrid$x<?= $Grid->RowIndex ?>_study_id" id="ftbstudygrid$x<?= $Grid->RowIndex ?>_study_id" value="<?= HtmlEncode($Grid->study_id->FormValue) ?>">
<input type="hidden" data-table="tbstudy" data-field="x_study_id" data-hidden="1" name="ftbstudygrid$o<?= $Grid->RowIndex ?>_study_id" id="ftbstudygrid$o<?= $Grid->RowIndex ?>_study_id" value="<?= HtmlEncode($Grid->study_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="tbstudy" data-field="x_study_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_study_id" id="x<?= $Grid->RowIndex ?>_study_id" value="<?= HtmlEncode($Grid->study_id->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->study_name->Visible) { // study_name ?>
        <td data-name="study_name"<?= $Grid->study_name->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_name" class="el_tbstudy_study_name">
<input type="<?= $Grid->study_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_study_name" id="x<?= $Grid->RowIndex ?>_study_name" data-table="tbstudy" data-field="x_study_name" value="<?= $Grid->study_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->study_name->getPlaceHolder()) ?>"<?= $Grid->study_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->study_name->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="tbstudy" data-field="x_study_name" data-hidden="1" name="o<?= $Grid->RowIndex ?>_study_name" id="o<?= $Grid->RowIndex ?>_study_name" value="<?= HtmlEncode($Grid->study_name->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_name" class="el_tbstudy_study_name">
<input type="<?= $Grid->study_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_study_name" id="x<?= $Grid->RowIndex ?>_study_name" data-table="tbstudy" data-field="x_study_name" value="<?= $Grid->study_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->study_name->getPlaceHolder()) ?>"<?= $Grid->study_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->study_name->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_name" class="el_tbstudy_study_name">
<span<?= $Grid->study_name->viewAttributes() ?>>
<?= $Grid->study_name->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tbstudy" data-field="x_study_name" data-hidden="1" name="ftbstudygrid$x<?= $Grid->RowIndex ?>_study_name" id="ftbstudygrid$x<?= $Grid->RowIndex ?>_study_name" value="<?= HtmlEncode($Grid->study_name->FormValue) ?>">
<input type="hidden" data-table="tbstudy" data-field="x_study_name" data-hidden="1" name="ftbstudygrid$o<?= $Grid->RowIndex ?>_study_name" id="ftbstudygrid$o<?= $Grid->RowIndex ?>_study_name" value="<?= HtmlEncode($Grid->study_name->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->study_level->Visible) { // study_level ?>
        <td data-name="study_level"<?= $Grid->study_level->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_level" class="el_tbstudy_study_level">
<input type="<?= $Grid->study_level->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_study_level" id="x<?= $Grid->RowIndex ?>_study_level" data-table="tbstudy" data-field="x_study_level" value="<?= $Grid->study_level->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->study_level->getPlaceHolder()) ?>"<?= $Grid->study_level->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->study_level->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="tbstudy" data-field="x_study_level" data-hidden="1" name="o<?= $Grid->RowIndex ?>_study_level" id="o<?= $Grid->RowIndex ?>_study_level" value="<?= HtmlEncode($Grid->study_level->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_level" class="el_tbstudy_study_level">
<input type="<?= $Grid->study_level->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_study_level" id="x<?= $Grid->RowIndex ?>_study_level" data-table="tbstudy" data-field="x_study_level" value="<?= $Grid->study_level->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->study_level->getPlaceHolder()) ?>"<?= $Grid->study_level->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->study_level->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_level" class="el_tbstudy_study_level">
<span<?= $Grid->study_level->viewAttributes() ?>>
<?= $Grid->study_level->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tbstudy" data-field="x_study_level" data-hidden="1" name="ftbstudygrid$x<?= $Grid->RowIndex ?>_study_level" id="ftbstudygrid$x<?= $Grid->RowIndex ?>_study_level" value="<?= HtmlEncode($Grid->study_level->FormValue) ?>">
<input type="hidden" data-table="tbstudy" data-field="x_study_level" data-hidden="1" name="ftbstudygrid$o<?= $Grid->RowIndex ?>_study_level" id="ftbstudygrid$o<?= $Grid->RowIndex ?>_study_level" value="<?= HtmlEncode($Grid->study_level->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->study_studentcode->Visible) { // study_studentcode ?>
        <td data-name="study_studentcode"<?= $Grid->study_studentcode->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($Grid->study_studentcode->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_studentcode" class="el_tbstudy_study_studentcode">
<span<?= $Grid->study_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->study_studentcode->getDisplayValue($Grid->study_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_study_studentcode" name="x<?= $Grid->RowIndex ?>_study_studentcode" value="<?= HtmlEncode($Grid->study_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_studentcode" class="el_tbstudy_study_studentcode">
<input type="<?= $Grid->study_studentcode->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_study_studentcode" id="x<?= $Grid->RowIndex ?>_study_studentcode" data-table="tbstudy" data-field="x_study_studentcode" value="<?= $Grid->study_studentcode->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Grid->study_studentcode->getPlaceHolder()) ?>"<?= $Grid->study_studentcode->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->study_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
<input type="hidden" data-table="tbstudy" data-field="x_study_studentcode" data-hidden="1" name="o<?= $Grid->RowIndex ?>_study_studentcode" id="o<?= $Grid->RowIndex ?>_study_studentcode" value="<?= HtmlEncode($Grid->study_studentcode->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($Grid->study_studentcode->getSessionValue() != "") { ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_studentcode" class="el_tbstudy_study_studentcode">
<span<?= $Grid->study_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->study_studentcode->getDisplayValue($Grid->study_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_study_studentcode" name="x<?= $Grid->RowIndex ?>_study_studentcode" value="<?= HtmlEncode($Grid->study_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_studentcode" class="el_tbstudy_study_studentcode">
<input type="<?= $Grid->study_studentcode->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_study_studentcode" id="x<?= $Grid->RowIndex ?>_study_studentcode" data-table="tbstudy" data-field="x_study_studentcode" value="<?= $Grid->study_studentcode->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Grid->study_studentcode->getPlaceHolder()) ?>"<?= $Grid->study_studentcode->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->study_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_tbstudy_study_studentcode" class="el_tbstudy_study_studentcode">
<span<?= $Grid->study_studentcode->viewAttributes() ?>>
<?= $Grid->study_studentcode->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="tbstudy" data-field="x_study_studentcode" data-hidden="1" name="ftbstudygrid$x<?= $Grid->RowIndex ?>_study_studentcode" id="ftbstudygrid$x<?= $Grid->RowIndex ?>_study_studentcode" value="<?= HtmlEncode($Grid->study_studentcode->FormValue) ?>">
<input type="hidden" data-table="tbstudy" data-field="x_study_studentcode" data-hidden="1" name="ftbstudygrid$o<?= $Grid->RowIndex ?>_study_studentcode" id="ftbstudygrid$o<?= $Grid->RowIndex ?>_study_studentcode" value="<?= HtmlEncode($Grid->study_studentcode->OldValue) ?>">
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
loadjs.ready(["ftbstudygrid","load"], () => ftbstudygrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_tbstudy", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->study_id->Visible) { // study_id ?>
        <td data-name="study_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_tbstudy_study_id" class="el_tbstudy_study_id"></span>
<?php } else { ?>
<span id="el$rowindex$_tbstudy_study_id" class="el_tbstudy_study_id">
<span<?= $Grid->study_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->study_id->getDisplayValue($Grid->study_id->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tbstudy" data-field="x_study_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_study_id" id="x<?= $Grid->RowIndex ?>_study_id" value="<?= HtmlEncode($Grid->study_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbstudy" data-field="x_study_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_study_id" id="o<?= $Grid->RowIndex ?>_study_id" value="<?= HtmlEncode($Grid->study_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->study_name->Visible) { // study_name ?>
        <td data-name="study_name">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_tbstudy_study_name" class="el_tbstudy_study_name">
<input type="<?= $Grid->study_name->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_study_name" id="x<?= $Grid->RowIndex ?>_study_name" data-table="tbstudy" data-field="x_study_name" value="<?= $Grid->study_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->study_name->getPlaceHolder()) ?>"<?= $Grid->study_name->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->study_name->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbstudy_study_name" class="el_tbstudy_study_name">
<span<?= $Grid->study_name->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->study_name->getDisplayValue($Grid->study_name->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tbstudy" data-field="x_study_name" data-hidden="1" name="x<?= $Grid->RowIndex ?>_study_name" id="x<?= $Grid->RowIndex ?>_study_name" value="<?= HtmlEncode($Grid->study_name->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbstudy" data-field="x_study_name" data-hidden="1" name="o<?= $Grid->RowIndex ?>_study_name" id="o<?= $Grid->RowIndex ?>_study_name" value="<?= HtmlEncode($Grid->study_name->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->study_level->Visible) { // study_level ?>
        <td data-name="study_level">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_tbstudy_study_level" class="el_tbstudy_study_level">
<input type="<?= $Grid->study_level->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_study_level" id="x<?= $Grid->RowIndex ?>_study_level" data-table="tbstudy" data-field="x_study_level" value="<?= $Grid->study_level->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->study_level->getPlaceHolder()) ?>"<?= $Grid->study_level->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->study_level->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_tbstudy_study_level" class="el_tbstudy_study_level">
<span<?= $Grid->study_level->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->study_level->getDisplayValue($Grid->study_level->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tbstudy" data-field="x_study_level" data-hidden="1" name="x<?= $Grid->RowIndex ?>_study_level" id="x<?= $Grid->RowIndex ?>_study_level" value="<?= HtmlEncode($Grid->study_level->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbstudy" data-field="x_study_level" data-hidden="1" name="o<?= $Grid->RowIndex ?>_study_level" id="o<?= $Grid->RowIndex ?>_study_level" value="<?= HtmlEncode($Grid->study_level->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->study_studentcode->Visible) { // study_studentcode ?>
        <td data-name="study_studentcode">
<?php if (!$Grid->isConfirm()) { ?>
<?php if ($Grid->study_studentcode->getSessionValue() != "") { ?>
<span id="el$rowindex$_tbstudy_study_studentcode" class="el_tbstudy_study_studentcode">
<span<?= $Grid->study_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->study_studentcode->getDisplayValue($Grid->study_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x<?= $Grid->RowIndex ?>_study_studentcode" name="x<?= $Grid->RowIndex ?>_study_studentcode" value="<?= HtmlEncode($Grid->study_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el$rowindex$_tbstudy_study_studentcode" class="el_tbstudy_study_studentcode">
<input type="<?= $Grid->study_studentcode->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_study_studentcode" id="x<?= $Grid->RowIndex ?>_study_studentcode" data-table="tbstudy" data-field="x_study_studentcode" value="<?= $Grid->study_studentcode->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Grid->study_studentcode->getPlaceHolder()) ?>"<?= $Grid->study_studentcode->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->study_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_tbstudy_study_studentcode" class="el_tbstudy_study_studentcode">
<span<?= $Grid->study_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->study_studentcode->getDisplayValue($Grid->study_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="tbstudy" data-field="x_study_studentcode" data-hidden="1" name="x<?= $Grid->RowIndex ?>_study_studentcode" id="x<?= $Grid->RowIndex ?>_study_studentcode" value="<?= HtmlEncode($Grid->study_studentcode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="tbstudy" data-field="x_study_studentcode" data-hidden="1" name="o<?= $Grid->RowIndex ?>_study_studentcode" id="o<?= $Grid->RowIndex ?>_study_studentcode" value="<?= HtmlEncode($Grid->study_studentcode->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["ftbstudygrid","load"], () => ftbstudygrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="ftbstudygrid">
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
    ew.addEventHandlers("tbstudy");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
