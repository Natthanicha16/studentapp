<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$StudentsAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { students: currentTable } });
var currentForm, currentPageID;
var fstudentsadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fstudentsadd = new ew.Form("fstudentsadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fstudentsadd;

    // Add fields
    var fields = currentTable.fields;
    fstudentsadd.addFields([
        ["student_images", [fields.student_images.visible && fields.student_images.required ? ew.Validators.fileRequired(fields.student_images.caption) : null], fields.student_images.isInvalid],
        ["student_code", [fields.student_code.visible && fields.student_code.required ? ew.Validators.required(fields.student_code.caption) : null], fields.student_code.isInvalid],
        ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
        ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["age", [fields.age.visible && fields.age.required ? ew.Validators.required(fields.age.caption) : null, ew.Validators.integer], fields.age.isInvalid],
        ["hobby", [fields.hobby.visible && fields.hobby.required ? ew.Validators.required(fields.hobby.caption) : null], fields.hobby.isInvalid]
    ]);

    // Form_CustomValidate
    fstudentsadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fstudentsadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fstudentsadd.lists.hobby = <?= $Page->hobby->toClientList($Page) ?>;
    loadjs.done("fstudentsadd");
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
<form name="fstudentsadd" id="fstudentsadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="students">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->student_images->Visible) { // student_images ?>
    <div id="r_student_images"<?= $Page->student_images->rowAttributes() ?>>
        <label id="elh_students_student_images" class="<?= $Page->LeftColumnClass ?>"><?= $Page->student_images->caption() ?><?= $Page->student_images->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->student_images->cellAttributes() ?>>
<span id="el_students_student_images">
<div id="fd_x_student_images" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->student_images->title() ?>" data-table="students" data-field="x_student_images" name="x_student_images" id="x_student_images" lang="<?= CurrentLanguageID() ?>"<?= $Page->student_images->editAttributes() ?> aria-describedby="x_student_images_help"<?= ($Page->student_images->ReadOnly || $Page->student_images->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->student_images->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->student_images->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_student_images" id= "fn_x_student_images" value="<?= $Page->student_images->Upload->FileName ?>">
<input type="hidden" name="fa_x_student_images" id= "fa_x_student_images" value="0">
<input type="hidden" name="fs_x_student_images" id= "fs_x_student_images" value="255">
<input type="hidden" name="fx_x_student_images" id= "fx_x_student_images" value="<?= $Page->student_images->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_student_images" id= "fm_x_student_images" value="<?= $Page->student_images->UploadMaxFileSize ?>">
<table id="ft_x_student_images" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->student_code->Visible) { // student_code ?>
    <div id="r_student_code"<?= $Page->student_code->rowAttributes() ?>>
        <label id="elh_students_student_code" for="x_student_code" class="<?= $Page->LeftColumnClass ?>"><?= $Page->student_code->caption() ?><?= $Page->student_code->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->student_code->cellAttributes() ?>>
<span id="el_students_student_code">
<input type="<?= $Page->student_code->getInputTextType() ?>" name="x_student_code" id="x_student_code" data-table="students" data-field="x_student_code" value="<?= $Page->student_code->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->student_code->getPlaceHolder()) ?>"<?= $Page->student_code->editAttributes() ?> aria-describedby="x_student_code_help">
<?= $Page->student_code->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->student_code->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name"<?= $Page->name->rowAttributes() ?>>
        <label id="elh_students_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->name->cellAttributes() ?>>
<span id="el_students_name">
<input type="<?= $Page->name->getInputTextType() ?>" name="x_name" id="x_name" data-table="students" data-field="x_name" value="<?= $Page->name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_students__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_students__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="students" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->age->Visible) { // age ?>
    <div id="r_age"<?= $Page->age->rowAttributes() ?>>
        <label id="elh_students_age" for="x_age" class="<?= $Page->LeftColumnClass ?>"><?= $Page->age->caption() ?><?= $Page->age->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->age->cellAttributes() ?>>
<span id="el_students_age">
<input type="<?= $Page->age->getInputTextType() ?>" name="x_age" id="x_age" data-table="students" data-field="x_age" value="<?= $Page->age->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->age->getPlaceHolder()) ?>"<?= $Page->age->editAttributes() ?> aria-describedby="x_age_help">
<?= $Page->age->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->age->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hobby->Visible) { // hobby ?>
    <div id="r_hobby"<?= $Page->hobby->rowAttributes() ?>>
        <label id="elh_students_hobby" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hobby->caption() ?><?= $Page->hobby->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->hobby->cellAttributes() ?>>
<span id="el_students_hobby">
    <select
        id="x_hobby"
        name="x_hobby"
        class="form-control ew-select<?= $Page->hobby->isInvalidClass() ?>"
        data-select2-id="fstudentsadd_x_hobby"
        data-table="students"
        data-field="x_hobby"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->hobby->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->hobby->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->hobby->getPlaceHolder()) ?>"
        <?= $Page->hobby->editAttributes() ?>>
        <?= $Page->hobby->selectOptionListHtml("x_hobby") ?>
    </select>
    <?= $Page->hobby->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->hobby->getErrorMessage() ?></div>
