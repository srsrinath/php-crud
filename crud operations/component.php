<?php
function inputElement($icon,$placeholder,$name,$value){
    $ele = "
    <div class=\"input-group mb-2\">
    <div class=\"input-group-prepand\">
        <div class=\"input-group-text bg-warning\">$icon</i></div>

</div>
<input type=\"text\" name='$name' value='$value' autocomplete=\"off\" class=\"form-control\" id=\"inlineFormInputGroup\" placeholder='$placeholder'>
</div>
";
echo $ele;
}

function buttonElement($btnid,$name,$styleclass,$text,$attr){
$btn="<button id='$btnid' name='$name''$attr' class='$styleclass'>$text</button>";
echo $btn;
}
?>