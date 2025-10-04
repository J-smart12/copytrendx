<?php
class DB {
    private $conn;

    public function __construct(){
        $this->conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

        if($this->conn->connect_errno !=0) {
            echo "Error connecting to database";
        }
    }
    
    public function validateInput($input,$type='string') {
        if($input == 'none') {
            return false;
        }
        if($type == 'string') {
            return strip_tags(filter_var($input, FILTER_SANITIZE_STRING));
        }
        if($type == 'email') {
            return strip_tags(filter_var($input, FILTER_VALIDATE_EMAIL));
        }
    }

    public function addData($table,$data) {
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
            return true;
        }else{
            return false;
        }
    }

    public function execute($query) {
        return $this->conn->query($query);
    }

    public function fetchAll($result){
        if($result){
            $data = array();
            while($row = $result->fetch_assoc()){
                array_push($data,$row);
            }
            return $data;
        }else{
            return [];
        }
    }

    public function fetch($res) { 
        $row = $res->fetch_assoc();

        return $row;
    }

    public function select($table,$constraints) {
        $query = "SELECT ".$constraints['select']." FROM ".$table;  
            
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

        $result = $this->conn->query($query);

        if($result->num_rows > 0) {
            return $result;
        }else{
            return false;
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
    
    public function singleUpdate($data){
        $query = "UPDATE {$data['table']} SET {$data['column']} = '{$data['value']}' WHERE {$data['selector']} = '{$data['selector_value']}'";
        $stmt = $this->execute($query);

        if($stmt){
            return true;
        }else{
            return 0;
        }
    } 

    public function getUser($userid) {
        $res = $this->select('users',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "userid" => $userid
                ]
            ]
        ]);
        if($res) {
            return $this->fetch( $res );
        }else{
            return false;
        }
    }
    
    public function getUserWithEmail($userid) {
        $res = $this->select('users',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "email" => $userid
                ]
            ]
        ]);
        if($res) {
            return $this->fetch( $res );
        }else{
            return false;
        }
    }
    
    
    
    
    public function getWallets() {
        $res = $this->select('wallets',[
            "select"=>"*",
            "logic"=>[]
        ]);
        if($res) {
            return $this->fetchAll( $res );
        }else{
            return false;
        }
    }
    
    public function getWallet($name) {
         $res = $this->select('wallets',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "name" => $name
                ]
            ]
        ]);
        if($res) {
            return $this->fetch( $res );
        }else{
            return false;
        }
    }
    
    // Functions
    public function getSiteSettings() {
        $res = $this->select('settings',[
            "select"=>"*",
            "logic"=>[]
        ]);
        if($res) {
            return $this->fetch( $res );
        }else{
            return false;
        }
    }
    
    public function getWithdraws($userid) {
        $res = $this->select('transactions',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "userid" => $userid,
                    "sep"=>"AND",
                    "type"=>"Withdrawal"
                ]
            ]
        ]);
        if($res) {
            $withdraws = $this->fetchAll( $res );
             return [
                "count"=>$withdraws?count($withdraws):0,
                "Withdraws"=>$withdraws
            ];
        }else{
            return [
                "count"=>0,
                "Withdraws"=>[]
            ];
        }
    }
    
    
    public function getNotifications($userid) {
        $res = $this->select('notification',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "userid" => $userid
                ]
            ]
        ]);
        if($res) {
            $notif = $this->fetchAll( $res );
             return [
                "count"=>$notif?count($notif):0,
                "notifications"=>$notif
            ];
        }else{
            return [
                "count"=>0,
                "notifications"=>[]
            ];
        }
    }
    
    
    
    public function getDeposits($userid) {
        $res = $this->select('transactions',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "userid" => $userid,
                    "sep"=>"AND",
                    "type"=>"Deposit"
                ]
            ]
        ]);
        if($res) {
            $deposits = $this->fetchAll( $res );
             return [
                "count"=>$deposits?count($deposits):0,
                "Deposits"=>$deposits
            ];
        }else{
           return [
                "count"=>0,
                 "Deposits"=>[]
            ];
        }
    }
    
    public function getTransfer($userid) {
        $res = $this->select('transactions',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "userid" => $userid,
                    "sep"=>"AND",
                    "type"=>"Transfer"
                ]
            ]
        ]);
        if($res) {
            $transfer = $this->fetchAll( $res );
             return [
                "count"=>$transfer?count($transfer):0,
                "Deposits"=>$transfer
            ];
        }else{
            return [
                "count"=>0
            ];
        }
    }
    
    public function getInvests($userid) {
        $res = $this->select('invests',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "userid" => $userid,
                ]
            ]
        ]);
        if($res) {
            $invests = $this->fetchAll( $res );
             return [
                "count"=>$invests?count($invests):0,
                "invests"=>$invests
            ];
        }else{
            return [
                "count"=>0,
                "invests"=>[]
            ];
        }
    }

    public function referal($userid) {
        $res = $this->select('users',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "referal" => $userid
                ]
            ]
        ]);
        if($res) {
            $ref = $this->fetchAll( $res );

            return [
                "count"=>$ref?count($ref):0,
                "referals"=>$ref
            ];
        }else{
            return [
                "count"=>0,
                "referals"=>[]
            ];
        }
    }

    public function tickets($userid) {
        $res = $this->select('ticket',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "userid" => $userid
                ]
            ]
        ]);
        if($res) {
            $tickets = $this->fetchAll( $res );

            return [
                "count"=>$tickets?count($tickets):0,
                "tickets"=>$tickets
            ];
        }else{
            return [
                "count"=>0,
                "tickets"=>[]
            ];
        }
    }

    public function stats($userid) {
        // Get user transactions
        $trans = $this->select('transactions',[
            "select"=>"*",
            "logic"=>[
                "data"=>[
                    "userid" => $userid
                ]
            ]
        ]);

        $transactions = $this->fetchAll( $trans );

        return [
            "count"=>$transactions?count($transactions):0,
            "transactions"=>$transactions
        ];
    }

    
    public function profileImge($filename, $userid){
        $done = $this->singleUpdate([
            "table" => 'users',
            "column" => 'profile_img',
            "value" => $filename,
            "selector" => 'userid',
            "selector_value" => $userid
        ]);
        if($done){
            return $done;
        }else{
            return false;
        }
    }
}

$db = new DB();
