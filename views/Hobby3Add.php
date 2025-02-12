<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$Hobby3Add = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { hobby3: currentTable } });
var currentForm, currentPageID;
var fhobby3add;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fhobby3add = new ew.Form("fhobby3add", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fhobby3add;

    // Add fields
    var fields = currentTable.fields;
    fhobby3add.addFields([
        ["namehobby", [fields.namehobby.visible && fields.namehobby.required ? ew.Validators.required(fields.namehobby.caption) : null], fields.namehobby.isInvalid]
    ]);

    // Form_CustomValidate
    fhobby3add.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fhobby3add.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fhobby3add");
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
<form name="fhobby3add" id="fhobby3add" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="hobby3">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->namehobby->Visible) { // namehobby ?>
    <div id="r_namehobby"<?= $Page->namehobby->rowAttributes() ?>>
        <label id="elh_hobby3_namehobby" for="x_namehobby" class="<?= $Page->LeftColumnClass ?>"><?= $Page->namehobby->caption() ?><?= $Page->namehobby->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->namehobby->cellAttributes() ?>>
<span id="el_hobby3_namehobby">
<input type="<?= $Page->namehobby->getInputTextType() ?>" name="x_namehobby" id="x_namehobby" data-table="hobby3" data-field="x_namehobby" value="<?= $Page->namehobby->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->namehobby->getPlaceHolder()) ?>"<?= $Page->namehobby->editAttributes() ?> aria-describedby="x_namehobby_help">
<?= $Page->namehobby->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->namehobby->getErrorMessage() ?></div>
</span>
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
    ew.addEventHandlers("hobby3");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
