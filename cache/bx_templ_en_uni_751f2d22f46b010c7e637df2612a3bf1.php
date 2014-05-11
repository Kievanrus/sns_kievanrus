<div class="bx-def-bc-margin">
    <?=$a['content'];?>
    <script>
    function splashEnableEditor(oCheckbox) {
        var sEditorId = 'adm-bs-splash-editor';
        if ('undefined' == typeof(tinyMCE))
            return;
        if($(oCheckbox).is(':checked'))
        	tinyMCE.execCommand('mceAddControl', false, sEditorId);
        else
        	tinyMCE.execCommand('mceRemoveControl', false, sEditorId);
    }
    </script>
</div>
