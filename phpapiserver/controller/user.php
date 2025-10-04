<?php
 require_once 'smtpmessaging.php';
 require_once 'utility.php';

class User
{
    private $db;
    private $mailer;
    private $utility;
    
    function __construct($db)
    {
        $uploadConfig = [
            "allowed" => ['gif', 'jpg', 'png', 'jpeg','svg', 'mp3', 'wav'],
            "max_size" => (20*1024*1024) // => 20mb <=
        ];
        
        $this->db = $db;
        $this->mailer = new SMTPMESSAGING();
        $this->utility = new Utility($uploadConfig);
    }

    // Private Functions
    private function createUser($data)
    {
        $email = $data['email'];
        $fullname = $data['fullname'];
        $userid = $data['userid'];
        $password = $data['password'];
        $mobile = $data['phone'];
        $referal = $data['referal']??"";
        $country = $data['country'];
        $sq = $data['securityQuestion']??"";
        $sa = $data['securityAnswer']??"";
        $pin = $this->createPin();

        $newUser = $this->db->addData('users', [
            "email" => $email,
            "fullname" => $fullname,
            "userid" => $userid,
            "password" => $password,
            "phone" => $mobile,
            "referal" => $referal,
            "country" => $country,
            "otp" => $pin,
            "secret_question" => $sq,
            "secret_answer" => $sa,
            "createdAt"=>date("d F Y")
        ]);
        
        $this->updateOne([
            "table" => 'users',
            "column" => 'profit',
            "value" => 10,
            "selector" => "userid",
            "selector_value" => $userid
        ]);
        
        $this->db->addData('transactions', [
            "amount" => 10,
            "userid" => $userid,
            "description" => "Signup Bonus",
            "method" => "System",
            "type" => "Signup Bonus",
            "fee" => 0,
            "tranx_id" => uniqid(),
            "status"=>1,
            "email"=>$email,
            "createdAt"=>date("d F Y")
        ]);

        // // Send Pin through email
        // $this->sendPin($pin, $email);
        
        session_start();
        $_SESSION['user'] = $userid;

        return $newUser;
    }
    
    public function uploadFile($file) {
        return $this->utility->upload($file);
    }
    
    public function saveAddress($filedata, $address, $user) {
        $filename = $filedata['filename'];
        $filepath = $filedata['filepath'];
        
        $save = $this->db->addData('verifications', [
            "userid" => $user,
            "addressfilepath" => $filename
        ]);
        
        $update = $this->updateAll(["selector"=>'userid', "value"=>$user],[
                "addressfile" => $save,
                "address" => $address
        ]);
        
        if($update) {
            return true;
        }else{
            return false;
        }
        
    }

    private function addDeposit($data,$status=0, $we=false)
    {
        $amount = $data['amount'];
        $user = $data['user'];
        $description = $data['description'];
        $gateway = $data['gateway'];
        $type = $data['type'];
        $proof = isset($data['payproof'])?$data['payproof']:'';
        $fee = $data['fee'];
        $email = $data['email'];

        $new = $this->db->addData('transactions', [
            "amount" => $amount,
            "userid" => $user,
            "description" => $description,
            "method" => $gateway,
            "type" => $type,
            "fee" => $fee,
            "tranx_id" => uniqid(),
            "proof"=>$proof,
            "email"=>$email,
            "status"=>$status,
            "createdAt"=>date("d F Y")
        ]);
        
        $profit = $this->db->SingleFetch(["name"=>"users","col"=>"userid"],$user)['profit'];
        $main = $this->db->SingleFetch(["name"=>"users","col"=>"userid"],$user)['balance'];
        
        if($we) {
            if($data['re'] == 'mtp') {
                if($main < $amount) {
                    return [
                        "sts"=>false,
                        "status" => "Error",
                        "message" => "Insufficient funds in main wallet"
                    ];
                }else{
                    $update =$this->updateOne([
                        "table" => 'users',
                        "column" => 'balance',
                        "value" => $main - $amount,
                        "selector" => "userid",
                        "selector_value" => $user
                    ]);
                    
                    $update =$this->updateOne([
                        "table" => 'users',
                        "column" => 'profit',
                        "value" => $profit + $amount,
                        "selector" => "userid",
                        "selector_value" => $user
                    ]);
                    
                    return [
                        "sts"=>true,
                        "status" => "Success",
                        "message" => "Wallet exchange sucessful"
                    ];
                }

            }else{
                
                if($profit < $amount) {
                    return [
                        "sts"=>false,
                        "status" => "Error",
                        "message" => "Insufficient funds in Profit wallet"
                    ];
                }else{
                    $update =$this->updateOne([
                        "table" => 'users',
                        "column" => 'profit',
                        "value" => $profit - $amount,
                        "selector" => "userid",
                        "selector_value" => $user
                    ]);
                    
                    $update =$this->updateOne([
                        "table" => 'users',
                        "column" => 'balance',
                        "value" => $main + $amount,
                        "selector" => "userid",
                        "selector_value" => $user
                    ]);
                    
                    return [
                        "sts"=>true,
                        "status" => "Success",
                        "message" => "Wallet exchange sucessful"
                    ];
                }
                
            }
        }

        return $new;
    }
    
