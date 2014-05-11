<bx_if:include_js>
	
</bx_if:include_js>
<form id="modules-<?=$a['type'];?>-form" enctype="multipart/form-data" method="post" action="" class="form_advanced">
    <div class="modules-items bx-def-bc-margin">
        <?php if(is_array($a['bx_repeat:items'])) for($i=0; $i<count($a['bx_repeat:items']); $i++){ ?>
            <div class="modules-item">
                <input type="checkbox" class="form_input_checkbox" id="pathes-<?=$a['bx_repeat:items'][$i]['name'];?>" name="pathes[]" value="<?=$a['bx_repeat:items'][$i]['value'];?>" bx_can_update="<?=$a['bx_repeat:items'][$i]['can_update'];?>" />
                <label for="pathes-<?=$a['bx_repeat:items'][$i]['name'];?>"><?=$a['bx_repeat:items'][$i]['title'];?></label>
                <?=$a['bx_repeat:items'][$i]['update'];?>
            </div>
        <?php } else if(is_string($a['bx_repeat:items'])) echo $a['bx_repeat:items']; ?>
    </div>
    <?=$a['controls'];?>
</form>