<?php
class FController extends Controller{
    public function filterUser($filterChain){
        //用户是否登录
        if(!Yii::app()->user->isGuest){
            $filterChain->run();
        }else
            throw new CHttpException(403, 'not allowed');
    }

    public function filterAjaxOnly(CFilterChain $filterChain)
    {
        //ajax only其实不需要进行refer的检查，因为有跨域限制，为了防止安全组同学误判，加上refer检查
        $filter = CInlineFilter::create($this, 'checkRefer');
        $filterChain->insertAt($filterChain->filterIndex, $filter);
        parent::filterAjaxOnly($filterChain);
    }

    public function getValidatePlatform(){
        if (Yii::app()->user->isGuest) {
            return NULL;
        }
        
       
        return $plats;
    }


}
