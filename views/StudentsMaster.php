<?php

namespace PHPMaker2022\STUDENTT;

// Table
$students = Container("students");
?>
<?php if ($students->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_studentsmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($students->student_images->Visible) { // student_images ?>
        <tr id="r_student_images"<?= $students->student_images->rowAttributes() ?>>
            <td class="<?= $students->TableLeftColumnClass ?>"><?= $students->student_images->caption() ?></td>
            <td<?= $students->student_images->cellAttributes() ?>>
<span id="el_students_student_images">
<span>
<?= GetFileViewTag($students->student_images, $students->student_images->getViewValue(), false) ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($students->student_code->Visible) { // student_code ?>
        <tr id="r_student_code"<?= $students->student_code->rowAttributes() ?>>
            <td class="<?= $students->TableLeftColumnClass ?>"><?= $students->student_code->caption() ?></td>
            <td<?= $students->student_code->cellAttributes() ?>>
<span id="el_students_student_code">
<span<?= $students->student_code->viewAttributes() ?>>
<?= $students->student_code->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($students->name->Visible) { // name ?>
        <tr id="r_name"<?= $students->name->rowAttributes() ?>>
            <td class="<?= $students->TableLeftColumnClass ?>"><?= $students->name->caption() ?></td>
            <td<?= $students->name->cellAttributes() ?>>
<span id="el_students_name">
<span<?= $students->name->viewAttributes() ?>>
<?= $students->name->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($students->_email->Visible) { // email ?>
        <tr id="r__email"<?= $students->_email->rowAttributes() ?>>
            <td class="<?= $students->TableLeftColumnClass ?>"><?= $students->_email->caption() ?></td>
            <td<?= $students->_email->cellAttributes() ?>>
<span id="el_students__email">
<span<?= $students->_email->viewAttributes() ?>>
<?= $students->_email->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($students->age->Visible) { // age ?>
        <tr id="r_age"<?= $students->age->rowAttributes() ?>>
            <td class="<?= $students->TableLeftColumnClass ?>"><?= $students->age->caption() ?></td>
            <td<?= $students->age->cellAttributes() ?>>
<span id="el_students_age">
<span<?= $students->age->viewAttributes() ?>>
<?= $students->age->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($students->hobby->Visible) { // hobby ?>
        <tr id="r_hobby"<?= $students->hobby->rowAttributes() ?>>
            <td class="<?= $students->TableLeftColumnClass ?>"><?= $students->hobby->caption() ?></td>
            <td<?= $students->hobby->cellAttributes() ?>>
<span id="el_students_hobby">
<span<?= $students->hobby->viewAttributes() ?>>
<?= $students->hobby->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
