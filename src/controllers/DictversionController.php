<?php

class DictversionController extends Controller
{
	public function actionPage_weight_zwversion()
	{
    	$data = array();
    	$result = PageweightzwVersion::model()->findAll();
    	$data['result'] = $result;
    	$this->renderPartial('page_weight_zwversion',$data);
    }
	public function actionBlacklist2_url_zwversion()
    {
        $data = array();
        $result = Blacklist2urlzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('blacklist2_url_zwversion',$data);
    }
	public function actionTranslate_zwversion()
	{
		$data = array();
		$result = TranslatezwVersion::model()->findAll();
		$data['result'] = $result;
		$this->renderPartial('translate_zwversion',$data);
	}
    
	public function actionSpamming_site_zwversion()
	{
		$data = array();
		$result = Spamming_sitezwVersion::model()->findAll();
		$data['result'] = $result;
		$this->renderPartial('spamming_site_zwversion',$data);
	}
	public function actionVip_url_zwversion()
    {
        $data = array();
        $result = Vip_urlzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('vip_url_zwversion',$data);
    }	
	public function actionPage_extract_zwversion()
    {
        $data = array();
        $result = Page_extractzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('page_extract_zwversion',$data);
    }
	public function actionPcre_zwversion()
    {
        $data = array();
        $result = PcrezwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('pcre_zwversion',$data);
    }
	public function actionModel_func_zwversion()
    {
        $data = array();
        $result = Model_funczwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('model_func_zwversion',$data);
    }
    public function actionPage_weight_hkversion()
    {
        $data = array();
        $result = PageweighthkVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('page_weight_hkversion',$data);
    }
	public function actionQuestionable_site_zwversion()
    {
        $data = array();
        $result = Questionable_sitezwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('questionable_site_zwversion',$data);
    }
	
	public function actionNew_spamming_zwversion()
    {
        $data = array();
        $result = New_spammingzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('new_spamming_zwversion',$data);
    }

	public function actionPattern_zwversion()
    {
        $data = array();
        $result = PatternzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('pattern_zwversion',$data);
    }

	public function actionMini_wdn_filter_zwversion()
    {
        $data = array();
        $result = Mini_wdn_filterzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('mini_wdn_filter_zwversion',$data);
    }
	public function actionInnocent_url_zwversion()
    {
        $data = array();
        $result = Innocent_urlzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('innocent_url_zwversion',$data);
    }
	public function actionImage_whitelist_zwversion()
    {
        $data = array();
        $result = Image_whitelistzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('image_whitelist_zwversion',$data);
    }
	public function actionGlobal_whitelist_zwversion()
    {
        $data = array();
        $result = Global_whitelistzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('global_whitelist_zwversion',$data);
    }
	public function actionFollow_link_zwversion()
    {
        $data = array();
        $result = Follow_linkzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('follow_link_zwversion',$data);
    }
	public function actionFollow_limit_zwversion()
    {
        $data = array();
        $result = Follow_limitzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('follow_limit_zwversion',$data);
    }
	public function actionFollow_limit_create_zwversion()
    {
        $data = array();
        $result = Follow_limit_createzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('follow_limit_create_zwversion',$data);
    }
	public function actionEc_modify_zwversion()
    {
        $data = array();
        $result = Ec_modifyzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('ec_modify_zwversion',$data);
    }
	public function actionDup_param_zwversion()
    {
        $data = array();
        $result = Dup_paramzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('dup_param_zwversion',$data);
    }
	public function actionBlacklist_url_zwversion()
    {
        $data = array();
        $result = Blacklist_urlzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('blacklist_url_zwversion',$data);
    }
	public function actionAttr_modify_zwversion()
    {
        $data = array();
        $result = Attr_modifyzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('attr_modify_zwversion',$data);
    }



	public function actionAnchor_text_zwversion()
    {
        $data = array();
        $result = Anchor_textzwVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('anchor_text_zwversion',$data);
    }
	public function actionAliasversion()
    {
        $data = array();
        $result = AliaVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('alias_zwversion',$data);
    }
	public function actionRedirversion()
    {
        $data = array();
        $result = RedirVersion::model()->findAll();
        $data['result'] = $result;
        $this->renderPartial('redir_zwversion',$data);
    }

}

?>
