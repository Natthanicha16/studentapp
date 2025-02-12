<?php

namespace PHPMaker2022\STUDENTT;

// Page object
$AddressAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { address: currentTable } });
var currentForm, currentPageID;
var faddressadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    faddressadd = new ew.Form("faddressadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = faddressadd;

    // Add fields
    var fields = currentTable.fields;
    faddressadd.addFields([
        ["address_studentcode", [fields.address_studentcode.visible && fields.address_studentcode.required ? ew.Validators.required(fields.address_studentcode.caption) : null], fields.address_studentcode.isInvalid],
        ["address_moo", [fields.address_moo.visible && fields.address_moo.required ? ew.Validators.required(fields.address_moo.caption) : null], fields.address_moo.isInvalid],
        ["address_name", [fields.address_name.visible && fields.address_name.required ? ew.Validators.required(fields.address_name.caption) : null], fields.address_name.isInvalid],
        ["address_sub", [fields.address_sub.visible && fields.address_sub.required ? ew.Validators.required(fields.address_sub.caption) : null], fields.address_sub.isInvalid],
        ["address_district", [fields.address_district.visible && fields.address_district.required ? ew.Validators.required(fields.address_district.caption) : null], fields.address_district.isInvalid],
        ["address_province", [fields.address_province.visible && fields.address_province.required ? ew.Validators.required(fields.address_province.caption) : null], fields.address_province.isInvalid],
        ["address_zip", [fields.address_zip.visible && fields.address_zip.required ? ew.Validators.required(fields.address_zip.caption) : null], fields.address_zip.isInvalid]
    ]);

    // Form_CustomValidate
    faddressadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    faddressadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("faddressadd");
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
<form name="faddressadd" id="faddressadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="address">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "students") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="students">
<input type="hidden" name="fk_student_code" value="<?= HtmlEncode($Page->address_studentcode->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->address_studentcode->Visible) { // address_studentcode ?>
    <div id="r_address_studentcode"<?= $Page->address_studentcode->rowAttributes() ?>>
        <label id="elh_address_address_studentcode" for="x_address_studentcode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address_studentcode->caption() ?><?= $Page->address_studentcode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address_studentcode->cellAttributes() ?>>
<?php if ($Page->address_studentcode->getSessionValue() != "") { ?>
<span id="el_address_address_studentcode">
<span<?= $Page->address_studentcode->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->address_studentcode->getDisplayValue($Page->address_studentcode->ViewValue))) ?>"></span>
</span>
<input type="hidden" id="x_address_studentcode" name="x_address_studentcode" value="<?= HtmlEncode($Page->address_studentcode->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_address_address_studentcode">
<input type="<?= $Page->address_studentcode->getInputTextType() ?>" name="x_address_studentcode" id="x_address_studentcode" data-table="address" data-field="x_address_studentcode" value="<?= $Page->address_studentcode->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->address_studentcode->getPlaceHolder()) ?>"<?= $Page->address_studentcode->editAttributes() ?> aria-describedby="x_address_studentcode_help">
<?= $Page->address_studentcode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address_studentcode->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address_moo->Visible) { // address_moo ?>
    <div id="r_address_moo"<?= $Page->address_moo->rowAttributes() ?>>
        <label id="elh_address_address_moo" for="x_address_moo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address_moo->caption() ?><?= $Page->address_moo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address_moo->cellAttributes() ?>>
<span id="el_address_address_moo">
<input type="<?= $Page->address_moo->getInputTextType() ?>" name="x_address_moo" id="x_address_moo" data-table="address" data-field="x_address_moo" value="<?= $Page->address_moo->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->address_moo->getPlaceHolder()) ?>"<?= $Page->address_moo->editAttributes() ?> aria-describedby="x_address_moo_help">
<?= $Page->address_moo->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address_moo->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address_name->Visible) { // address_name ?>
    <div id="r_address_name"<?= $Page->address_name->rowAttributes() ?>>
        <label id="elh_address_address_name" for="x_address_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address_name->caption() ?><?= $Page->address_name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address_name->cellAttributes() ?>>
<span id="el_address_address_name">
<input type="<?= $Page->address_name->getInputTextType() ?>" name="x_address_name" id="x_address_name" data-table="address" data-field="x_address_name" value="<?= $Page->address_name->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->address_name->getPlaceHolder()) ?>"<?= $Page->address_name->editAttributes() ?> aria-describedby="x_address_name_help">
<?= $Page->address_name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address_name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address_sub->Visible) { // address_sub ?>
    <div id="r_address_sub"<?= $Page->address_sub->rowAttributes() ?>>
        <label id="elh_address_address_sub" for="x_address_sub" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address_sub->caption() ?><?= $Page->address_sub->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address_sub->cellAttributes() ?>>
<span id="el_address_address_sub">
<input type="<?= $Page->address_sub->getInputTextType() ?>" name="x_address_sub" id="x_address_sub" data-table="address" data-field="x_address_sub" value="<?= $Page->address_sub->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->address_sub->getPlaceHolder()) ?>"<?= $Page->address_sub->editAttributes() ?> aria-describedby="x_address_sub_help">
<?= $Page->address_sub->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address_sub->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address_district->Visible) { // address_district ?>
    <div id="r_address_district"<?= $Page->address_district->rowAttributes() ?>>
        <label id="elh_address_address_district" for="x_address_district" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address_district->caption() ?><?= $Page->address_district->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address_district->cellAttributes() ?>>
<span id="el_address_address_district">
<input type="<?= $Page->address_district->getInputTextType() ?>" name="x_address_district" id="x_address_district" data-table="address" data-field="x_address_district" value="<?= $Page->address_district->EditValue ?>" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->address_district->getPlaceHolder()) ?>"<?= $Page->address_district->editAttributes() ?> aria-describedby="x_address_district_help">
<?= $Page->address_district->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address_district->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address_province->Visible) { // address_province ?>
    <div id="r_address_province"<?= $Page->address_province->rowAttributes() ?>>
        <label id="elh_address_address_province" for="x_address_province" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address_province->caption() ?><?= $Page->address_province->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address_province->cellAttributes() ?>>
<span id="el_address_address_province">
<input type="<?= $Page->address_province->getInputTextType() ?>" name="x_address_province" id="x_address_province" data-table="address" data-field="x_address_province" value="<?= $Page->address_province->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->address_province->getPlaceHolder()) ?>"<?= $Page->address_province->editAttributes() ?> aria-describedby="x_address_province_help">
<?= $Page->address_province->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address_province->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->address_zip->Visible) { // address_zip ?>
    <div id="r_address_zip"<?= $Page->address_zip->rowAttributes() ?>>
        <label id="elh_address_address_zip" for="x_address_zip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->address_zip->caption() ?><?= $Page->address_zip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->address_zip->cellAttributes() ?>>
<span id="el_address_address_zip">
<input type="<?= $Page->address_zip->getInputTextType() ?>" name="x_address_zip" id="x_address_zip" data-table="address" data-field="x_address_zip" value="<?= $Page->address_zip->EditValue ?>" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->address_zip->getPlaceHolder()) ?>"<?= $Page->address_zip->editAttributes() ?> aria-describedby="x_address_zip_help">
<?= $Page->address_zip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->address_zip->getErrorMessage() ?></div>
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
    ew.addEventHandlers("address");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
