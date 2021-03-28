<?php
/**
 * <strong style="color:red;">在指定日期将网站变成黑白来缅怀逝去的生命。</strong>
 * @package <strong style="color:red;">ZGrey</strong>
 * @author <strong style="color:red;">ZhongZN,泽泽社长,WhiteFan</strong>
 * @version <strong style="color:red;">1.0.0</strong>
 * @link https://zn.ax/
 */
class ZGrey_Plugin implements Typecho_Plugin_Interface
{
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->header = array('ZGrey_Plugin', 'Do');
        Typecho_Plugin::factory('admin/footer.php')->end = array('ZGrey_Plugin', 'Do');
    }
    public static function deactivate(){}
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/ZhongZN/Static-Files@1.0.0/Settings.css"/>';
        $Day=new Typecho_Widget_Helper_Form_Element_Textarea('Day', NULL,
		'04-04
12-13', _t('设定日期'),_t('需要将网站设为灰白的日期，格式如04-04，一行一个'));
	    $form->addInput($Day);

    }
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    public static function Do()
    {
        $GreyDay=Typecho_Widget::widget('Widget_Options')->plugin('ZGrey')->Day;
	    if(strstr($GreyDay, date('m-d',time()))):?>
        <style>
        html
        {
            filter: grayscale(100%);
        	-webkit-filter: grayscale(100%);
        	-moz-filter: grayscale(100%);
        	-ms-filter: grayscale(100%);
        	-o-filter: grayscale(100%);
        	filter: url("data:image/svg+xml;
        	utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
        	filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);
        	-webkit-filter: grayscale(1);
        }
        </style>
        <?php endif;
    }
}