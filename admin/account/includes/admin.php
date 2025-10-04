<?php
class Admin {
    private $userid;
    private $email;
    private $password;

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }
    
     function validateInput($input,$type='string') {
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

    public function login($data){
        $this->email = strip_tags($data["email"]);
        $this->password = strip_tags($data["password"]);

        $query = "SELECT * FROM `administrators` WHERE `email` = '$this->email' AND `password` = '$this->password'";

        $stmt = $this->conn->query($query);
        $num = $stmt->num_rows;

        if($num > 0) {
            session_start();
            $_SESSION['administrator'] = $this->email;
            return true;
        }else{
            return false;
        }
    }

    public function singleUpdate($data){
        $query = "UPDATE {$data['table']} SET {$data['column']} = '{$data['value']}' WHERE {$data['selector']} = '{$data['selector_value']}'";
        $stmt = $this->conn->query($query);

        if($stmt){
            return true;
        }else{
            return 0;
        }
    }
    
    public function MultipleUpdate($select,$datas){
        $query = "UPDATE `".$select['table']."`";
        
        if($datas['logic']) {
            $lg=" SET ";
            $f=0;
            foreach($datas['logic']['data'] as $dt => $val) {
                if(($f < (count($datas['logic']['data']) -1) )) {
                    $lg .="`$dt` = '".$val."', ";
                    $f +=1;
                }else{
                    $lg .="`$dt` = '".$val."' ";
                    break;
                }
            }
            $query .=$lg;
        }
        
        $query .= "WHERE `".$select["selector"]."` = '".$select["selector_value"]."'";
       
        $stmt = $this->conn->query($query) or die($this->conn->error);
        
        if($stmt){
            return true;
        }else{
            return 0;
        }
    }
    
    private function fetchAll($result){
        if($result){
            $data = array();
            while($row = $result->fetch_assoc()){
                array_push($data,$row);
            }
            return $data;
        }else{
            return false;
        }
    }
    
    public function fetch($res) { 
        $row = $res->fetch_assoc();
        return $row;
    }
    
    public function select($table,$constraints) {
        $query = "SELECT ".$constraints['select']." FROM ".$table;  
            
        if($constraints['logic']) {
            $lg=' WHERE ';
            foreach($constraints['logic']['data'] as $dt => $val) {
                $lg .= $dt." = '".$val."'";
            }

            $retVal = ($constraints['logic']) ? $lg : "" ;
            $query .=$retVal;
        }

        $result = $this->conn->query($query);

        if($result->num_rows > 0) {
            return $result;
        }else{
            return false;
        }
    }
    
    public function transfer($data) {
        $email = $this->validateInput($data['email'],'email'); 
        $sender = $this->validateInput($data['sender']);
        $fullname = $this->validateInput($data['fullname']); 
        $amount = $this->validateInput($data['amount']); 
        $account_number = $this->validateInput($data['account_number']); 
        $phone = $this->validateInput($data['phone']);
        $type = $this->validateInput($data['type']);
        
        $receiver = $this->validateInput($data['receiver']); 
        
        $remark = $this->validateInput($data['remark']); 
        
        $bank = $this->validateInput($data['bank']); 
        
        $date = $this->validateInput($data['date']); 
        
        $user = $this->getUserByuserid('users',$sender);
    
        $add = $this->addData('transactions',[
            "remarks" =>$remark,
            "amount" =>$amount,
            "receiver_bank" =>$bank,
            "receiver_email" =>$email,
            "sender" =>$sender,
            "receiver" =>$receiver,
            "senderName" =>'Admin',
            "receiverName" =>$fullname,
            "receiver_account_number" =>$account_number,
            "transaction_type" =>$type,
            "status" =>1,
            "receiver_phone" =>$phone,
            "createdAt" =>$date,
        ]);

        if($add) {
             return ['status'=>302,'message'=>'Done'];
        }else{
            return ['status'=>302,'message'=>'Internal Server Error'];
        }
    } 

    public function getClients(){
        $query ="SELECT * FROM `users` ORDER BY `id` DESC";
        $result = $this->fetchAll($this->conn->query($query));

        if($result){
            return $result;
        }else{
            return FALSE;
        }
    }
    
    
public function getCoins(){
        $query ="SELECT * FROM `wallets` ORDER BY `id` DESC";
        $result = $this->fetchAll($this->conn->query($query));

        if($result){
            return $result;
        }else{
            return FALSE;
        }
    }
    
    public function getUserByuserid($table,$userid) {
        $res = $this->select($table,[
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

    public function getUsersById($id){
        $query ="SELECT * FROM `users` WHERE `userid` = '$id'";
        $result = $this->conn->fetch($this->conn->query($query));

        if($result){
            return $result;
        }else{
            return FALSE;
        }
    }

    public function getTransactions(){
        $query ="SELECT * FROM `transactions` ORDER BY `id` DESC";
        $result = $this->fetchAll($this->conn->query($query));

        if($result){
            return $result;
        }else{
            return FALSE;
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
    
    // public function ValidateUser($userid) {
    //     if($this->singleUpdate([
    //         "table" => 'verification',
    //         "column" => 'status',
    //         "value" => 2,
    //         "selector" => 'userid',
    //         "selector_value" => $userid
    //     ])){
    //         return $this->singleUpdate([
    //             "table" => 'users',
    //             "column" => 'status',
    //             "value" => 2,
    //             "selector" => 'userid',
    //             "selector_value" => $userid
    //         ]);
    //     }
        
    // }


    
    public function validateWithdawal($tid,$val){
        $validate =  $this->singleUpdate([
            "table" => 'transactions',
            "column" => 'status',
            "value" => $val,
            "selector" => 'id',
            "selector_value" => $tid
        ]);
        
        if($validate) {
            $bal = $this->SingleFetch(["name"=>"transactions","col"=>"id"],$tid);
            $t_amount = $bal['amount'];
            $u_bal = $this->SingleFetch(["name"=>"users","col"=>"userid"],$bal['userid']);
            $t_bal = $u_bal['bal'];
            
            $new = (integer)$t_bal - (integer)$t_amount ;
            return $this->singleUpdate([
                "table" => 'users',
                "column" => 'balance',
                "value" => $new,
                "selector" => 'userid',
                "selector_value" => $bal['userid']
            ]);
            
        }
    }
    
    // important
    public function updateBalance($userid,$amount){
        $query = $this->SingleFetch(["name"=>"users","col"=>"userid"],$userid);
        if($query) {
            $oldBal = $query["balance"];
            $newBal = $oldBal + $amount;
            if($this->singleUpdate([
                "table" => 'users',
                "column" => 'balance',
                "value" => $newBal,
                "selector" => 'userid',
                "selector_value" => $userid
            ])){
                return  true;
            }
        }else{
            return false;
        } 
    } 
    
    public function updateDeposited($userid,$amount){
        $query = $this->SingleFetch(["name"=>"users","col"=>"userid"],$userid);
        if($query) {
            $oldBal = $query["deposited"];
            $newBal = $oldBal + $amount;
            if($this->singleUpdate([
                "table" => 'users',
                "column" => 'deposited',
                "value" => $newBal,
                "selector" => 'userid',
                "selector_value" => $userid
            ])){
                return  true;
            }
        }else{
            return false;
        }
    }
    
    public function updateReferal($userid,$amount){
        $query = $this->SingleFetch(["name"=>"users","col"=>"userid"],$userid);
        if($query) {
            $oldBal = $query["ref_bonus"];
            $newBal = $oldBal + $amount;
            if($this->singleUpdate([
                "table" => 'users',
                "column" => 'ref_bonus',
                "value" => $newBal,
                "selector" => 'userid',
                "selector_value" => $userid
            ])){
                return  true;
            }
        }else{
            return false;
        }
    }
    
    public function updateProfit($userid,$amount){
        $query = $this->SingleFetch(["name"=>"users","col"=>"userid"],$userid);
        $oldBal = $query["profit"];

        $newBal = $oldBal + $amount;

        $done = $this->singleUpdate([
            "table" => 'users',
            "column" => 'profit',
            "value" => $newBal,
            "selector" => 'userid',
            "selector_value" => $userid
        ]);
        if($done){
            $sql = "INSERT INTO `invests` (
            `amount`,`userid`
            ) VALUES (
                '$newBal', '$userid'
            )";
            
        $done = $this->conn->query($sql);

        if($done){
            return $done;
        }else{
            return false;
        }

        }
    }
    
    public function updateBonus($userid,$amount){
        $query = $this->SingleFetch(["name"=>"users","col"=>"userid"],$userid);
        $oldBal = $query["bonus"];

        $newBal = $oldBal + $amount;

        return $this->singleUpdate([
            "table" => 'users',
            "column" => 'bonus',
            "value" => $newBal,
            "selector" => 'userid',
            "selector_value" => $userid
        ]);
    }
    
    // public function updateRefBonus($userid,$amount){
    //     $query = $this->SingleFetch(["name"=>"users","col"=>"userid"],$userid);
    //     $oldBal = $query["ref_bonus"];

    //     $newBal = $oldBal + $amount;

    //     return $this->singleUpdate([
    //         "table" => 'users',
    //         "column" => 'ref_bonus',
    //         "value" => $newBal,
    //         "selector" => 'userid',
    //         "selector_value" => $userid
    //     ]);
    // }
    
    // public function upgradePlan($userid,$val){
    //     return $this->singleUpdate([
    //         "table" => 'users',
    //         "column" => 'user_plan',
    //         "value" => $val,
    //         "selector" => 'userid',
    //         "selector_value" => $userid
    //     ]);
    // }
    
    public function updateTaxCode($userid){
        return $this->MultipleUpdate([
        "table" => 'users',
            "selector" => 'userid',
            "selector_value" => $userid
        ], [
            "logic" => [
                "data" => [
                    "cot_code" => rand(11111, 99999),
                    "imf_code" => rand(11111, 99999),
                    "har_code" => rand(11111, 99999),
                    "otp" => rand(11111, 99999),
                ]
        ]]);;
    }
    // public function updateReceipt($userid,$val){
    //     return $this->singleUpdate([
    //         "table" => 'users',
    //         "column" => 'with_receipt',
    //         "value" => $val,
    //         "selector" => 'userid',
    //         "selector_value" => $userid
    //     ]);
    // }
    
    public function validateTransaction($tid,$val){
        $validate =  $this->singleUpdate([
            "table" => 'transactions',
            "column" => 'status',
            "value" => 1,
            "selector" => 'id',
            "selector_value" => $tid
        ]);
        
        if($validate) {
            
            if($val == 1) {
                $details = $this->SingleFetch(["name"=>"transactions","col"=>"id"],$tid);
                $t_amount = $details['amount'];
                
                $s_bal = $this->SingleFetch(["name"=>"users","col"=>"userid"],$details['userid']);
 
                $s_new = $s_bal['balance'] + $t_amount;
                
                $send = $this->singleUpdate([
                    "table" => 'users',
                    "column" => 'balance',
                    "value" => $s_new,
                    "selector" => 'userid',
                    "selector_value" => $s_bal['userid']
                ]);
                
                return $send;
            }else{
                $details = $this->SingleFetch(["name"=>"transactions","col"=>"id"],$tid);
                $t_amount = $details['amount'] + $details['amount'] * 0.3 ;
                
                $s_bal = $this->SingleFetch(["name"=>"users","col"=>"userid"],$details['userid']);
                $sn_bal = $s_bal['balance'];
                $s_new = $s_bal['balance'] - $t_amount;
                
                $send = $this->singleUpdate([
                    "table" => 'users',
                    "column" => 'balance',
                    "value" => $s_new,
                    "selector" => 'userid',
                    "selector_value" => $s_bal['userid']
                ]);
                
                return $send;
            }
            
        }
    }
    // important
    
    public function lockAccount($userid){
        $query = $this->SingleFetch(["name"=>"users","col"=>"userid"],$userid);
        if($query) {
            if($this->singleUpdate([
                "table" => 'users',
                "column" => 'locked',
                "value" => 1,
                "selector" => 'userid',
                "selector_value" => $userid
            ])){
                return  true;
            }
        }else{
            return false;
        }
    }
    
    public function UnlockAccount($userid){
        $query = $this->SingleFetch(["name"=>"users","col"=>"userid"],$userid);
        if($query) {
            if($this->singleUpdate([
                "table" => 'users',
                "column" => 'locked',
                "value" => 0,
                "selector" => 'userid',
                "selector_value" => $userid
            ])){
                return  true;
            }
        }else{
            return false;
        }
    }
    
    public function updateCoin($coin,$val){
        return $this->singleUpdate([
            "table" => 'wallets',
            "column" => 'address',
            "value" => $val,
            "selector" => 'id',
            "selector_value" => $coin
        ]);
    }
    
    public function AddNewCoin($data) {
        $coin_name = $data['wallet_name'];
        $wallet_address = $data['wallet_address'];

        $sql = "INSERT INTO `wallets` (
            `address`,`name`
            ) VALUES (
               '$wallet_address', '$coin_name'
            )";

        $done = $this->conn->query($sql);

        if($done){
            return $done;
        }else{
            return $this->conn->error;
        }
    }
    
    public function DeleteUser($id) {
        $query = "DELETE FROM `users` WHERE `id` = '$id'";
        
        $stmt = $this->conn->query($query);

        if($stmt){
            return true;
        }else{
            return 0;
        }
    }
    
    public function newMessages(){
        $query = "SELECT * FROM `transactions` ORDER BY `id` DESC";

        $stmt = $this->conn->query($query);

        $arr = $this->fetchAll($stmt);

        return $arr;
    }
    
    public function getVerifications(){
        $query = "SELECT * FROM `verification` ORDER BY `id` DESC";

        $stmt = $this->conn->query($query);

        $arr = $this->fetchAll($stmt);

        return $arr;
    }

    public function LimnewMessages(){
        $query = "SELECT * FROM `transactions` ORDER BY `id` DESC LIMIT 10";

        $stmt = $this->conn->query($query);

        $arr = $this->fetchAll($stmt);

        return $arr;
    }
    
    public function getWithdrawals(){
        $query = "SELECT * FROM `transactions` WHERE `withdraw` = 1 ORDER BY `id` DESC";
        
        $stmt = $this->conn->query($query);

        $arr = $this->fetchAll($stmt);

        return $arr;
    }
    
    
}