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

    public function ListCoins() {
        $res = $this->select('coins',[
            "select"=>"*",
            "logic"=>[]
        ]);
        if($res) {
            $coins = $this->fetchAll( $res );
             return [
                "count"=>$coins?count($coins):0,
                "coins"=>$coins
            ];
        }else{
           return [
                "count"=>0,
                 "coins"=>[]
            ];
        }
    }

    public function getFavCoins($userid) {
        try {
            $res = $this->selectWithJoin([
                "table" => "coins",
                "select" => "*",
                "joins" => [
                    [
                        "table" => "fav_coins",
                        "on" => "coins.id = fav_coins.coin_id",
                        "type" => "INNER"
                    ]
                ],
                "where" => [
                    "fav_coins.userid" => $userid
                ]
            ]);
            
            if($res) {
                $favCoins = $this->fetchAll( $res );
                $favCoins = is_array($favCoins) ? $favCoins : [];

                return [
                    "count"=>count($favCoins),
                    "favCoins"=>$favCoins
                ];
            } else {
                return [
                    "count"=>0,
                    "favCoins"=>[]
                ];
            }
        } catch (Exception $e) {
            // Log error if needed, return empty result
            return [
                "count"=>0,
                "favCoins"=>[]
            ];
        }
    }

    public function selectWithJoin($config) {
        // Validate inputs
        if (empty($config['table']) || !is_array($config)) {
            return false;
        }
        
        // Sanitize main table name
        $mainTable = preg_replace('/[^a-zA-Z0-9_]/', '', $config['table']);
        
        // Handle SELECT clause
        $select = $config['select'] ?? '*';
        
        // Sanitize column names in SELECT
        if ($select !== '*') {
            $selectColumns = explode(',', $select);
            $selectColumns = array_map(function($col) {
                $col = trim($col);
                if ($col === '*') return $col;
                
                // Handle table.column or alias (table.column AS alias)
                if (strpos($col, '.') !== false || stripos($col, ' AS ') !== false) {
                    // For complex selects, sanitize each part
                    $parts = preg_split('/\s+AS\s+/i', $col);
                    $columnPart = trim($parts[0]);
                    
                    if (strpos($columnPart, '.') !== false) {
                        list($tbl, $clmn) = explode('.', $columnPart);
                        $tbl = preg_replace('/[^a-zA-Z0-9_]/', '', trim($tbl));
                        $clmn = trim($clmn) === '*' ? '*' : '`' . preg_replace('/[^a-zA-Z0-9_]/', '', trim($clmn)) . '`';
                        $columnPart = "`{$tbl}`.{$clmn}";
                    } else {
                        $columnPart = '`' . preg_replace('/[^a-zA-Z0-9_]/', '', $columnPart) . '`';
                    }
                    
                    if (isset($parts[1])) {
                        $alias = preg_replace('/[^a-zA-Z0-9_]/', '', trim($parts[1]));
                        return "{$columnPart} AS `{$alias}`";
                    }
                    return $columnPart;
                } else {
                    return '`' . preg_replace('/[^a-zA-Z0-9_]/', '', $col) . '`';
                }
            }, $selectColumns);
            $select = implode(', ', $selectColumns);
        }
        
        $query = "SELECT {$select} FROM `{$mainTable}`";
        $params = [];
        $types = '';
        
        // Handle JOINs
        if (!empty($config['joins']) && is_array($config['joins'])) {
            foreach ($config['joins'] as $join) {
                // Validate join configuration
                if (empty($join['table']) || empty($join['on'])) {
                    continue;
                }
                
                // Sanitize join table
                $joinTable = preg_replace('/[^a-zA-Z0-9_]/', '', $join['table']);
                
                // Get join type (INNER, LEFT, RIGHT, FULL)
                $joinType = strtoupper($join['type'] ?? 'INNER');
                $joinType = in_array($joinType, ['INNER', 'LEFT', 'RIGHT', 'FULL OUTER']) ? $joinType : 'INNER';
                
                // Handle table alias
                $tableAlias = '';
                if (!empty($join['alias'])) {
                    $alias = preg_replace('/[^a-zA-Z0-9_]/', '', $join['alias']);
                    $tableAlias = " AS `{$alias}`";
                }
                
                $query .= " {$joinType} JOIN `{$joinTable}`{$tableAlias}";
                
                // Handle ON conditions
                if (is_array($join['on'])) {
                    $onConditions = [];
                    foreach ($join['on'] as $condition) {
                        // Format: ['table1.column1', '=', 'table2.column2']
                        if (is_array($condition) && count($condition) >= 3) {
                            $left = $this->sanitizeTableColumn($condition[0]);
                            $operator = $this->sanitizeOperator($condition[1]);
                            $right = $this->sanitizeTableColumn($condition[2]);
                            $onConditions[] = "{$left} {$operator} {$right}";
                        }
                    }
                    if (!empty($onConditions)) {
                        $query .= " ON " . implode(' AND ', $onConditions);
                    }
                } else {
                    // Simple string ON condition
                    $onCondition = $join['on'];
                    // Parse and sanitize: "table1.id = table2.user_id"
                    if (preg_match('/^(.+?)\s*(=|!=|<|>|<=|>=)\s*(.+?)$/', $onCondition, $matches)) {
                        $left = $this->sanitizeTableColumn(trim($matches[1]));
                        $operator = $this->sanitizeOperator(trim($matches[2]));
                        $right = $this->sanitizeTableColumn(trim($matches[3]));
                        $query .= " ON {$left} {$operator} {$right}";
                    }
                }
            }
        }
        
        // Handle WHERE clause with prepared statements
        if (!empty($config['where'])) {
            $conditions = [];
            
            foreach ($config['where'] as $key => $value) {
                if ($key === 'sep') {
                    continue;
                }
                
                // Handle table.column format
                if (strpos($key, '.') !== false) {
                    list($tbl, $col) = explode('.', $key);
                    $tbl = preg_replace('/[^a-zA-Z0-9_]/', '', trim($tbl));
                    $col = preg_replace('/[^a-zA-Z0-9_]/', '', trim($col));
                    $columnName = "`{$tbl}`.`{$col}`";
                } else {
                    $columnName = '`' . preg_replace('/[^a-zA-Z0-9_]/', '', $key) . '`';
                }
                
                // Handle different operators
                if (is_array($value) && isset($value['operator']) && isset($value['value'])) {
                    $operator = $this->sanitizeOperator($value['operator']);
                    $conditions[] = "{$columnName} {$operator} ?";
                    $params[] = $value['value'];
                    
                    // Type detection
                    $types .= $this->getParamType($value['value']);
                } else {
                    // Default to equality
                    $conditions[] = "{$columnName} = ?";
                    $params[] = $value;
                    $types .= $this->getParamType($value);
                }
            }
            
            if (!empty($conditions)) {
                $separator = strtoupper($config['where']['sep'] ?? 'AND');
                $separator = in_array($separator, ['AND', 'OR']) ? $separator : 'AND';
                $query .= " WHERE " . implode(" {$separator} ", $conditions);
            }
        }
        
        // Handle GROUP BY
        if (!empty($config['group_by'])) {
            $groupColumns = is_array($config['group_by']) ? $config['group_by'] : [$config['group_by']];
            $groupBy = [];
            
            foreach ($groupColumns as $col) {
                $groupBy[] = $this->sanitizeTableColumn($col);
            }
            
            if (!empty($groupBy)) {
                $query .= " GROUP BY " . implode(', ', $groupBy);
            }
        }
        
        // Handle HAVING
        if (!empty($config['having'])) {
            $havingConditions = [];
            
            foreach ($config['having'] as $key => $value) {
                if ($key === 'sep') continue;
                
                $columnName = $this->sanitizeTableColumn($key);
                
                if (is_array($value) && isset($value['operator']) && isset($value['value'])) {
                    $operator = $this->sanitizeOperator($value['operator']);
                    $havingConditions[] = "{$columnName} {$operator} ?";
                    $params[] = $value['value'];
                    $types .= $this->getParamType($value['value']);
                } else {
                    $havingConditions[] = "{$columnName} = ?";
                    $params[] = $value;
                    $types .= $this->getParamType($value);
                }
            }
            
            if (!empty($havingConditions)) {
                $separator = strtoupper($config['having']['sep'] ?? 'AND');
                $separator = in_array($separator, ['AND', 'OR']) ? $separator : 'AND';
                $query .= " HAVING " . implode(" {$separator} ", $havingConditions);
            }
        }
        
        // Handle ORDER BY
        if (!empty($config['order_by'])) {
            $orderColumns = is_array($config['order_by']) ? $config['order_by'] : [$config['order_by']];
            $orderBy = [];
            
            foreach ($orderColumns as $col) {
                if (is_array($col)) {
                    // Format: ['column' => 'users.created_at', 'direction' => 'DESC']
                    $columnName = $this->sanitizeTableColumn($col['column']);
                    $direction = strtoupper($col['direction'] ?? 'ASC');
                    $direction = in_array($direction, ['ASC', 'DESC']) ? $direction : 'ASC';
                    $orderBy[] = "{$columnName} {$direction}";
                } else {
                    // Simple column name
                    $columnName = $this->sanitizeTableColumn($col);
                    $direction = strtoupper($config['order_direction'] ?? 'ASC');
                    $direction = in_array($direction, ['ASC', 'DESC']) ? $direction : 'ASC';
                    $orderBy[] = "{$columnName} {$direction}";
                }
            }
            
            if (!empty($orderBy)) {
                $query .= " ORDER BY " . implode(', ', $orderBy);
            }
        }
        
        // Handle LIMIT and OFFSET
        if (!empty($config['limit'])) {
            $limit = (int)$config['limit'];
            $query .= " LIMIT {$limit}";
            
            if (!empty($config['offset'])) {
                $offset = (int)$config['offset'];
                $query .= " OFFSET {$offset}";
            }
        }
        
        // Prepare and execute
        if (!empty($params)) {
            $stmt = $this->conn->prepare($query);
            
            if ($stmt === false) {
                return false;
            }
            
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        } else {
            $result = $this->conn->query($query);
        }
        
        // Return result
        if ($result && $result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    
    // Helper method to sanitize table.column format
    private function sanitizeTableColumn($columnStr) {
        $columnStr = trim($columnStr);
        
        if (strpos($columnStr, '.') !== false) {
            list($tbl, $col) = explode('.', $columnStr, 2);
            $tbl = preg_replace('/[^a-zA-Z0-9_]/', '', trim($tbl));
            $col = preg_replace('/[^a-zA-Z0-9_]/', '', trim($col));
            return "`{$tbl}`.`{$col}`";
        } else {
            $col = preg_replace('/[^a-zA-Z0-9_]/', '', $columnStr);
            return "`{$col}`";
        }
    }
    
    // Helper method to sanitize operators
    private function sanitizeOperator($operator) {
        $operator = strtoupper(trim($operator));
        $allowedOperators = ['=', '!=', '<>', '>', '<', '>=', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'IS', 'IS NOT'];
        return in_array($operator, $allowedOperators) ? $operator : '=';
    }
    
    // Helper method to get parameter type
    private function getParamType($value) {
        if (is_int($value)) {
            return 'i';
        } elseif (is_float($value) || is_double($value)) {
            return 'd';
        } else {
            return 's';
        }
    }
}

$db = new DB();
