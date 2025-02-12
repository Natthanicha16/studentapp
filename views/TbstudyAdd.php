<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$TbstudyAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tbstudy: currentTable } });
var currentForm, currentPageID;
var ftbstudyadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftbstudyadd = new ew.Form("ftbstudyadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = ftbstudyadd;

    // Add fields
    var fields = currentTable.fields;
    ftbstudyadd.addFields([
        ["study_name", [fields.study_name.visible && fields.study_name.required ? ew.Validators.required(fields.study_name.caption) : null], fields.study_name.isInvalid],
        ["study_level", [fields.study_level.visible && fields.study_level.required ? ew.Validators.required(fields.study_level.caption) : null], fields.study_level.isInvalid],
        ["study_studentcode", [fields.study_studentcode.visible && fields.study_studentcode.required ? ew.Validators.required(fields.study_studentcode.caption) : null], fields.study_studentcode.isInvalid]
    ]);

    // Form_CustomValidate
    ftbstudyadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftbstudyadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ftbstudyadd");
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
<form name="ftbstudyadd" id="ftbstudyadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tbstudy">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "students") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="students">
<input type="hidden" name="fk_student_code" value="<?= HtmlEncode($Page->study_studentcode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->study_name->Visible) { // study_name ?>
    <div id="r_study_name"<?= $Page->study_name->rowAttributes() ?>>
        <label id="elh_tbstudy_study_name" for="x_study_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->study_name->caption() ?><?= $Page->study_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->study_name->cellAttributes() ?>>
<span id="el_tbstudy_study_name">
<input type="<?= $Page->study_name->getInputTextType() ?>" name="x_study_name" id="x_study_name" data-table="tbstudy" data-field="x_study_name" value="<?= $Page->study_name->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->study_name->getPlaceHolder()) ?>"<?= $Page->study_name->editAttributes() ?> aria-describedby="x_study_name_help">
<?= $Page->study_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->study_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->study_level->Visible) { // study_level ?>
    <div id="r_study_level"<?= $Page->study_level->rowAttributes() ?>>
        <label id="elh_tbstudy_study_level" for="x_study_level" class="<?= $Page->LeftColumnClass ?>"><?= $Page->study_level->caption() ?><?= $Page->study_level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->study_level->cellAttributes() ?>>
<span id="el_tbstudy_study_level">
<input type="<?= $Page->study_level->getInputTextType() ?>" name="x_study_level" id="x_study_level" data-table="tbstudy" data-field="x_study_level" value="<?= $Page->study_level->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->study_level->getPlaceHolder()) ?>"<?= $Page->study_level->editAttributes() ?> aria-describedby="x_study_level_help">
<?= $Page->study_level->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->study_level->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->study_studentcode->Visible) { // study_studentcode ?>
    <div id="r_study_studentcode"<?= $Page->study_studentcode->rowAttributes() ?>>
        <label id="elh_tbstudy_study_studentcode" for="x_study_studentcode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->study_studentcode->caption() ?><?= $Page->study_studentcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->study_studentcode->cellAttributes() ?>>
<?php if ($Page->study_studentcode->getSessionValue() != "") { ?>
<span id="el_tbstudy_study_studentcode">
<span<?= $Page->study_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->study_studentcode->getDisplayValue($Page->study_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_study_studentcode" name="x_study_studentcode" value="<?= HtmlEncode($Page->study_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_tbstudy_study_studentcode">
<input type="<?= $Page->study_studentcode->getInputTextType() ?>" name="x_study_studentcode" id="x_study_studentcode" data-table="tbstudy" data-field="x_study_studentcode" value="<?= $Page->study_studentcode->EditValue ?>" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->study_studentcode->getPlaceHolder()) ?>"<?= $Page->study_studentcode->editAttributes() ?> aria-describedby="x_study_studentcode_help">
<?= $Page->study_studentcode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->study_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
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
    ew.addEventHandlers("tbstudy");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
