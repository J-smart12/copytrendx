<?php
// $DB_PARAMS = [
//     "host"=>"localhost",
//     "username"=>"root",
//     "password"=>"root",
//     "database_name"=>"copytrendx"
// ];

$DB_PARAMS = [
    "host"=>"localhost",
    "username"=>"u279230863_copytrend",
    "password"=>"NzwPqemiL0k?",
    "database_name"=>"u279230863_copytrend"
];

class Database {
    private $conn;

    public function __construct($DB_PARAMS){
        if($DB_PARAMS) {
            $this->conn = new mysqli($DB_PARAMS['host'] ,$DB_PARAMS['username'], $DB_PARAMS['password'], $DB_PARAMS['database_name']);
        }else{
            echo('Database parameters not set');
        }
    }

    //  Execute database query
    public function execute($query) {
        return $this->conn->query($query);
    }

    //  Database Create (Insert document) [C]
    public function addData($table, $data) {
        $query = " INSERT INTO ".$table;
        $fs=0;
        $query .=" ( ";
        foreach($data as $dt => $val) {
            $fs++;
            if($fs == count($data)) {
                $query .="`".$dt."`";
            }else{
                $query .="`".$dt."`,";
            }
        }
        $yh=0;
        $query .=" ) VALUES ( ";
        foreach($data as $dt => $val) {
            $yh++;
            if($yh == count($data)) {
                $query .="'".$val."'";
            }else{
                $query .="'".$val."',";
            }
        }
        $query .=" )";

        if($this->conn->query($query) === TRUE) {
            return $this->conn->insert_id;
        }else{
            return false;
        }
    }

    // Database Read  [R]
    public function fetch($res) { 
        $row = $res->fetch_assoc();

        return $row;
    }
    public function fetchAll($res) {
        if($res) {
            $data = [];
        
            while($row = $res->fetch_assoc()) {
                array_push($data,$row);
            }

            return $data;
        }else{
            return [];
        }
    }

    public function select($table, $constraints) {
        $query = "SELECT ".$constraints['select']." FROM ".$table;  
            
        if(isset($constraints['logic'])) {
            if($constraints['logic']) {
                $lg=" WHERE ";
                foreach($constraints['logic']['data'] as $dt => $val) {
                    if($dt == "sep") {
                        $lg .= " ".$val;
                    }else{
                        $lg .=" `".$dt."` = '".$val."' ";
                    }
                }
                $retVal = ($constraints['logic']) ? $lg." ORDER BY id DESC" : "" ;
                $query .=$retVal;
            }
        }

        // echo $query;

        $result = $this->conn->query($query);

        if($result->num_rows > 0) {
            return $result;
        }else{
            return false;
        }
    }

    public function SingleFetch($table,$id){
        $query = "SELECT * FROM {$table['name']} WHERE {$table['col']} = '{$id}'";
        $result = $this->conn->query($query); 
        if($result->num_rows > 0){
            $user = $result->fetch_assoc(); 
            return $user;
        }else{
            return false;
        }
    }
    
    

    //  Database Update [U]
    public function singleUpdate($data){
        $query = "UPDATE {$data['table']} SET {$data['column']} = '{$data['value']}' WHERE {$data['selector']} = '{$data['selector_value']}'";
        $stmt = $this->conn->query($query);

        if($stmt){
            return true;
        }else{
            return 0;
        }
    }

    public function MultipleUpdate($table, $data) {
        $query = " UPDATE ".$table;
        $fs=1;
        $query .=" SET ";
        foreach($data['data'] as $dt => $val) {
            if($fs == count($data['data'])) {
                $query .=" `".$dt."` = '".$val."' ";
            }else{
                $query .=" `".$dt."` = '".$val."', ";
            }
            $fs++;
        }
        $query .=" WHERE `{$data['selector']}` = '{$data['selector_value']}'"; 
        if($this->conn->query($query) === TRUE) {
            return true;
        }else{
            return false;
        }
    }
    
    function selectJoin($table1, $table2, $constraints) {
        $query = "SELECT ".$constraints['select']." FROM ".$table1." ".$constraints['joinType']." ".$table2." ON ".$table1.".".$constraints['same_col']." = ".$table2.".".$constraints['same_col'];
        
        if(isset($constraints['logic'])) {
            if($constraints['logic']) {
                $lg=" WHERE ";
                foreach($constraints['logic']['data'] as $dt => $val) {
                    if($dt == "sep") {
                        $lg .= " ".$val;
                    }else{
                        $lg .=" `".$dt."` = '".$val."' ";
                    }
                }
                $retVal = ($constraints['logic']) ? $lg." ORDER BY id DESC" : "" ;
                $query .=$retVal;
            }
        }
        
        // echo $query;
        
        $result = $this->conn->query($query);

        if($result->num_rows > 0) {
            return $result;
        }else{
            return false;
        }

    }
    
    
    // Databse Delete [D]
    public function Delete($table, $data) {
        $query = "DELETE FROM `{$table}` WHERE `{$data['selector']}` = '{$data['selector_value']}'";
        $stmt = $this->conn->query($query);
        if($stmt){
            return true;
        }else{
            return 0;
        }
    }
}
 
$db = new Database($DB_PARAMS);
// 


