     private function addedTickets($data)
    {
        $user = $data['user'];
        $description = $data['description'];
        $title = $data['title'];
        $email = $data['email'];
        $proof = isset($data['image'])?$data['image']:'';

        $new = $this->db->addData('ticket', [
            "userid" => $user,
            "description" => $description,
            "title" => $title,
            "image"=>$proof,
            "email"=>$email,
            "createdAt"=>date("d F Y")
        ]);

        return $new;
    }

    private function updateAll($select, $data)
    {
        $update = $this->db->MultipleUpdate('users', [
            "data" => $data,
            "selector" => $select['selector'],
            "selector_value" => $select['value']
        ]);

        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    private function createuserid(String $userid)
    {
        $f1 = explode(" ", $userid);
        $f1 = $f1[0] . rand(100000, 999999);
        return '@' . $f1;
    }

    private function createPin()
    {
        $pin = rand(100000, 999999);
        return $pin;
    }

    private function updateOne($data)
    {
        $update = $this->db->singleUpdate($data);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
    
    function mailHtml($pin) {
        return $html = '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <style>
                    .r-app {
                        height:100%;
                        width:100%;
                        padding: 10px;
                    }
                    .img-top {
                        width:100%;
                        height: 150px;
                        background-color: aqua;
                    }
                    .img-top img {
                        width: 100%;
                        height: 180px;
                        object-fit: cover;
                    }
                    p {
                        font-family: sans-serif;
                        font-size: larger;
                    }
                </style>
            </head>
            <body>
                <div class="r-app">
                    <div class="img-top">
                        <img src="cid:logo" alt="img">
                    </div>
                    <div class="body">
                        <h4>Dear Valued trader</h4>
                        <p>Your email verification code is <h3>'.$pin.'</h3> It is valid for 10 minutes</p>
                        <p>For security purposes, do not share this code with anyone, including a memeber of staff</p>
                        <p>For furhter assistance please contact us via a live chat or email us at <a href="mailto:support@girlholdmyhandwithstormywellingtondigitalmasterclass.com">support@girlholdmyhandwithstormywellingtondigitalmasterclass.com</a> </p>
                        <p>Best Regards,</p>
                        <h4>Coach Stormy</h4>
                    </div>
                </div>
            </body>
        </html>
        ';
    }
    
    private function siteSettings() {
        $user = $res = $this->db->select('settings', [
            "select" => "*",
            "logic" => []
        ]);
        if ($res) {
            return $this->db->fetch($res);
        } else {
            return false;
        }
    }
    
    function getSettings() {
        $settings = $this->siteSettings();
        
        return [
            "phone"=>$settings['phone'],
            "email"=>$settings['email'],
            "address"=>$settings['address'],
            "sitename"=>$settings['sitename'],
        ];
    }

    private function sendPin($pin, $email)
    {
        $body = $this->mailHtml($pin);
        
        
        $mail =  $this->mailer->send($email, 'Email verification', $body, '');

        if($mail['status']) {
            return [
                "status"=>"success",
                "message"=>"Successful, Pin sent"
            ];
        }else{
            return [
                "status"=>"Error",
                "message"=>"Unsuccessful please try again",
                "error"=>$mail['message']
            ];
        }
    }
    
    function messageHtml($body) {
        return $html = '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Girlholdmyhand</title>
                <style>
                    .r-app {
                        height:100%;
                        width:100%;
                        padding: 10px;
                    }
                    .img-top {
                        width:100%;
                        height: 150px;
                        background-color: aqua;
                    }
                    .img-top img {
                        width: 100%;
                        height: 180px;
                        object-fit: cover;
                    }
                    p {
                        font-family: sans-serif;
                        font-size: larger;
                    }
                </style>
            </head>
            <body>
                <div class="r-app">
                    <div class="body">
                        <h4>Dear Valued trader</h4>
                        '.$body.'
                        <p>For furhter assistance please contact us via a live chat on our website or email us at <a href="mailto:support@girlholdmyhandwithstormywellingtondigitalmasterclass.com">support@girlholdmyhandwithstormywellingtondigitalmasterclass.com</a> </p>
                        <p>Best Regards,</p>
                        <h4>Coach Stormy</h4>
                    </div>
                </div>
            </body>
        </html>
        ';
    }
    
    function sendEmailToClient($data) {
        $body = $this->messageHtml( $data['body'] );
        $mail =  $this->mailer->send($data['receiver'], $data['subject'], $body);
        
        if($mail['status']) {
            return [
                "status"=>"success",
                "message"=>"Successful, Mail sent"
            ];
        }else{
            return [
                "status"=>"Error",
                "message"=>"Unsuccessful please try again",
                "error"=>$mail['message']
            ];
        }
    }
    
    
    function sendCode($data) {
        $user = $this->get($data['email']);
            
        if($user) {
            $bdy = 'Your password reset code is <br/><strong>'.$user['otp'].'</strong>
                <br/>
                <p>
                    If action was not initiated you, discard message
                </p>
            ';
        
            $body = $this->messageHtml($bdy);
            $mail =  $this->mailer->send($data['email'], 'Password reset code', $body, '');
            
            if($mail['status']) {
                return [
                    "status"=>"success",
                    "message"=>"Successful, reset code sent to ".$data['email']." check your email"
                ];
            }else{
                return [
                    "status"=>"Error",
                    "message"=>"Unknown error please try again or contact customer care",
                    "error"=>$mail['message']
                ];
            }
        }else{
            return [
                    "status"=>"Error",
                    "message"=>"No user found please check and try again",
                ];
        }
    }
    
    function ChangePassword($data) {
        $user = $this->get($data['email']);
        if($user) {
            if($user['otp'] == $data['code']) {
                $done = $this->updateOne([
                    "table" => 'users',
                    "column" => 'password',
                    "value" => $this->hashData($data['password']),
                    "selector" => 'userid ',
                    "selector_value" => $user['userid ']
                ]);
                if ($done) {
                    return [
                        "status"=>"success",
                        "message"=>"Successful, password updated <a href='./login.html'>Login</a>"
                    ];
                } else {
                     return [
                        "status"=>"Error",
                        "message"=>"Unable to update passowrd please try again or contact customer care"
                    ];
                }
            }else{
                return [
                        "status"=>"Error",
                        "message"=>"Incorrect reset code"
                    ];
            }
        }else {
            return [
                    "status"=>"Error",
                    "message"=>"No user found please check and try again",
                ];
        }
    }


    private function updateEmailVerification($email, $data = 1, $selector = 'email')
    {
        $done = $this->updateOne([
            "table" => 'users',
            "column" => 'verifyemailstatus',
            "value" => $data,
            "selector" => $selector,
            "selector_value" => $email
        ]);
        if ($done) {
            return True;
        } else {
            return False;
        }
    }


    //  Public functions 
    function updatePassword($data)
    {
        $user = $this->getUserByID($data['user']);

        if ($user) {
            if($this->verify_password($user['password'], $data['oldpassword'])) {
                $done = $this->updateOne([
                    "table" => 'users',
                    "column" => 'password',
                    "value" => $this->hashData($data['new_password']),
                    "selector" => "userid",
                    "selector_value" => $data['user']
                ]);
                if ($done) {
                    return [
                        "status" => "success",
                        "message" => "Password update successful"
                    ];
                } else {
                    return [
                        "status" => "Error",
                        "message" => "Internal server error"
                    ];;
                }
            }else {
                return [
                    "status" => "Error",
                    "message" => "Incorrect password "
                ];
            }
        }else {
            return [
                "status" => "Error",
                "message" => "User does not exist"
            ];
        }
    }
    
    function updateEmail($data)
    {
        $user = $this->getUserByID($data['user']);

        if ($user) {
            if($this->verify_password($user['password'], $data['password'])) {
                $done = $this->updateOne([
                    "table" => 'users',
                    "column" => 'email',
                    "value" => $data['newemail'],
                    "selector" => "userid",
                    "selector_value" => $data['user']
                ]);
                if ($done) {
                    return [
                        "status" => "success",
                        "message" => "Password update successful"
                    ];
                } else {
                    return [
                        "status" => "Error",
                        "message" => "Internal server error"
                    ];;
                }
            }else {
                return [
                    "status" => "Error",
                    "message" => "Password does not match"
                ];
            }
        }else {
            return [
                "status" => "Error",
                "message" => "User does not exist"
            ];
        }
    }
    
    function updateAddress($data)
    {
        $user = $this->getUserByID($data['userid']);

        if ($user) {
            if($this->verify_password($user['password'], $data['password'])) {
                
                $done = $this->updateAll([
                        "selector"=>'userid', 
                        "value"=>$data['user']
                    ],[
                        "address" => $data['address'],
                        "zip_code" => $data['post_code'],
                        "city" => $data['city'],
                        "state" => $data['state'],
                        "country" => $data['country']
                ]);
                if ($done) {
                    return [
                        "status" => "success",
                        "message" => "Password update successful"
                    ];
                } else {
                    return [
                        "status" => "Error",
                        "message" => "Internal server error"
                    ];;
                }
            }else {
                return [
                    "status" => "Error",
                    "message" => "Password does not match"
                ];
            }
        }else {
            return [
                "status" => "Error",
                "message" => "User does not exist"
            ];
        }
    }
    
    
    function UpdateUser($data)
    {
        $user = $this->getUserByID($data['user']);
        if ($user) {
            if($this->verify_password($user['password'], $data['password'])) {
                
                $done = $this->updateAll([
                        "selector"=>'userid', 
                        "value"=>$data['user']
                    ],[
                        "fullname" => $data['fullname'],
                        "email" => $data['email'],
                        "dob" => $data['dob'],
                        "phone" => $data['phone'],
                        "address" => $data['address'],
                        "zip" => $data['zip'],
                        "city" => $data['city'],
                        "country" => $data['country'],
                        "gender" => $data['gender'],
                        "profile" => $data['image']
                ]);
                if ($done) {
                    return [
                        "status" => "success",
                        "message" => " Update successful"
                    ];
                } else {
                    return [
                        "status" => "Error",
                        "message" => "Internal server error"
                    ];;
                }
            }else {
                return [
                    "status" => "Error",
                    "message" => "Password does not match"
                ];
            }
        }else { 
            return [
                "status" => "Error",
                "message" => "User does not exist"
            ];
        }
    }
    
    function kycc($data)
    {
        $user = $this->getUserByID($data['user']);

        var_dump("hello");

        if ($user) {
            $done = $this->updateAll([
                "selector"=>'userid', 
                    "value"=>$data['user']
                ],[
                "kyc" => "Pending",
                "kyc_image" => $data['kyc_image'],
                "kyc_number" => $data['kyc_number']
            ]);
            if ($done) {
                return [
                    "status" => "success",
                    "message" => "Pending verification"
                ];
            } else {
                return [
                    "status" => "Error",
                    "message" => "Internal server error"
                ];;
            }
        }else {
            return [
                "status" => "Error",
                "message" => "User does not exist"
            ];
        }
    }
    
    function hashData($data)
    {
        return sha1($data);
    }

    function validateInput($inpt, $type = 'string')
    {
        if ($inpt == 'none') {
            return false;
        }
        if ($type == 'string') {
            return strip_tags(filter_var($inpt, FILTER_SANITIZE_STRING));
        }
        if ($type == 'email') {
            return strip_tags(filter_var($inpt, FILTER_VALIDATE_EMAIL));
        }
    }

    function verify_password($p1, $p2)
    {
        $p1 = ($p1);
        $p2 = $this->hashData($p2);

        if ($p1 === $p2) {
            return true;
        } else {
            return false;
        }
    }

    private function get($email)
    {
        $res = $this->db->select('users', [
            "select" => "*",
            "logic" => [
                "data" => [
                    "email" => $email
                ]
            ]
        ]);
        if ($res) {
            return $this->db->fetch($res);
        } else {
            return false;
        }
    }
    
    function readSingle($table, $selector, $value) {
        return $this->db->fetch( $this->db->select($table, [
            "select" => "*",
            "logic" => [
                "data" => [
                    $selector => $value
                ]
            ]
        ]));
        
    } 

    private function SelectAll($table, $data=[])
    {
        $res = $this->db->select($table, [
            "select" => "*",
            "logic" => [
                "data" => $data
            ]
        ]);
        if ($res) {
            return $this->db->fetchAll($res);
        } else {
            return false;
        }
    }

    private function getUserByID($id)
    {
        $res = $this->db->select('users', [
            "select" => "*",
            "logic" => [
                "data" => [
                    "userid" => $id
                ]
            ]
        ]);
        if ($res) {
            return $this->db->fetch($res);
        } else {
            return false;
        }
    }

    private function filterArray($array, $fields)
    {
        $filtered = [];
        foreach ($array as $key => $value) {
            if (in_array($key, $fields)) {
                continue;
            } else {
                $filtered[$key] = $value;
            }
        }

        return $filtered;
    }
    
    private function filterInArray($array, $fields)
    {
        $filtered = [];
        foreach ($array as $key => $value) {
            if (in_array($key, $fields)) {
                $filtered[$key] = $value;
            } else {
                continue;
            }
        }

        return $filtered;
    }

    function getUser($email)
    {
        $user = $this->filterArray($this->getUserByID($email), ['password', 'verifyPin']);
          if ($user) {
            return [
                "status" => "success",
                "message" => "",
                "user"=>$user
            ];
        }
    }
    
    function getAllbalances($email) {
        $me = $this->getUserByID($email);
        if($me) {
            $balances = $this->filterInArray($me, ['balance', 'profitbalance', 'ethminingbalance','btcminingbalance','dogeminingbalance','bnbminingbalance','refererbalance', 'bonus']);
            return [
                "status" => "success",
                "message" => "",
                "user"=>$balances
            ];
        }
        
        
    }
    
    function getPlans($user) {
        $user = $this->SelectAll('plans');

        if ($user) {
            return [
                "status" => "success",
                "message" => "Success",
                "plans" => $user
            ];
        } else {
            return [
                "status" => "Error",
                "message" => "No Plans"
            ];
        }
    }

    //  User Auth
    function Login($data)
    {
        $email = $this->validateInput($data['email'], 'email');
        $password = $data['password'];
        $user = $this->get($email);

        if ($user) {
            if ($this->verify_password($user['password'], $password)) {
                // create a new session object 
                session_start();
                $_SESSION['user'] = $user['userid'];
                return [
                    "status" => "success",
                    "message" => "Login successful",
                    "user"=>$user
                ];
            } else {
                return [
                    "status" => "Error",
                    "message" => "Incorrect email or password"
                ];
            }
        } else {
            return [
                "status" => "Error",
                "message" => "User not found"
            ];
        }
    }

    function Register($data)
    {
        $email = $this->validateInput($data['email'], 'email');
        $user = $this->get($email);

        $data['fullname'] = $data['firstName'] . ' ' . $data['lastName'];

        if ($user) {
            return [
                "status" => "error",
                "message" => "Account already exist",
                "registered"=>true
            ];
        } else {
            $data = [
                "email" => $this->validateInput($data['email'], 'email'),
                "fullname" => $this->validateInput($data['fullname']),
                "password" => $this->hashData($data['password']),
                "userid" => $this->createuserid($data['fullname']),
                "phone" => $this->validateInput($data['phone']),
                "country" => $this->validateInput($data['country']),
                "secret_question" => $this->validateInput($data['securityQuestion']),
                "secret_answer" => $this->validateInput($data['securityAnswer'])
            ];
    
            $newUser = $this->createUser($data);
    
            if ($newUser) {
                return [
                    "status" => "success",
                    "message" => "Registration successful"
                ];
            } else {
                return [
                    "status" => "error",
                    "message" => "Unable to register user please try again"
                ];
            }
        }
    }

    function verifyPin($data)
    {
        $email = $this->validateInput($data['email'], 'email');
        $pin = $data['pin'];
        $user = $this->get($email);

        if ($user) {
            if ($user['verifypin'] == $pin) {
                $verified = $this->updateEmailVerification($email);
                if ($verified) {
                    return [
                        "status" => "success",
                        "message" => "Email verification successful"
                    ];
                } else {
                    return [
                        "status" => "Error",
                        "message" => "Email verification unsuccessful please try again"
                    ];
                }
            } else {
                return [
                    "status" => "Error",
                    "message" => "Incorect pin please send again"
                ];
            }
        } else {
            return [
                "status" => "Error",
                "message" => "User not found"
            ];
        }
    }

    function resendPin($data)
    {
        $email = $this->validateInput($data['email'], 'email');
        $user = $this->get($email);

        if ($user) {
            $resend = $this->sendPin($user['verifypin'], $email);
            if ($resend) {
                return [
                    "status" => "success",
                    "message" => "Pin resent"
                ];
            } else {
                return [
                    "status" => "Error",
                    "message" => "Unable to send pin try again"
                ];
            }
        } else {
            return [
                "status" => "Error",
                "message" => "User not found"
            ];
        }
    }
    
    function chargeAmount($bal, $amount, $id) {
        $newbal = $bal - $amount;
        
        $done = $this->updateOne([
            "table" => 'users',
            "column" => 'balance',
            "value" => $newbal,
            "selector" => "userid",
            "selector_value" => $id
        ]);
        if ($done) {
            return true;
        } else {
            return false;
        }
        
    }



    // Withdrawals / Deposits
    function deposit($data)
    {
        $user = $this->getUserByID($data['user']);
        if ($user) {
            $deposit = $this->addDeposit($data);
            if ($deposit) {
                return [
                    "status" => "success",
                    "message" => "Deposit placed"
                ];
            } else {
                return [
                    "status" => "Error",
                    "message" => "Unable to place deposit"
                ];
            }
        } else {
            return [
                "status" => "Error",
                "message" => "User not found"
            ];
        }
    }
    
    function myticket($data)
    {
        $user = $this->getUserByID($data['user']);
        if ($user) {
            $deposit = $this->addedTickets($data);
            if ($deposit) {
                return [
                    "status" => "success",
                    "message" => "Ticket placed"
                ];
            } else {
                return [
                    "status" => "Error",
                    "message" => "Unable to place Ticket"
                ];
            }
        } else {
            return [
                "status" => "Error",
                "message" => "User not found"
            ];
        }
    }
    
    function WalletExchange($data)
    {
        $user = $this->getUserByID($data['user']);
        if ($user) {
            $deposit = $this->addDeposit($data,1, true);
            if ($deposit['sts']) {
                return [
                    "status" => "success",
                    "message" => "Wallet exchange successful"
                ];
            } else {
                return $deposit;
            }
        } else {
            return [
                "status" => "Error",
                "message" => "Exchange error"
            ];
        }
    }
    
    function notifications($user){
        $user = $this->SelectAll('messages', [
            "userid" => $user
        ]);

        if ($user) {
            return [
                "status" => "success",
                "message" => "Success",
                "notifications" => $user
            ];
        } else {
            return [
                "status" => "Error",
                "message" => "No deposits"
            ];
        }
    }
    
    function Alldeposits($user){
        $user = $this->SelectAll('deposits', [
            "user" => $user
        ]);

        if ($user) {
            return [
                "status" => "success",
                "message" => "Success",
                "deposits" => $user
            ];
        } else {
            return [
                "status" => "Error",
                "message" => "No deposits"
            ];
        }
    }

    
    function mailWithHtml(){
        return $html = '
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
                <style>
                    .r-app {
                        height:100%;
                        width:100%;
                        padding: 10px;
                    }
                    .img-top {
                        width:100%;
                        height: 150px;
                        background-color: aqua;
                    }
                    .img-top img {
                        width: 100%;
                        height: 180px;
                        object-fit: cover;
                    }
                    p {
                        font-family: sans-serif;
                        font-size: larger;
                    }
                </style>
            </head>
            <body>
                <div class="r-app">
                    <div class="body">
                        <h4>Dear Valued trader</h4>
                        <p style="">Dear customer! Your account request for instant withdrawal has been received and its being processed, please provide your withdrawal tax code to complete the process, kindly refer to our online customer care representative for more details! Or you can send us an email  on <a href="mailto:support@girlholdmyhandwithstormywellingtondigitalmasterclass.com">support@girlholdmyhandwithstormywellingtondigitalmasterclass.com</a></p>

                        <p>Thank you for choosing stormystocks</p>
                        
                        <p>Best Regards,</p>
                        <h4> stormystocks</h4>
                    </div>
                </div>
            </body>
        </html>
        ';
    }

    private function sendWithMessage($email){
        $body = $this->mailWithHtml();
        
        
        $mail =  $this->mailer->send($email, 'Withdrawal Notification', $body, '');

        if($mail['status']) {
            return [
                "status"=>"success",
                "message"=>"Successful"
            ];
        }else{
            return [
                "status"=>"Error",
                "message"=>"Unsuccessful please try again",
                "error"=>$mail['message']
            ];
        }
    }
    
    private function placeWithdrawal($data){
        $amount = $data['amount'];
        $user = $data['userid'];
        $wallet = $data['wallet'];
        $email = $data['email'];
        $wallet_type = $data["pay_method"];
        $tranx = uniqid();
        
        $new = $this->db->addData('transactions', [
            "amount" => $amount,
            "userid" => $user,
            "description" => "Requesting a withdrawal of ".$amount." to my ".$wallet_type." Wallet",
            "method" => $wallet_type,
            "type" => "Withdrawal",
            "tranx_id" => $tranx,
            "wallet"=>$wallet,
            "email"=>$email,
            "createdAt"=>date("d F Y")
        ]);
        
        // $this->sendWithMessage($email);
        if($new) {
            return $tranx;
        }else{
            return false;
        }
    }
    
    private function placeWithdrawalBank($data){
        $amount = $data['amount'];
        $user = $data['userid'];
        $bank_name = $data['bank_name'];
        $email = $data['email'];
        $account_name = $data["account_name"];
        $account_number = $data["account_number"];
        $tranx = uniqid();
        
        $new = $this->db->addData('transactions', [
            "amount" => $amount,
            "userid" => $user,
            "description" => "Requesting a withdrawal of ".$amount." to my Bank account",
            "method" => 'Bank',
            "type" => "Withdrawal",
            "tranx_id" => $tranx,
            "bank_name"=>$bank_name,
            "account_name"=>$account_name,
            "account_number"=>$account_number,
            "email"=>$email,
            "createdAt"=>date("d F Y")
        ]);
        
        // $this->sendWithMessage($email);
        if($new) {
            return $tranx;
        }else{
            return false;
        }
    }

    function withdraw($data)
    {
        $user = $this->getUserByID($data['userid']);
        if ($user) {
            $bals = $this->filterInArray($user, ['balance', 'profit', 'ethminingbalance','btcminingbalance','dogeminingbalance','bnbminingbalance','refererbalance', 'bonus']);
            
            if($bals['balance'] < $data['amount']) {
                return [
                    "status" => "Error",
                    "message" => "insufficient funds"
                ];
            }
            
            if($data['pay_method'] === 'Bank') {
                $deposit = $this->placeWithdrawalBank($data);
            }else{
                $deposit = $this->placeWithdrawal($data);
            }
            
            if ($deposit) {
                return [
                    "status" => "success",
                    "message" => "Please enter your withdraw cotcode",
                    "tx_d"=>$deposit,
                    "tx_amt"=>$data['amount']
                ];
            } else {
                return [
                    "status" => "Error",
                    "message" => "Unable to place withdrawal please contact us at support@girlholdmyhandwithstormywellingtondigitalmasterclass.com"
                ];
            }
        } else {
            return [
                "status" => "Error",
                "message" => "User not found"
            ];
        }
        
        
    }
    
    function withdraw_cot_code($data) {
        $user = $this->getUserByID($data['userid']);
        if ($user) {
            
            if($data['code1'] == $user['cot_code']) {
                return [
                    "status" => "success",
                    "next_" => "IMF",
                    "message" => "Enter IMF code"
                ];
            }else{
                return [
                    "status" => "Error",
                    "message" => "Incorrect code please contact us at support@girlholdmyhandwithstormywellingtondigitalmasterclass.com"
                ];
            }
            
        } else {
            return [
                "status" => "Error",
                "message" => "User not found"
            ];
        }
    }
    
    function withdraw_imf_code($data) {
        $user = $this->getUserByID($data['userid']);
        if ($user) {
            
            if($data['code1'] == $user['imf_code']) {
                // $this->chargeAmount($user['balance'], $data['amount'], $data['userid']);
                return [
                    "status" => "success",
                    "next_" => "HAR",
                    "message" => "Enter HAR code"
                ];
            }else{
                return [
                    "status" => "Error",
                    "message" => "Incorrect code please contact us at support@girlholdmyhandwithstormywellingtondigitalmasterclass.com"
                ];
            }
            
        } else {
            return [
                "status" => "Error",
                "message" => "User not found"
            ];
        }
    }
    
    function withdraw_har_code($data) {
        $user = $this->getUserByID($data['userid']);
        if ($user) {
            
            if($data['code1'] == $user['har_code']) {
                return [
                    "status" => "success",
                    "next_" => "TAX",
                    "message" => "Enter TAX code"
                ];
            }else{
                return [
                    "status" => "Error",
                    "message" => "Incorrect code please contact us at support@girlholdmyhandwithstormywellingtondigitalmasterclass.com"
                ];
            }
            
        } else {
            return [
                "status" => "Error",
                "next_" => "DONE",
                "message" => "User not found"
            ];
        }
    }
    
    function withdraw_tax_code($data) {
        $user = $this->getUserByID($data['userid']);
        if ($user) {
            
            if($data['code1'] == $user['otp']) {
                $this->chargeAmount($user['balance'], $data['amount'], $data['userid']);
                return [
                    "status" => "success",
                    "message" => "Withdrawal successful"
                ];
            }else{
                return [
                    "status" => "Error",
                    "message" => "Incorrect code please contact us at support@girlholdmyhandwithstormywellingtondigitalmasterclass.com"
                ];
            }
            
        } else {
            return [
                "status" => "Error",
                "message" => "User not found"
            ];
        }
        
        
    }
    
    function Allwithdraws($user) {
        $user = $this->SelectAll('withdraws', [
            "user" => $user
        ]);

        if ($user) {
            return [
                "status" => "success",
                "message" => "Success",
                "withdraws" => $user
            ];
        } else {
            return [
                "status" => "Error",
                "message" => "No withdrawals"
            ];
        }
    }


    function getUserReferers($user)
    {
        $user = $this->SelectAll('users', [
            "referer" => $user
        ]);
        
        $f=[];

        if ($user) {
            foreach($user as $single) {
                array_push($f, $this->filterArray($single, ['password', 'verifypin', 'verifyemailstatus', 'idcard', 'id', 'balance'. 'profitbalance']));
            }
            return [
                "status" => "success",
                "message" => "Success",
                "referes" => $f
            ];
        } else {
            return [
                "status" => "Error",
                "message" => "No Referrals Yet"
            ];
        }
    }
}

 require_once 'smtpmessaging.php';
 require_once 'utility.php';