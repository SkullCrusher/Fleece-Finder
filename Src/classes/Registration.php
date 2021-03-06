<?php

/**
 * Handles the user registration
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/panique/php-login-advanced/
 * @license http://opensource.org/licenses/MIT MIT License
 */
class Registration
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection            = null;
    /**
     * @var bool success state of registration
     */
    public  $registration_successful  = false;
    /**
     * @var bool success state of verification
     */
    public  $verification_successful  = false;
    /**
     * @var array collection of error messages
     */
    public  $errors                   = array();
    /**
     * @var array collection of success / neutral messages
     */
    public  $messages                 = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        session_start();

        // if we have such a POST request, call the registerNewUser() method
        if (isset($_POST["register"])) {
			
            $this->registerNewUser(ucfirst ($_POST['user_name']), $_POST['user_email'], $_POST['user_password_new'], $_POST['user_password_repeat'], $_POST["g-recaptcha-response"], $_POST['user_agree']);
			//print_r($_POST); //debugging
	   
	   // if we have such a GET request, call the verifyNewUser() method
        } else if (isset($_GET["id"]) && isset($_GET["verification_code"])) {
            $this->verifyNewUser($_GET["id"], $_GET["verification_code"]);
        }
    }

    /**
     * Checks if database connection is opened and open it if not
     */
    private function databaseConnection()
    {
        // connection already opened
        if ($this->db_connection != null) {
            return true;
        } else {
            // create a database connection, using the constants from config/config.php
            try {
                // Generate a database connection, using the PDO connector
                // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
                // Also important: We include the charset, as leaving it out seems to be a security issue:
                // @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL says:
                // "Adding the charset to the DSN is very important for security reasons,
                // most examples you'll see around leave it out. MAKE SURE TO INCLUDE THE CHARSET!"
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            // If an error is catched, database connection failed
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR;
                return false;
            }
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities, and creates a new user in the database if
     * everything is fine
     */
    private function registerNewUser($user_name, $user_email, $user_password, $user_password_repeat, $captcha, $agreed)
    {
        // we just remove extra space on username and email
        $user_name  = trim($user_name);
        $user_email = trim($user_email);

		//---------------

		// Get a key from https://www.google.com/recaptcha/admin/create
		$publickey = "6LfWOv8SAAAAAL1_Lk4AMeEL4V7YYDZRNEITuCap";
		$privatekey = "6LfWOv8SAAAAAHLwslU3txrRZK3bo_focQBO2Z23";

		$homepage = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6LfWOv8SAAAAAHLwslU3txrRZK3bo_focQBO2Z23&response=' . $captcha);
		//echo $homepage;
		
		$findme   = '"success": true';
		$pos = strpos($homepage, $findme);
		
	
		if ($pos === false) {
			//echo "The string '$findme' was not found in the string '$mystring'";
			$this->errors[] = MESSAGE_USERNAME_WRONGCAPTCHA;
			return;
		}
	
	
		//--------------
		
        // check provided data validity
        // TODO: check for "return true" case early, so put this first
		
		
		if (empty($user_name)) {
            $this->errors[] = "You must enter a username";
        } elseif (empty($user_password) || empty($user_password_repeat)) {
            $this->errors[] = "You must enter a password for your account";
        } elseif ($user_password !== $user_password_repeat) {
            $this->errors[] = "The passwords you have entered do not match, please renter them";
        } elseif (strlen($user_password) < 6) {
            $this->errors[] = "That password is too short to use, please use another";
        } elseif (strlen($user_name) > 18 || strlen($user_name) < 4) {
            $this->errors[] = "That username is too short to use, please use another";
        } elseif (!preg_match('/^[_a-z\d]{2,64}$/i', $user_name)) {
            $this->errors[] = "That email is invalid, please use another";
        } elseif (empty($user_email)) {
            $this->errors[] = "A email is required to activate an account, please enter one";
        } elseif (strlen($user_email) > 64) {
            $this->errors[] = "That email is too long";
        } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Email is invalid";
		}elseif ($agreed != "true"){
			$this->errors[] = "You must agree to the terms and conditions to use and create an account";
		 // finally if all the above checks are ok
        } else if ($this->databaseConnection()) {
            // check if username or email already exists
            $query_check_user_name = $this->db_connection->prepare('SELECT user_name, user_email FROM users WHERE user_name=:user_name OR user_email=:user_email');
            $query_check_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);
            $query_check_user_name->bindValue(':user_email', $user_email, PDO::PARAM_STR);
            $query_check_user_name->execute();
            $result = $query_check_user_name->fetchAll();

            // if username or/and email find in the database
            // TODO: this is really awful!
            if (count($result) > 0) {
                for ($i = 0; $i < count($result); $i++) {
                    $this->errors[] = "Error: Username or email is already used.";
                }
            } else {
                // check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),
                // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null
                $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);

                // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string
                // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing
                // compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions
                // want the parameter: as an array with, currently only used with 'cost' => XX.
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
                // generate random hash for email verification (40 char string)
                $user_activation_hash = sha1(uniqid(mt_rand(), true));

                // write new users data into database
                $query_new_user_insert = $this->db_connection->prepare('INSERT INTO users (user_name, user_password_hash, user_email, user_activation_hash, user_registration_ip, user_registration_datetime) VALUES(:user_name, :user_password_hash, :user_email, :user_activation_hash, :user_registration_ip, now())');
                $query_new_user_insert->bindValue(':user_name', $user_name, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_email', $user_email, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_registration_ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                $query_new_user_insert->execute();

                // id of new user
                $user_id = $this->db_connection->lastInsertId();
				
				//insert the funds column.
				function FN_User_Create_Funds_Insert($ID){
								
					$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
								
					$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
							
					$statement = null; //The statement
								
					try {
						$statement = $db->prepare('INSERT INTO users_funds (id) VALUES (:id)');			
					} catch (PDOException $e) {
													
						//Error code 1146 - unable to find database.
						return 'Internal_Server_Error'; //Error.
					}
								
					try {
						$statement->execute(array('id' => $ID));
					} catch (PDOException $e) {
															
						//Error code 23000 - unable to to create because of duplicate id.
						return 'Error_Try_Again'; //Error.
					}		
				}
				
				$DC_Error = false;
				//Insert into the abbreviated
				$Funds_result = FN_User_Create_Funds_Insert($user_id);
				
				if($Funds_result == 'Internal_Server_Error' || $Funds_result == 'Error_Try_Again'){
					$DC_Error = true;
				}

				
				//Create the default settings and apply them.
				$Json_User_Banned_From_Site = 'false';
				$Json_User_Banned_From_Post = 'false';
				$Json_User_Banned_From_Review = 'false';
				$Json_User_Banned_From_Messaging = 'false';
				
				
				$Json_User_Post_Fee = '0.0'; // 20 cents.
				
				$Json_User_Allow_Messages = 'true'; //Can the user be messaged.
				
				$Uncompressed_Settings = array('Banned_From_Site' => $Json_User_Banned_From_Site, 'Banned_From_Rating' => $Json_User_Banned_From_Review, 'Banned_From_Messaging' => $Json_User_Banned_From_Messaging, 'Banned_From_Posting' => $Json_User_Banned_From_Post, 'Post_Fee' => $Json_User_Post_Fee, 'User_Allow_Messages' => $Json_User_Allow_Messages);
				
				
				
				$Json_Settings = json_encode($Uncompressed_Settings);
				
				//The insert into the extended functions.
				function FN_User_Create_Settings_Insert($ID, $JSON){
				
					$db = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=utf8', DB_USER, DB_PASS);
					
					$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
				
					$statement = null; //The statement
					
					try {
						$statement = $db->prepare('INSERT INTO users_settings (id, json_settings) VALUES (:id, :json_settings)');			
					} catch (PDOException $e) {
						
						//Error code 1146 - unable to find database.
						return 'Internal_Server_Error'; //Error.
					}
					
					try {
						$statement->execute(array('id' => $ID,':json_settings' => $JSON));
					} catch (PDOException $e) {
						
						//Error code 23000 - unable to to create because of duplicate id.
						return 'Error_Try_Again'; //Error.
					}		
				}
				
				if($DC_Error == false){
					$Settings_result = FN_User_Create_Settings_Insert($user_id, $Json_Settings);
					
					if($Settings_result == 'Internal_Server_Error' || $Settings_result == 'Error_Try_Again'){
						$DC_Error = true;
					}
				}
				
				

                if ($query_new_user_insert && $DC_Error == false) {
                    // send a verification email
                    if ($this->sendVerificationEmail($user_id, $user_email, $user_activation_hash)) {
                        // when mail has been send successfully
                        $this->messages[] = "Verification email has been sent to your email. Follow the instructions from the email.";
                        $this->registration_successful = true;				
						
                    } else {
                        // delete this users account immediately, as we could not send a verification email
                        $query_delete_user = $this->db_connection->prepare('DELETE FROM users WHERE user_id=:user_id');
                        $query_delete_user->bindValue(':user_id', $user_id, PDO::PARAM_INT);
                        $query_delete_user->execute();

                        $this->errors[] = "Internal server error: Please try again in 2 minutes. If this error continues contact support.";
                    }
                } else {
                    $this->errors[] = "Message registration failure.";
                }
            }
        }
    }

    /*
     * sends an email to the provided email address
     * @return boolean gives back true if mail has been sent, gives back false if no mail could been sent
     */
    public function sendVerificationEmail($user_id, $user_email, $user_activation_hash)
    {
        $mail = new PHPMailer;

        // please look into the config/config.php for much more info on how to use this!
        // use SMTP or use mail()
        if (EMAIL_USE_SMTP) {
            // Set mailer to use SMTP
            $mail->IsSMTP();
            //useful for debugging, shows full SMTP errors
            //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            // Enable SMTP authentication
            $mail->SMTPAuth = EMAIL_SMTP_AUTH;
            // Enable encryption, usually SSL/TLS
            if (defined(EMAIL_SMTP_ENCRYPTION)) {
                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;
            }
            // Specify host server
            $mail->Host = EMAIL_SMTP_HOST;
            $mail->Username = EMAIL_SMTP_USERNAME;
            $mail->Password = EMAIL_SMTP_PASSWORD;
            $mail->Port = EMAIL_SMTP_PORT;
        } else {
            $mail->IsMail();
        }

        $mail->From = EMAIL_VERIFICATION_FROM;
        $mail->FromName = EMAIL_VERIFICATION_FROM_NAME;
        $mail->AddAddress($user_email);
        $mail->Subject = EMAIL_VERIFICATION_SUBJECT;

        $link = EMAIL_VERIFICATION_URL.'?id='.urlencode($user_id).'&verification_code='.urlencode($user_activation_hash);

        // the link to your register.php, please set this value in config/email_verification.php
        $mail->Body = EMAIL_VERIFICATION_CONTENT.' '.$link;

        if(!$mail->Send()) {
            $this->errors[] = MESSAGE_VERIFICATION_MAIL_NOT_SENT . $mail->ErrorInfo;
            return false;
        } else {
            return true;
        }
    }

    /**
     * checks the id/verification code combination and set the user's activation status to true (=1) in the database
     */
    public function verifyNewUser($user_id, $user_activation_hash)
    {
        // if database connection opened
        if ($this->databaseConnection()) {
            // try to update user with specified information
            $query_update_user = $this->db_connection->prepare('UPDATE users SET user_active = 1, user_activation_hash = NULL WHERE user_id = :user_id AND user_activation_hash = :user_activation_hash');
            $query_update_user->bindValue(':user_id', intval(trim($user_id)), PDO::PARAM_INT);
            $query_update_user->bindValue(':user_activation_hash', $user_activation_hash, PDO::PARAM_STR);
            $query_update_user->execute();

            if ($query_update_user->rowCount() > 0) {
                $this->verification_successful = true;
                $this->messages[] = MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL;
            } else {
                $this->errors[] = MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL;
            }
        }
    }
}
