<?php

jquery_ui_load();

if($vars['value']){
    $d = date('d', $vars['value']);
    $m = date('n', $vars['value']);
    $a = date('Y', $vars['value']);
}

if (isset($vars['class'])) {
    $vars['class'] = "jquery_ui-date-select {$vars['class']}";
} else {
    $vars['class'] = "jquery_ui-date-select";
}

$defaults = array(
    'value' => '',
    'disabled' => false,
);

$vars = array_merge($defaults, $vars);

// convert timestamps to text for display
if (is_numeric($vars['value'])) {
    //$vars['value'] = gmdate('Y-m-d', $vars['value']);
}

//Dias
$dias = array();
$dias[] = 'Dia:';
for($i=1; $i<=31; $i++){
    $dias[] = $i;
}

//Mês
$meses = array();
$meses[] = 'Mês';
for($i=1; $i<=12; $i++){
    $meses[$i] = date("F",mktime(0,0,0,$i,1,2011));
}

//Ano
$anos = array();
$anos[] = 'Ano:';
for($i=date('Y'); $i>=date('Y')-110; $i--){
    $anos[] = $i;
}
?>

<style type="text/css">
    ul.date-list
    {
        list-style:none;
    }
    ul.date-list li
    {
        display: inline;
    }
    select.<?php echo $vars['class'];?>-dia{
        width: 60px !important;
    }
    select.<?php echo $vars['class'];?>-mes{
        width: 80px !important;
    }
    select.<?php echo $vars['class'];?>-ano{
        width: 80px !important;
    }
    .form-horizontal .control-label{
        width: 100px;
    }
    .form-horizontal .controls {
        margin-left: 120px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('.date-list select').change(function(){
            var campo_data = $('input[name=<?php echo $vars['name'];?>]');
            var dia = $('select[name=<?php echo $vars['name'];?>-dia] option:selected').val();
            var mes = $('select[name=<?php echo $vars['name'];?>-mes] option:selected').val();
            var ano = $('select[name=<?php echo $vars['name'];?>-ano] option:selected').val();

            if(dia != 'Dia:' && mes != 'Mês' && ano != 'Ano:'){
                campo_data.val(dia + '/' + mes + '/' + ano);
            }
        });
    });
</script>
<?php

$select_dias = elgg_view('input/dropdown', array('name' => "{$vars['name']}-dia", 'class' => "{$vars['class']}-dia", 'options' => $dias, 'value' => $d));
$select_meses = elgg_view('input/dropdown', array('name' => "{$vars['name']}-mes", 'class' => "{$vars['class']}-mes", 'options_values' => $meses, 'value' => $m));
$select_anos =  elgg_view('input/dropdown', array('name' => "{$vars['name']}-ano", 'class' => "{$vars['class']}-ano", 'options' => $anos, 'value' => $a));

echo "<ul class='date-list'>";
echo "<li>$select_dias</li>";
echo "<li>$select_meses</li>";
echo "<li>$select_anos</li>";
echo "</ul>";
echo "<input type='hidden' name='{$vars['name']}'>";

?>