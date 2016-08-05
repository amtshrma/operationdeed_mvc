<?php

App::uses('Sanitize','Utility');

class FrontsController extends AppController {
	
    public $uses = array();
    public $helpers = array('Html','Form','Session');
	//var $components = array('Common','Invoice','SendMail','UploadImage');
    
	/**
	* @Date: Jul 22, 2015
	* @Method : login 
	* Created By: Shalini Negi
	* @Purpose: for Before filter
	* @Param: none
	* @Return: none 
	**/
	
    function beforeFilter() {
		
		$allow = array();
		parent::beforeFilter();    
		$this->checkUserSession($allow);
    }
	
	/**
	* @Date: Jul 22, 2015
	* @Method : index
	* Created By: Shalini Negi
	* @Purpose: home page
	* @Param: none
	* @Return: none 
	**/
	
    function index() {
		
		$this->layout = "front";
    }
}