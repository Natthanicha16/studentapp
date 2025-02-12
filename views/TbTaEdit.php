<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$TbTaEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { tb_ta: currentTable } });
var currentForm, currentPageID;
var ftb_taedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftb_taedit = new ew.Form("ftb_taedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = ftb_taedit;

    // Add fields
    var fields = currentTable.fields;
    ftb_taedit.addFields([
        ["ta_id", [fields.ta_id.visible && fields.ta_id.required ? ew.Validators.required(fields.ta_id.caption) : null], fields.ta_id.isInvalid],
        ["taprefic_name", [fields.taprefic_name.visible && fields.taprefic_name.required ? ew.Validators.required(fields.taprefic_name.caption) : null, ew.Validators.integer], fields.taprefic_name.isInvalid],
        ["ta_name", [fields.ta_name.visible && fields.ta_name.required ? ew.Validators.required(fields.ta_name.caption) : null], fields.ta_name.isInvalid],
        ["ta_surname", [fields.ta_surname.visible && fields.ta_surname.required ? ew.Validators.required(fields.ta_surname.caption) : null], fields.ta_surname.isInvalid],
        ["ta_studentcode", [fields.ta_studentcode.visible && fields.ta_studentcode.required ? ew.Validators.required(fields.ta_studentcode.caption) : null], fields.ta_studentcode.isInvalid]
    ]);

    // Form_CustomValidate
    ftb_taedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftb_taedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ftb_taedit");
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
<?php if (!$Page->IsModal) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<form name="ftb_taedit" id="ftb_taedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="tb_ta">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "students") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="students">
<input type="hidden" name="fk_student_code" value="<?= HtmlEncode($Page->ta_studentcode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->ta_id->Visible) { // ta_id ?>
    <div id="r_ta_id"<?= $Page->ta_id->rowAttributes() ?>>
        <label id="elh_tb_ta_ta_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ta_id->caption() ?><?= $Page->ta_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ta_id->cellAttributes() ?>>
<span id="el_tb_ta_ta_id">
<span<?= $Page->ta_id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ta_id->getDisplayValue($Page->ta_id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="tb_ta" data-field="x_ta_id" data-hidden="1" name="x_ta_id" id="x_ta_id" value="<?= HtmlEncode($Page->ta_id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->taprefic_name->Visible) { // taprefic_name ?>
    <div id="r_taprefic_name"<?= $Page->taprefic_name->rowAttributes() ?>>
        <label id="elh_tb_ta_taprefic_name" for="x_taprefic_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->taprefic_name->caption() ?><?= $Page->taprefic_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->taprefic_name->cellAttributes() ?>>
<span id="el_tb_ta_taprefic_name">
<input type="<?= $Page->taprefic_name->getInputTextType() ?>" name="x_taprefic_name" id="x_taprefic_name" data-table="tb_ta" data-field="x_taprefic_name" value="<?= $Page->taprefic_name->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->taprefic_name->getPlaceHolder()) ?>"<?= $Page->taprefic_name->editAttributes() ?> aria-describedby="x_taprefic_name_help">
<?= $Page->taprefic_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->taprefic_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ta_name->Visible) { // ta_name ?>
    <div id="r_ta_name"<?= $Page->ta_name->rowAttributes() ?>>
        <label id="elh_tb_ta_ta_name" for="x_ta_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ta_name->caption() ?><?= $Page->ta_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ta_name->cellAttributes() ?>>
<span id="el_tb_ta_ta_name">
<input type="<?= $Page->ta_name->getInputTextType() ?>" name="x_ta_name" id="x_ta_name" data-table="tb_ta" data-field="x_ta_name" value="<?= $Page->ta_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->ta_name->getPlaceHolder()) ?>"<?= $Page->ta_name->editAttributes() ?> aria-describedby="x_ta_name_help">
<?= $Page->ta_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ta_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ta_surname->Visible) { // ta_surname ?>
    <div id="r_ta_surname"<?= $Page->ta_surname->rowAttributes() ?>>
        <label id="elh_tb_ta_ta_surname" for="x_ta_surname" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ta_surname->caption() ?><?= $Page->ta_surname->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ta_surname->cellAttributes() ?>>
<span id="el_tb_ta_ta_surname">
<input type="<?= $Page->ta_surname->getInputTextType() ?>" name="x_ta_surname" id="x_ta_surname" data-table="tb_ta" data-field="x_ta_surname" value="<?= $Page->ta_surname->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->ta_surname->getPlaceHolder()) ?>"<?= $Page->ta_surname->editAttributes() ?> aria-describedby="x_ta_surname_help">
<?= $Page->ta_surname->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ta_surname->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ta_studentcode->Visible) { // ta_studentcode ?>
    <div id="r_ta_studentcode"<?= $Page->ta_studentcode->rowAttributes() ?>>
        <label id="elh_tb_ta_ta_studentcode" for="x_ta_studentcode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ta_studentcode->caption() ?><?= $Page->ta_studentcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ta_studentcode->cellAttributes() ?>>
<?php if ($Page->ta_studentcode->getSessionValue() != "") { ?>
<span id="el_tb_ta_ta_studentcode">
<span<?= $Page->ta_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->ta_studentcode->getDisplayValue($Page->ta_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_ta_studentcode" name="x_ta_studentcode" value="<?= HtmlEncode($Page->ta_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_tb_ta_ta_studentcode">
<input type="<?= $Page->ta_studentcode->getInputTextType() ?>" name="x_ta_studentcode" id="x_ta_studentcode" data-table="tb_ta" data-field="x_ta_studentcode" value="<?= $Page->ta_studentcode->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->ta_studentcode->getPlaceHolder()) ?>"<?= $Page->ta_studentcode->editAttributes() ?> aria-describedby="x_ta_studentcode_help">
<?= $Page->ta_studentcode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ta_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
<?php if (!$Page->IsModal) { ?>
<?= $Page->Pager->render() ?>
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
