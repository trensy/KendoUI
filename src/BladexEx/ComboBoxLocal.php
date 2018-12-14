<?php
/**
 * User: Peter Wang
 * Date: 17/1/9
 * Time: 上午10:05
 */

namespace Trensy\KendoUI\BladexEx;


class ComboBoxLocal extends Base
{

    public function perform($param)
    {
        $str = $this->getPushStatic([
            '/static/lib/kendo-ui/styles/kendo.common.min.css',
            '/static/lib/kendo-ui/styles/kendo.silver.min.css',
            '/static/lib/kendo-ui/styles/kendo.default.mobile.min.css',
            '/static/lib/kendo-ui/js/jquery.min.js',
            '/static/lib/kendo-ui/js/kendo.core.min.js',
            '/static/lib/kendo-ui/js/kendo.data.min.js',
            '/static/lib/kendo-ui/js/kendo.popup.min.js',
            '/static/lib/kendo-ui/js/kendo.list.min.js',
            '/static/lib/kendo-ui/js/kendo.fx.min.js',
            '/static/lib/kendo-ui/js/kendo.userevents.min.js',
            '/static/lib/kendo-ui/js/kendo.draganddrop.min.js',
            '/static/lib/kendo-ui/js/kendo.mobile.scroller.min.js',
            '/static/lib/kendo-ui/js/kendo.virtuallist.min.js',
            '/static/lib/kendo-ui/js/kendo.combobox.min.js'
            ]);
        return $str.'<?php \Trensy\KendoUI\BladexEx\ComboBoxLocal::deal('.$param.'); ?>';
    }


    public static function deal($data, $name='cb',$options=[])
    {
        $tmpData = [];
        //如果是一维度数组
        if (isset($data[0])){
            $tmpData = $data;
        }else{
            foreach ($data as $k=>$v){
                $tmp = [];
                $tmp['text'] = $k;
                $tmp['value'] = $v;
                $tmpData[] = $tmp;
            }
        }

        $dataSource = new \Kendo\Data\DataSource();
        $dataSource->data($tmpData);

        $ui = new \Kendo\UI\ComboBox($name);
        $ui->dataSource($dataSource);

        if (!isset($data[0])){
            $ui->dataTextField('text');
            $ui->dataValueField('value');
        }
        $ui->suggest(true);

        if($options){
            foreach ($options as $k=>$v){
                $ui->$k($v);
            }
        }
        echo $ui->render();
    }

}