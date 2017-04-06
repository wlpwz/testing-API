<?php
class SController extends FController{
    protected $plat;
   
    public function filters()
    {
        return array_merge(parent::filters(), array(
           // 'checkpid - intro',
        ));
    }
 
    public function filterCheckpid(CFilterChain $filterChain)
    {
        //pid参数可以是get也可以是post
       /* $pid = Yii::app()->request->getParam('pid');

        $platObj = Platform::model()->findByPk($pid);   
        
        if($platObj){
            $this->plat = $platObj;
            $filterChain->run();
        }else{
            $this->forward("error/404");
        } */
        $filterChain->run();
    } 



}
