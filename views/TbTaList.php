<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$TbTaList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tb_ta: currentTable } });
var currentForm, currentPageID;
var ftb_talist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftb_talist = new ew.Form("ftb_talist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = ftb_talist;
    ftb_talist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("ftb_talist");
});
var ftb_tasrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    ftb_tasrch = new ew.Form("ftb_tasrch", "list");
    currentSearchForm = ftb_tasrch;

    // Dynamic selection lists

    // Filters
    ftb_tasrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("ftb_tasrch");
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
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "students") {
    if ($Page->MasterRecordExists) {
        include_once "views/StudentsMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="ftb_tasrch" id="ftb_tasrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="ftb_tasrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tb_ta">
<div class="ew-extended-search container-fluid">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="ftb_tasrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="ftb_tasrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="ftb_tasrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="ftb_tasrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tb_ta">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
</div>
<?php } ?>
<form name="ftb_talist" id="ftb_talist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tb_ta">
<?php if ($Page->getCurrentMasterTable() == "students" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="students">
<input type="hidden" name="fk_student_code" value="<?= HtmlEncode($Page->ta_studentcode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_tb_ta" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_tb_talist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->ta_id->Visible) { // ta_id ?>
        <th data-name="ta_id" class="<?= $Page->ta_id->headerCellClass() ?>"><div id="elh_tb_ta_ta_id" class="tb_ta_ta_id"><?= $Page->renderFieldHeader($Page->ta_id) ?></div></th>
<?php } ?>
<?php if ($Page->taprefic_name->Visible) { // taprefic_name ?>
        <th data-name="taprefic_name" class="<?= $Page->taprefic_name->headerCellClass() ?>"><div id="elh_tb_ta_taprefic_name" class="tb_ta_taprefic_name"><?= $Page->renderFieldHeader($Page->taprefic_name) ?></div></th>
<?php } ?>
<?php if ($Page->ta_name->Visible) { // ta_name ?>
        <th data-name="ta_name" class="<?= $Page->ta_name->headerCellClass() ?>"><div id="elh_tb_ta_ta_name" class="tb_ta_ta_name"><?= $Page->renderFieldHeader($Page->ta_name) ?></div></th>
<?php } ?>
<?php if ($Page->ta_surname->Visible) { // ta_surname ?>
        <th data-name="ta_surname" class="<?= $Page->ta_surname->headerCellClass() ?>"><div id="elh_tb_ta_ta_surname" class="tb_ta_ta_surname"><?= $Page->renderFieldHeader($Page->ta_surname) ?></div></th>
<?php } ?>
<?php if ($Page->ta_studentcode->Visible) { // ta_studentcode ?>
        <th data-name="ta_studentcode" class="<?= $Page->ta_studentcode->headerCellClass() ?>"><div id="elh_tb_ta_ta_studentcode" class="tb_ta_ta_studentcode"><?= $Page->renderFieldHeader($Page->ta_studentcode) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_tb_ta",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->ta_id->Visible) { // ta_id ?>
        <td data-name="ta_id"<?= $Page->ta_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tb_ta_ta_id" class="el_tb_ta_ta_id">
<span<?= $Page->ta_id->viewAttributes() ?>>
<?= $Page->ta_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->taprefic_name->Visible) { // taprefic_name ?>
        <td data-name="taprefic_name"<?= $Page->taprefic_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tb_ta_taprefic_name" class="el_tb_ta_taprefic_name">
<span<?= $Page->taprefic_name->viewAttributes() ?>>
<?= $Page->taprefic_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ta_name->Visible) { // ta_name ?>
        <td data-name="ta_name"<?= $Page->ta_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tb_ta_ta_name" class="el_tb_ta_ta_name">
<span<?= $Page->ta_name->viewAttributes() ?>>
<?= $Page->ta_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ta_surname->Visible) { // ta_surname ?>
        <td data-name="ta_surname"<?= $Page->ta_surname->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tb_ta_ta_surname" class="el_tb_ta_ta_surname">
<span<?= $Page->ta_surname->viewAttributes() ?>>
<?= $Page->ta_surname->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ta_studentcode->Visible) { // ta_studentcode ?>
        <td data-name="ta_studentcode"<?= $Page->ta_studentcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_tb_ta_ta_studentcode" class="el_tb_ta_ta_studentcode">
<span<?= $Page->ta_studentcode->viewAttributes() ?>>
<?= $Page->ta_studentcode->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
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
