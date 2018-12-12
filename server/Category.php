<?php
require_once('Wrapper.php');
require_once('Database.php');
require_once('mailer.php');

class Category extends Wrapper{

	protected $table_category = 'categories';
	protected $table_data     = 'data';

	public function __construct(){
        $this->db = Database::instantiate();

        $this->register_route( 'addCategory', array(
            'method'   => 'post',
            'callback' => array( $this, 'addCategory' )
        ));

        $this->register_route( 'editCategory', array(
            'method'   => 'put',
            'callback' => array( $this, 'editCategory' )
        ));

        $this->register_route( 'deleteCategory', array(
            'method'   => 'delete',
            'callback' => array( $this, 'deleteCategory' )
        ));

        $this->register_route( 'user', array(
            'method'   => 'get',
            'callback' => array( $this, 'user' )
        ));

        $this->register_route( 'editCategoryData', array(
            'method'   => 'get',
            'callback' => array( $this, 'editCategoryData' )
        ));
        parent::__construct();
    }

    public function addCategory(){
    	$data = json_decode(file_get_contents('php://input'), true);
        $user_id = $data['user_id'];
        $title = $data['title'];
        if( !empty($user_id) && !empty($title)){
        	$insert_data=[
                'user_id'=>$user_id,
                'title'  =>$title
            ];
            if($this->db->insert($this->table_category,$insert_data)){
            	$this->response( 200, array(
    					'message'=>'Category Insert succesfully',
                        'data'   => $insert_data
                    ));
            }else{
            	$this->response(200,array(
                	'message'=>'Not inserted',
            	));
            }
        }else{
        	$this->response(200,array(
                'message'=>'Some field are empty',
            ));
        }
    }

    public function editCategory(){
    	$data  = json_decode(file_get_contents('php://input'),true);
    	$id    = $_GET['id'];
    	$title = $data['title'];
    	if(!empty($title)){
    		$update_data = array(
    			'title'=>$title
    		);
    		if($this->db->update($this->table_category,$update_data,['id'=>$id])){
    			$this->response( 200, array(
    					'message'=>'Category Update succesfully',
                        'data'   => $update_data
                    ));
    		}else{
    			$this->response(200,array(
                	'message'=>'Not updated',
            	));	
    		}
    	}else{
    		$this->response(200,array(
    			'message'=>"some field are empty"
    		));
    	}
    }

    public function deleteCategory(){
  		$id = $_GET['id'];
  		if(!empty($id)){
  			$category_id_in_data = $this->db->select($this->table_data,['*'],['category_id'=>$id]);
  			$num_rows = mysqli_num_rows($category_id_in_data);
  			if($num_rows > 0 ){
  				 if($this->db->innerjoin($id)){
	  				$this->response(200,array(
	  					'message'=>'Category delete successfully',
	  					'data'   =>array(
	  					'id'     =>$id
	  					)
	  				));
	  			}else{
	  				$this->response(200,array(
	    				'message' => "Error! category not deleted"
	    			));
	  			}
  			}else{
  				if($this->db->delete($this->table_category,['id'=>$id])){
  					$this->response(200,array(
	  					'message'=>'Category delete successfully',
	  					'data'   =>array(
	  					'id'     =>$id
	  					)
	  				));
  				}else{
  					$this->response(200,array(
	    				'message' => "Error! category not deleted"
	    			));
  				}
  			}
  		}else{
  			$this->response(200,array(
    			'message' => "Category ID is empty"
    		));
  		}
    }

    public function editCategoryData(){
    	$category_id = $_GET['id'];
    	if(!empty($category_id)){
    		$select_data = $this->db->select($this->table_category,['title'],['id'=>$category_id]);
    		$fetch_title = $this->fetch($select_data);
    		if(!empty($fetch_title)){
    			$this->response(200,array(
  					'data' => $fetch_title
  				));
    		}else{
    			$this->response(200,array(
    				'message' => "Error! Something gone wrong"
    			));
    		}
    	}else{
    		$this->response(200,array(
    			'message'=>"Category ID is empty"
    		));
    	}
    }

    public function user(){
    	$user_id = $_GET['id'];
  		if(!empty($user_id)){
  			$select_db  = $this->db->select($this->table_category,['id','title'],['user_id'=>$user_id]);
  			$fetch_data = $this->fetch($select_db);
  			if(!empty($fetch_data)){
  				$this->response(200,array(
  					'data'=>$fetch_data
  				));
  			}else{
  				$this->response(200,array(
    				'message'=>"Error! Something gone wrong"
    			));
  			}
  		}else{
  			$this->response(200,array(
    			'message'=>"User ID is empty"
    		));
  		}
    }
}
$test = new Category();