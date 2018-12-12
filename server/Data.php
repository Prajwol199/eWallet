<?php
require_once('Wrapper.php');
require_once('Database.php');
require_once('mailer.php');

class Data extends Wrapper{
	protected $table_data ='data'; 

	public function __construct(){
        $this->db = Database::instantiate();

        $this->register_route( 'add', array(
            'method'   => 'post',
            'callback' => array( $this, 'addData' )
        ));

        $this->register_route( 'edit', array(
            'method'   => 'put',
            'callback' => array( $this, 'editData' )
        ));

        $this->register_route( 'delete', array(
            'method'   => 'delete',
            'callback' => array( $this, 'deleteData' )
        ));

        $this->register_route( 'show', array(
            'method'   => 'get',
            'callback' => array( $this, 'showData' )
        ));

        $this->register_route( 'showEditData', array(
            'method'   => 'get',
            'callback' => array( $this, 'showEditData' )
        ));

        parent::__construct();
    }

    public function addData(){
    	$category_id = $_GET['id'];
    	$data = json_decode(file_get_contents('php://input'), true);
        $name = $data['field_name'];
        $des  = $data['description'];
        if(!empty($name) && !empty($des) && !empty($category_id)){
        	$data_insert = array(
        		'category_id' => $category_id,
        		'field_name'  => $name,
        		'description' => $des
        	);
        	if($this->db->insert($this->table_data,$data_insert)){
        		$this->response( 200, array(
					'message'=>'Data Insert succesfully',
                    'data'   => $data_insert
                ));
        	}else{
        		$this->response(200,array(
                'message' => 'Error! Insert Data',
            ));
        	}
        }else{
        	$this->response(200,array(
                'message' => 'Some field are empty',
            ));
        }
    }
    public function editData(){
    	$id   = $_GET['id'];
    	$data = json_decode(file_get_contents('php://input'), true);
        $name = $data['field_name'];
        $des  = $data['description'];
        if(!empty($name) && !empty($des)){
        	$update_data = array(
    			'field_name'  => $name,
    			'description' => $des
    		);
    		if($this->db->update($this->table_data,$update_data,['id'=>$id])){
    			$this->response( 200, array(
    					'message' => 'Category Update succesfully',
                        'data'    => $update_data
                    ));
    		}else{
    			$this->response(200,array(
                	'message' => 'Not updated',
            	));	
    		}
        }else{
        	$this->response(200,array(
                'message' => 'Some field are empty',
            ));
        }
    }

    public function deleteData(){
    	$id = $_GET['id'];
  		if(!empty($id)){
  			if($this->db->delete($this->table_data,['id'=>$id])){
  				$this->response(200,array(
  					'message' => 'Category delete successfully',
  					'data'    => array(
  					'id'      =>$id
  					)
  				));
  			}else{
  				$this->response(200,array(
    				'message' => "Error! Data not deleted"
    		));
  			}
  		}else{
  			$this->response(200,array(
    			'message' => "Category ID is empty"
    		));
  		}
    }

    public function showData(){
    	$category_id = $_GET['id'];
    	if(!empty($category_id)){
  			$select_db  = $this->db->select($this->table_data,['*'],['category_id'=>$category_id]);
  			$fetch_data = $this->fetch($select_db);
  			if(!empty($fetch_data)){
  				$this->response(200,array(
  					'data' => $fetch_data
  				));
  			}else{
  				$this->response(200,array(
    				'message' => "Error! Something gone wrong"
    			));
  			}
  		}else{
  			$this->response(200,array(
    			'message' => "Catregory ID is empty"
    		));
  		}
    }

    public function showEditData(){
    	$id = $_GET['id'];
    	if(!empty($id)){
  			$select_db  = $this->db->select($this->table_data,['*'],['id'=>$id]);
  			$fetch_data = $this->fetch($select_db);
  			if(!empty($fetch_data)){
  				$this->response(200,array(
  					'data' => $fetch_data
  				));
  			}else{
  				$this->response(200,array(
    				'message' => "Error! Something gone wrong"
    			));
  			}
  		}else{
  			$this->response(200,array(
    			'message' => "Catregory ID is empty"
    		));
  		}
    }
}
$test = new Data();