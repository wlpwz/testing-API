<?php
Yii::import('zii.widgets.CWidget');
class SitemapAddBtn extends CWidget{
    public $url;
    public $calcount;
    public function run(){
        $url=CHtml::normalizeUrl($this->url);
        echo "<a href=\"{$url}\" class='btn-add-sitemap' ";
        if(!$this->calcount['left'])
            echo "onclick=\"return showmessage('平台测试中，您最多可累计提交{$this->calcount['total']}个死链和sitemap文件。目前已达上限，如想继续提交，请删除部分历史文件');\" ";
        echo "hideFocus='true'><span>添加新数据</span></a>";
    }
}
