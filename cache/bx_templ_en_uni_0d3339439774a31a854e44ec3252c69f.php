<div id="adm-langs-cnt-langs" style="display:<?=$a['display'];?>;">
    <form id="adm-langs-form" enctype="multipart/form-data" method="post" action="" class="form_advanced">
        <div class="adm-lang-items bx-def-bc-margin">
            <?=$a['results'];?>
            <?php if(is_array($a['bx_repeat:items'])) for($i=0; $i<count($a['bx_repeat:items']); $i++){ ?>
                <div class="adm-lang-item bx-def-margin-thd-top-auto">
                    <input type="checkbox" class="form_input_checkbox" id="adm-lang-<?=$a['bx_repeat:items'][$i]['name'];?>" name="langs[]" value="<?=$a['bx_repeat:items'][$i]['value'];?>" />
                    <img src="<?=$a['bx_repeat:items'][$i]['icon'];?>" />
                    <label for="adm-lang-<?=$a['bx_repeat:items'][$i]['name'];?>"><?=$a['bx_repeat:items'][$i]['title'];?></label>
                    <?=$a['bx_repeat:items'][$i]['default'];?>
                    <a href="javascript:void(0)" onclick="javascript:onEditLanguage(<?=$a['bx_repeat:items'][$i]['value'];?>);">Edit</a>&nbsp;
                    <a href="<?=$a['bx_repeat:items'][$i]['export_link'];?>" target="_blank">Export</a>
                </div>
            <?php } else if(is_string($a['bx_repeat:items'])) echo $a['bx_repeat:items']; ?>
        </div>
        <?=$a['controls'];?>
    </form>
</div>