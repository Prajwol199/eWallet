<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'ewallet');

class Database{

    public static $_instantiate = '';

    public function __construct(){
        $this->connection();
    }


    public function connection(){
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        if (mysqli_connect_errno()){
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        return $con;
    }

    public static function instantiate(){
        if (!self::$_instantiate) {
            return self::$_instantiate = new Database();
        }
        return self::$_instantiate;
    }

    public function insert($tableName = "", $data = array()){
         # INSERT INTO TABLENAME SET name = 'hello', age='3';
        if( is_array( $data ) && count( $data ) > 0 ){
            // $this->clean($data);
            $sql = 'INSERT INTO ' . $tableName . ' SET ';

            foreach( $data as $field => $value ){
                $sql .= $field . '= "' . $value . '",';
            }
            $sql = rtrim( $sql, ',' );
            $result = mysqli_query($this->connection(),$sql);
            return $result;
        }
        return false;
    }

    public function delete($tableName="",$data){
        if( is_array( $data ) && count( $data ) > 0 ){
            $sql = 'DELETE FROM ' . $tableName. ' WHERE ';  
            foreach ($data as $field => $value){
                $sql .= $field. '="' .$value .'",';

                $sql = rtrim($sql,',');
                $result = mysqli_query($this->connection(),$sql);
                return $result;
            }        
        }
        return false;
    }

    public function update($tableName="",$data="",$criteria=""){
        if( is_array( $data ) && count( $data ) > 0 ){
            $sql = 'UPDATE ' . $tableName. ' SET ';

            foreach ($data as $field => $value){
                $sql .=$field .'="'.$value . '",';
            }
            $sql = rtrim( $sql,',');

            $sql .=' WHERE ';

            foreach ($criteria as $field => $value){
                $sql .=$field .'="'.$value . '"AND';
            }
            $sql = rtrim( $sql,'AND');
            $result = mysqli_query($this->connection(),$sql);
            return $result;
        }
        return false;
    }

    public function select($tableName = '',$data="",$criteria=""){
        if( is_array( $data ) && count( $data ) > 0 ){
            $sql="SELECT ";
            foreach ($data as $value) {
                $sql .=$value . ',';
            }
            $sql= rtrim( $sql,',');
            $sql.=' FROM '. $tableName;
            if (!empty($criteria)) {
                 $sql.=' WHERE ';
                foreach ($criteria as $key => $value) {
                    $sql .=$key.'="' .$value. '" AND ';                     
                }
                $sql = substr($sql,0,-4);
            }
            $result= mysqli_query($this->connection(),$sql);
            return $result;               
        }
        return false;
    }

    public function innerjoin($id){
        $sql = "DELETE categories,data
        FROM categories
        INNER JOIN data ON data.category_id = categories.id
        WHERE categories.id=$id";
        $result= mysqli_query($this->connection(),$sql);
        return $result;
    }
}