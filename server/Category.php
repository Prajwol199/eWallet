<?php
require_once('Wrapper.php');
require_once('Database.php');
require_once('Mailer.php');
require_once('JWT.php');

class Category extends Wrapper{

	protected $table_category = 'categories';
	protected $table_data     = 'data';

	public function __construct(){
        $this->db = Database::instantiate();
    }

    public function getCategory(){
        $select_db  = $this->db->select($this->table_category,['id','title']);
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
    }

    public function getCategoryById($user_id){
        $token = getallheaders();
        if(isset($token['token'])){
            $access_token = $token['token'];
            $jwt_email = JWT::decode($access_token,'abc123',['HS256']);
            $email = $jwt_email->email;
        }
        if(!empty($email)){
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
        }else{
            $this->invalid_access();
        }
    }

    public function addCategory($user_id){
    	$data = json_decode(file_get_contents('php://input'), true);
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

    public function editCategory($id){
    	$data  = json_decode(file_get_contents('php://input'),true);
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
	  					'message' => 'Category delete successfully',
	  					'data'    => array(
	  					'id'      => $id
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
	  					'message' => 'Category delete successfully',
	  					'data'    => array(
	  					'id'      => $id
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
}
$test = new Category();