<?= $Page->hobby->Lookup->getParamTag($Page, "p_x_hobby") ?>
<script>
loadjs.ready("fstudentsadd", function() {
    var options = { name: "x_hobby", selectId: "fstudentsadd_x_hobby" };
    if (fstudentsadd.lists.hobby.lookupOptions.length) {
        options.data = { id: "x_hobby", form: "fstudentsadd" };
    } else {
        options.ajax = { id: "x_hobby", form: "fstudentsadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.students.fields.hobby.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<?php
    $Page->DetailPages->ValidKeys = explode(",", $Page->getCurrentDetailTable());
?>
<div class="ew-detail-pages"><!-- detail-pages -->
<div class="ew-nav<?= $Page->DetailPages->containerClasses() ?>" id="details_Page"><!-- tabs -->
    <ul class="<?= $Page->DetailPages->navClasses() ?>" role="tablist"><!-- .nav -->
<?php
    if (in_array("tbstudy", explode(",", $Page->getCurrentDetailTable())) && $tbstudy->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("tbstudy") ?><?= $Page->DetailPages->activeClasses("tbstudy") ?>" data-bs-target="#tab_tbstudy" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_tbstudy" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("tbstudy")) ?>"><?= $Language->tablePhrase("tbstudy", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("address", explode(",", $Page->getCurrentDetailTable())) && $address->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("address") ?><?= $Page->DetailPages->activeClasses("address") ?>" data-bs-target="#tab_address" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_address" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("address")) ?>"><?= $Language->tablePhrase("address", "TblCaption") ?></button></li>
<?php
    }
?>
<?php
    if (in_array("tb_ta", explode(",", $Page->getCurrentDetailTable())) && $tb_ta->DetailAdd) {
?>
        <li class="nav-item"><button class="<?= $Page->DetailPages->navLinkClasses("tb_ta") ?><?= $Page->DetailPages->activeClasses("tb_ta") ?>" data-bs-target="#tab_tb_ta" data-bs-toggle="tab" type="button" role="tab" aria-controls="tab_tb_ta" aria-selected="<?= JsonEncode($Page->DetailPages->isActive("tb_ta")) ?>"><?= $Language->tablePhrase("tb_ta", "TblCaption") ?></button></li>
<?php
    }
?>
    </ul><!-- /.nav -->
    <div class="<?= $Page->DetailPages->tabContentClasses() ?>"><!-- .tab-content -->
<?php
    if (in_array("tbstudy", explode(",", $Page->getCurrentDetailTable())) && $tbstudy->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("tbstudy") ?><?= $Page->DetailPages->activeClasses("tbstudy") ?>" id="tab_tbstudy" role="tabpanel"><!-- page* -->
<?php include_once "TbstudyGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("address", explode(",", $Page->getCurrentDetailTable())) && $address->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("address") ?><?= $Page->DetailPages->activeClasses("address") ?>" id="tab_address" role="tabpanel"><!-- page* -->
<?php include_once "AddressGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
<?php
    if (in_array("tb_ta", explode(",", $Page->getCurrentDetailTable())) && $tb_ta->DetailAdd) {
?>
        <div class="<?= $Page->DetailPages->tabPaneClasses("tb_ta") ?><?= $Page->DetailPages->activeClasses("tb_ta") ?>" id="tab_tb_ta" role="tabpanel"><!-- page* -->
<?php include_once "TbTaGrid.php" ?>
        </div><!-- /page* -->
<?php } ?>
    </div><!-- /.tab-content -->
</div><!-- /tabs -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("students");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
