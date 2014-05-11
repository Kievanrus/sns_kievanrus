
<div id="adm-cache-chart" class="bx-def-border"></div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>        
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(bx_cache_show_chart);

    function bx_cache_show_chart (e, customData) {
        $('#adm-cache-chart').html('');
        var oDataTable = new google.visualization.DataTable();
        oDataTable.addColumn('string', 'Cache');
        oDataTable.addColumn('number', 'Size');   
        var data = [
            <?=$a['chart_data'];?>
        ];
        if (undefined != customData)
            data = customData;
        oDataTable.addRows(data);
        chart = new google.visualization.PieChart($('#adm-cache-chart')[0]);
        chart.draw(oDataTable, {});
    }
</script>



<div id="adm-cache-clear" class="bx-def-font-large bx-def-margin-left">

    <b>Очистить кэш:</b> <br />
    <ul>
    <?php if(is_array($a['bx_repeat:clear_action'])) for($i=0; $i<count($a['bx_repeat:clear_action']); $i++){ ?>
        <li><a href="javascript:void(0)" onclick="javascript:clearCache('<?=$a['bx_repeat:clear_action'][$i]['action'];?>');"><?=$a['bx_repeat:clear_action'][$i]['title'];?></a></li>
    <?php } else if(is_string($a['bx_repeat:clear_action'])) echo $a['bx_repeat:clear_action']; ?>
    </ul>
</div>

<script language="javascript" type="text/javascript">
    function clearCache(sType){
        bx_loading('adm-cache-clear', true);
        $.post(
            'http://kievanrus.ru/administration/cache.php', 
            {
                clear_cache: sType
            }, 
            function(oData) {
                bx_loading('adm-cache-clear', false);
                if (undefined != oData['chart_data'])
                    bx_cache_show_chart(null, oData['chart_data']);
                alert(oData.message);
            },
            'json'
        );
    }
</script>



<div class="clear_both"></div>

