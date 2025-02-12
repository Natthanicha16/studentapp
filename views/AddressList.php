<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$AddressList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { address: currentTable } });
var currentForm, currentPageID;
var faddresslist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    faddresslist = new ew.Form("faddresslist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = faddresslist;
    faddresslist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("faddresslist");
});
var faddresssrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    faddresssrch = new ew.Form("faddresssrch", "list");
    currentSearchForm = faddresssrch;

    // Dynamic selection lists

    // Filters
    faddresssrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("faddresssrch");
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
<form name="faddresssrch" id="faddresssrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="faddresssrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="address">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="faddresssrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="faddresssrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="faddresssrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="faddresssrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> address">
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
<form name="faddresslist" id="faddresslist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="address">
<?php if ($Page->getCurrentMasterTable() == "students" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="students">
<input type="hidden" name="fk_student_code" value="<?= HtmlEncode($Page->address_studentcode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_address" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_addresslist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->address_id->Visible) { // address_id ?>
        <th data-name="address_id" class="<?= $Page->address_id->headerCellClass() ?>"><div id="elh_address_address_id" class="address_address_id"><?= $Page->renderFieldHeader($Page->address_id) ?></div></th>
<?php } ?>
<?php if ($Page->address_studentcode->Visible) { // address_studentcode ?>
        <th data-name="address_studentcode" class="<?= $Page->address_studentcode->headerCellClass() ?>"><div id="elh_address_address_studentcode" class="address_address_studentcode"><?= $Page->renderFieldHeader($Page->address_studentcode) ?></div></th>
<?php } ?>
<?php if ($Page->address_moo->Visible) { // address_moo ?>
        <th data-name="address_moo" class="<?= $Page->address_moo->headerCellClass() ?>"><div id="elh_address_address_moo" class="address_address_moo"><?= $Page->renderFieldHeader($Page->address_moo) ?></div></th>
<?php } ?>
<?php if ($Page->address_name->Visible) { // address_name ?>
        <th data-name="address_name" class="<?= $Page->address_name->headerCellClass() ?>"><div id="elh_address_address_name" class="address_address_name"><?= $Page->renderFieldHeader($Page->address_name) ?></div></th>
<?php } ?>
<?php if ($Page->address_sub->Visible) { // address_sub ?>
        <th data-name="address_sub" class="<?= $Page->address_sub->headerCellClass() ?>"><div id="elh_address_address_sub" class="address_address_sub"><?= $Page->renderFieldHeader($Page->address_sub) ?></div></th>
<?php } ?>
<?php if ($Page->address_district->Visible) { // address_district ?>
        <th data-name="address_district" class="<?= $Page->address_district->headerCellClass() ?>"><div id="elh_address_address_district" class="address_address_district"><?= $Page->renderFieldHeader($Page->address_district) ?></div></th>
<?php } ?>
<?php if ($Page->address_province->Visible) { // address_province ?>
        <th data-name="address_province" class="<?= $Page->address_province->headerCellClass() ?>"><div id="elh_address_address_province" class="address_address_province"><?= $Page->renderFieldHeader($Page->address_province) ?></div></th>
<?php } ?>
<?php if ($Page->address_zip->Visible) { // address_zip ?>
        <th data-name="address_zip" class="<?= $Page->address_zip->headerCellClass() ?>"><div id="elh_address_address_zip" class="address_address_zip"><?= $Page->renderFieldHeader($Page->address_zip) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_address",
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
    <?php if ($Page->address_id->Visible) { // address_id ?>
        <td data-name="address_id"<?= $Page->address_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_id" class="el_address_address_id">
<span<?= $Page->address_id->viewAttributes() ?>>
<?= $Page->address_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->address_studentcode->Visible) { // address_studentcode ?>
        <td data-name="address_studentcode"<?= $Page->address_studentcode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_studentcode" class="el_address_address_studentcode">
<span<?= $Page->address_studentcode->viewAttributes() ?>>
<?= $Page->address_studentcode->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->address_moo->Visible) { // address_moo ?>
        <td data-name="address_moo"<?= $Page->address_moo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_moo" class="el_address_address_moo">
<span<?= $Page->address_moo->viewAttributes() ?>>
<?= $Page->address_moo->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->address_name->Visible) { // address_name ?>
        <td data-name="address_name"<?= $Page->address_name->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_name" class="el_address_address_name">
<span<?= $Page->address_name->viewAttributes() ?>>
<?= $Page->address_name->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->address_sub->Visible) { // address_sub ?>
        <td data-name="address_sub"<?= $Page->address_sub->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_sub" class="el_address_address_sub">
<span<?= $Page->address_sub->viewAttributes() ?>>
<?= $Page->address_sub->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->address_district->Visible) { // address_district ?>
        <td data-name="address_district"<?= $Page->address_district->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_district" class="el_address_address_district">
<span<?= $Page->address_district->viewAttributes() ?>>
<?= $Page->address_district->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->address_province->Visible) { // address_province ?>
        <td data-name="address_province"<?= $Page->address_province->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_province" class="el_address_address_province">
<span<?= $Page->address_province->viewAttributes() ?>>
<?= $Page->address_province->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->address_zip->Visible) { // address_zip ?>
        <td data-name="address_zip"<?= $Page->address_zip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_address_address_zip" class="el_address_address_zip">
<span<?= $Page->address_zip->viewAttributes() ?>>
<?= $Page->address_zip->getViewValue() ?></span>
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
    ew.addEventHandlers("address");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
