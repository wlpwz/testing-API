<?php
Yii::import('zii.widgets.CMenu');
class SMenu extends CMenu{
    protected function isItemActive($item,$route)
	{
        if (isset($item['activeby']) && $item['activeby']=='url'){
            return parent::isItemActive($item, $route);
        } else {
            $itemurl=is_array($item['url'])? $item['url'][0]: $item['url'];
            $itemurl=substr($itemurl, 0, strrpos($itemurl, '/'));
            if($itemurl && strpos($route, $itemurl.'/')===0){
                return true;
            } else {
                return false;
            }
        }
	}
    protected function renderMenuItem($item)
    {
        if(isset($item['url']))
        {
            $label=$this->linkLabelWrapper===null ? $item['label'] : '<'.$this->linkLabelWrapper.'>'.$item['label'].'</'.$this->linkLabelWrapper.'>';
            if (isset($_GET['site']) && is_array($item['url']) && (!isset($item['nosite']) || $item['nosite']==false)){
                $item['url']['site'] = $_GET['site'];
            }
            if (isset($item['tag'])){
                $tag = CHtml::tag('span',array('class'=>$item['tag']),"");
            } else {
                $tag = '';
            }
            $return = CHtml::link($label.$tag, $item['url'],isset($item['linkOptions']) ? $item['linkOptions'] : array());
        }
        else {
            $attrs = array_merge($attrs,array('data-checked'=>'true','class'=>''));
            $labTemp = CHtml::tag('span',$attrs,$item['label']);
            $return = CHtml::tag('div',array('data-checked'=>'true','class'=>'nav-box'),$labTemp);
           // $attrs = isset($item['linkOptions']) ? $item['linkOptions'] : array();
           // $attrs = array_merge($attrs,array('data-checked'=>'true','class'=>''));
           // $return .= CHtml::tag('span',$attrs, $item['label']);
        }
        return $return;
    }

    /**
     * 扩展父类的 run 方法，删除空的一级菜单。
     */
    public function run()
    {
        foreach ($this->items as $key => $val) {
            if (isset($val['submenuOptions']) && empty($val['items'])) {
                unset($this->items[$key]);
            }
        }
        parent::run();
    }
}
