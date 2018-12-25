<?php
spl_autoload_register(function ($class_name) {
    require_once  $class_name . '.php';
});

class My_Routes extends Wrapper{
	public function __construct(){
		//<------------ User route -------------->
		$this->register_route( 'register', array(
            'method'   => 'post',
            'callback' => array( new User(), 'register' )
        ));

		$this->register_route( 'login', array(
            'method'   => 'post',
            'callback' => array( new User(), 'login' )
        ));

        $this->register_route( 'forgot', array(
            'method'   => 'post',
            'callback' => array( new User(), 'forgot' )
        ));

        $this->register_route( 'resendToken', array(
            'method'   => 'post',
            'callback' => array( new User(), 'forgot' )
        ));

        $this->register_route( 'recover', array(
            'method'   => 'post',
            'callback' => array( new User(), 'recover' )
        ));

		//<------------ Category route -------------->
		$this->register_route( 'category', array(
	  		'method' => 'get',
	  		'callback' => array( new Category(), 'getCategory' )
		));

		$this->register_route( 'category/:id', array(
	  		'method' => 'get',
	  		'callback' => array( new Category(), 'getCategoryById' )
		));

		$this->register_route( 'category/:id', array(
	  		'method' => 'post',
	  		'callback' => array( new Category(), 'addCategory' )
		));

		$this->register_route( 'category/:id', array(
	  		'method' => 'put',
	  		'callback' => array( new Category(), 'editCategory' )
		));

		$this->register_route( 'categoryData/:id', array(
	  		'method' => 'get',
	  		'callback' => array( new Category(), 'editCategoryData' )
		));

		$this->register_route( 'category/:id', array(
	  		'method' => 'delete',
	  		'callback' => array( new Category(), 'deleteCategory' )
		));

		//<------------ Data route -------------->
		$this->register_route( 'data', array(
	  		'method' => 'get',
	  		'callback' => array( new Data(), 'getData' )
		));

		$this->register_route( 'data/:id', array(
	  		'method' => 'get',
	  		'callback' => array( new Data(), 'getDataById' )
		));	

		$this->register_route( 'data/:id', array(
	  		'method' => 'post',
	  		'callback' => array( new Data(), 'addData' )
		));

		$this->register_route( 'data/:id', array(
	  		'method' => 'delete',
	  		'callback' => array( new Data(), 'deleteData' )
		));	

		$this->register_route( 'data/:id', array(
	  		'method' => 'put',
	  		'callback' => array( new Data(), 'editData' )
		));

		parent::__construct();
	}
}

new My_Routes();