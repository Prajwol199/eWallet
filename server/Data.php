<?php
require_once('Wrapper.php');
require_once('Database.php');
require_once('JWT.php');
require_once('Mailer.php');

class Data extends Wrapper{
	protected $table_data ='data'; 

	public function __construct(){

        $this->db = Database::instantiate();

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
  					'id'      => $id
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

    public function getDataById(){
      $token = getallheaders();
      if(isset($token['token'])){
            $access_token = $token['token'];
            $jwt_email = JWT::decode($access_token,'abc123',['HS256']);
            $email = $jwt_email->email;
        }
      if(!empty($email)){
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
      }else{
        $this->invalid_access();
      }
    }
}
$test = new Data();