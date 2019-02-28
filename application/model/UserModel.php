<?php

/**
 * UserModel
 * Handles all the PUBLIC profile stuff. This is not for getting data of the logged in user, it's more for handling
 * data of all the other users. Useful for display profile information, creating user lists etc.
 */
class UserModel
{
    /**
     * Gets an array that contains all the users in the database. The array's keys are the user ids.
     * Each array element is an object, containing a specific user's data.
     * The avatar line is built using Ternary Operators, have a look here for more:
     * @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
     *
     * @return array The profiles of all users
     */
    public static function getPublicProfilesOfAllUsers()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT user_id, user_name, user_email, user_active, user_has_avatar, user_deleted FROM users";
        $query = $database->prepare($sql);
        $query->execute();

        $all_users_profiles = array();

        foreach ($query->fetchAll() as $user) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values
            array_walk_recursive($user, 'Filter::XSSFilter');

            $all_users_profiles[$user->user_id] = new stdClass();
            $all_users_profiles[$user->user_id]->user_id = $user->user_id;
            $all_users_profiles[$user->user_id]->user_name = $user->user_name;
            $all_users_profiles[$user->user_id]->user_email = $user->user_email;
            $all_users_profiles[$user->user_id]->user_active = $user->user_active;
            $all_users_profiles[$user->user_id]->user_deleted = $user->user_deleted;
            $all_users_profiles[$user->user_id]->user_avatar_link = (Config::get('USE_GRAVATAR') ? AvatarModel::getGravatarLinkByEmail($user->user_email) : AvatarModel::getPublicAvatarFilePathOfUser($user->user_has_avatar, $user->user_id));
        }


        return $all_users_profiles;
    }
	    public static function getUserExtensionOfAllUsers()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = $sql = "SELECT * FROM userextension";
        $query = $database->prepare($sql);
        $query->execute();
	
        $all_users_stuff = array();
	 	$counter = 0;
        foreach ($query->fetchAll() as $user) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values
             array_walk_recursive($user, 'Filter::XSSFilter');
			
            $all_users_stuff[$user->userid] = new stdClass();
			$all_users_stuff[$user->userid]->all = $user;
            $all_users_stuff[$user->userid]->user_id = $user->userid;
            $all_users_stuff[$user->userid]->address1 = $user->address1;
            $all_users_stuff[$user->userid]->address2 = $user->address2;
            $all_users_stuff[$user->userid]->state = $user->state;
            $all_users_stuff[$user->userid]->city = $user->city;
			$all_users_stuff[$user->userid]->zipcode = $user->zipcode;
			$all_users_stuff[$user->userid]->fullname = $user->fullname;
			$all_users_stuff[$user->userid]->stripeid = $user->stripeid;
			$all_users_stuff[$user->userid]->balance = $user->balance;
			$all_users_stuff[$user->userid]->totalpay = $user->totalpay;
			$all_users_stuff[$user->userid]->totaljobs = $user->totaljobs;
			$prints = "3dprints";
			$all_users_stuff[$user->userid]->$prints = $user->$prints;
			$all_users_stuff[$user->userid]->weld = $user->weld;
			$all_users_stuff[$user->userid]->cnc = $user->cnc;
			$all_users_stuff[$user->userid]->solder = $user->solder;
			$all_users_stuff[$user->userid]->phone = $user->phone;
			$all_users_stuff[$user->userid]->num = "100";
			
        }
			
        return $all_users_stuff;
    }
	
	public static function getTotalJobsOfUser($user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = $sql = "SELECT * FROM userextension WHERE userid = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
	
        $all_users_stuff = "";
	 	
        foreach ($query->fetchAll() as $user) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values
             array_walk_recursive($user, 'Filter::XSSFilter');
			$all_users_stuff = $user->totaljobs;
        }

        return $all_users_stuff;
    }
	

	
	    public static function getJobsUsers($user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = $sql = "SELECT * FROM jobs WHERE doid = :user_id AND active = 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));
	
        $all_users_stuff = array();
	 	
        foreach ($query->fetchAll() as $user) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values
             array_walk_recursive($user, 'Filter::XSSFilter');
			
            $all_users_stuff[$user->job_id] = new stdClass();
			$prints = "3dprints";
			$all_users_stuff[$user->job_id]->job_id = $user->job_id;
			$all_users_stuff[$user->job_id]->creatorid = $user->createid;
			$all_users_stuff[$user->job_id]->$prints = $user->$prints;
			$all_users_stuff[$user->job_id]->weld = $user->weld;
			$all_users_stuff[$user->job_id]->cnc = $user->cnc;
			$all_users_stuff[$user->job_id]->solder = $user->solder;
			$all_users_stuff[$user->job_id]->decript = $user->description;
			$all_users_stuff[$user->job_id]->files = $user->files;
			$all_users_stuff[$user->job_id]->pay = $user->pay;
			$all_users_stuff[$user->job_id]->reviewed = $user->reviewed;
			$all_users_stuff[$user->job_id]->material = $user->material;
			
        }
	
        return $all_users_stuff;
    }	
	
		    public static function getAllJobs()
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = $sql = "SELECT * FROM jobs WHERE active = 1";
        $query = $database->prepare($sql);
        $query->execute();
	
        $all_users_stuff = array();
	 	
        foreach ($query->fetchAll() as $user) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values
             array_walk_recursive($user, 'Filter::XSSFilter');
			
            $all_users_stuff[$user->job_id] = new stdClass();
			$prints = "3dprints";
			$all_users_stuff[$user->job_id]->job_id = $user->job_id;
			$all_users_stuff[$user->job_id]->creatorid = $user->createid;
			$all_users_stuff[$user->job_id]->$prints = $user->$prints;
			$all_users_stuff[$user->job_id]->weld = $user->weld;
			$all_users_stuff[$user->job_id]->cnc = $user->cnc;
			$all_users_stuff[$user->job_id]->solder = $user->solder;
			$all_users_stuff[$user->job_id]->decript = $user->description;
			$all_users_stuff[$user->job_id]->files = $user->files;
			$all_users_stuff[$user->job_id]->pay = $user->pay;
			$all_users_stuff[$user->job_id]->reviewed = $user->reviewed;
			$all_users_stuff[$user->job_id]->material = $user->material;
			
        }
	
        return $all_users_stuff;
    }
    /**
     * Gets a user's profile data, according to the given $user_id
     * @param int $user_id The user's id
     * @return mixed The selected user's profile
     */
    public static function getPublicProfileOfUser($user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT user_id, user_name, user_email, user_active, user_has_avatar, user_deleted
                FROM users WHERE user_id = :user_id LIMIT 1";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        $user = $query->fetch();
	
        if ($query->rowCount() == 1) {
            if (Config::get('USE_GRAVATAR')) {
                $user->user_avatar_link = AvatarModel::getGravatarLinkByEmail($user->user_email);
            } else {
                $user->user_avatar_link = AvatarModel::getPublicAvatarFilePathOfUser($user->user_has_avatar, $user->user_id);
            }
        } else {
            Session::add('feedback_negative', Text::get('FEEDBACK_USER_DOES_NOT_EXIST'));
        }

        // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
        // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
        // the user's values
        array_walk_recursive($user, 'Filter::XSSFilter');
		
        return $user;
    }
	    public static function getUserReviews($user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT * FROM reviews WHERE userid = :user_id";
        $query = $database->prepare($sql);
        $query->execute(array(':user_id' => $user_id));

        $all_users_profiles = array();

        foreach ($query->fetchAll() as $user) {

            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values
            array_walk_recursive($user, 'Filter::XSSFilter');

            $all_users_profiles[$user->title] = new stdClass();
            $all_users_profiles[$user->title]->title = $user->title;
            $all_users_profiles[$user->title]->body = $user->body;
            $all_users_profiles[$user->title]->stars = $user->stars;
            $all_users_profiles[$user->title]->process = $user->process;
            $all_users_profiles[$user->title]->timely = $user->timelyness;
			$all_users_profiles[$user->title]->quality = $user->quality;
			$all_users_profiles[$user->title]->communication = $user->communication;
       }


        return $all_users_profiles;
    }
	
    /**
     * @param $user_name_or_email
     *
     * @return mixed
     */
    public static function getUserDataByUserNameOrEmail($user_name_or_email)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT user_id, user_name, user_email FROM users
                                     WHERE (user_name = :user_name_or_email OR user_email = :user_name_or_email)
                                           AND user_provider_type = :provider_type LIMIT 1");
        $query->execute(array(':user_name_or_email' => $user_name_or_email, ':provider_type' => 'DEFAULT'));

        return $query->fetch();
    }

    /**
     * Checks if a username is already taken
     *
     * @param $user_name string username
     *
     * @return bool
     */
    public static function doesUsernameAlreadyExist($user_name)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT user_id FROM users WHERE user_name = :user_name LIMIT 1");
        $query->execute(array(':user_name' => $user_name));
        if ($query->rowCount() == 0) {
            return false;
        }
        return true;
    }

    /**
     * Checks if a email is already used
     *
     * @param $user_email string email
     *
     * @return bool
     */
    public static function doesEmailAlreadyExist($user_email)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("SELECT user_id FROM users WHERE user_email = :user_email LIMIT 1");
        $query->execute(array(':user_email' => $user_email));
        if ($query->rowCount() == 0) {
            return false;
        }
        return true;
    }
	
    /**
     * Writes new username to database
     *
     * @param $user_id int user id
     * @param $new_user_name string new username
     *
     * @return bool
     */
    public static function saveNewUserName($user_id, $new_user_name)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("UPDATE users SET user_name = :user_name WHERE user_id = :user_id LIMIT 1");
        $query->execute(array(':user_name' => $new_user_name, ':user_id' => $user_id));
        if ($query->rowCount() == 1) {
            return true;
        }
        return false;
    }

    /**
     * Writes new email address to database
     *
     * @param $user_id int user id
     * @param $new_user_email string new email address
     *
     * @return bool
     */
    public static function saveNewEmailAddress($user_id, $new_user_email)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $query = $database->prepare("UPDATE users SET user_email = :user_email WHERE user_id = :user_id LIMIT 1");
        $query->execute(array(':user_email' => $new_user_email, ':user_id' => $user_id));
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }

    /**
     * Edit the user's name, provided in the editing form
     *
     * @param $new_user_name string The new username
     *
     * @return bool success status
     */
    public static function editUserName($new_user_name)
    {
        // new username same as old one ?
        if ($new_user_name == Session::get('user_name')) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_SAME_AS_OLD_ONE'));
            return false;
        }

        // username cannot be empty and must be azAZ09 and 2-64 characters
        if (!preg_match("/^[a-zA-Z0-9]{2,64}$/", $new_user_name)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_DOES_NOT_FIT_PATTERN'));
            return false;
        }

        // clean the input, strip usernames longer than 64 chars (maybe fix this ?)
        $new_user_name = substr(strip_tags($new_user_name), 0, 64);

        // check if new username already exists
        if (self::doesUsernameAlreadyExist($new_user_name)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USERNAME_ALREADY_TAKEN'));
            return false;
        }

        $status_of_action = self::saveNewUserName(Session::get('user_id'), $new_user_name);
        if ($status_of_action) {
            Session::set('user_name', $new_user_name);
            Session::add('feedback_positive', Text::get('FEEDBACK_USERNAME_CHANGE_SUCCESSFUL'));
            return true;
        } else {
            Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
            return false;
        }
    }

    /**
     * Edit the user's email
     *
     * @param $new_user_email
     *
     * @return bool success status
     */
    public static function editUserEmail($new_user_email)
    {
        // email provided ?
        if (empty($new_user_email)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_FIELD_EMPTY'));
            return false;
        }

        // check if new email is same like the old one
        if ($new_user_email == Session::get('user_email')) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_SAME_AS_OLD_ONE'));
            return false;
        }

        // user's email must be in valid email format, also checks the length
        // @see http://stackoverflow.com/questions/21631366/php-filter-validate-email-max-length
        // @see http://stackoverflow.com/questions/386294/what-is-the-maximum-length-of-a-valid-email-address
        if (!filter_var($new_user_email, FILTER_VALIDATE_EMAIL)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_EMAIL_DOES_NOT_FIT_PATTERN'));
            return false;
        }

        // strip tags, just to be sure
        $new_user_email = substr(strip_tags($new_user_email), 0, 254);

        // check if user's email already exists
        if (self::doesEmailAlreadyExist($new_user_email)) {
            Session::add('feedback_negative', Text::get('FEEDBACK_USER_EMAIL_ALREADY_TAKEN'));
            return false;
        }

        // write to database, if successful ...
        // ... then write new email to session, Gravatar too (as this relies to the user's email address)
        if (self::saveNewEmailAddress(Session::get('user_id'), $new_user_email)) {
            Session::set('user_email', $new_user_email);
            Session::set('user_gravatar_image_url', AvatarModel::getGravatarLinkByEmail($new_user_email));
            Session::add('feedback_positive', Text::get('FEEDBACK_EMAIL_CHANGE_SUCCESSFUL'));
            return true;
        }

        Session::add('feedback_negative', Text::get('FEEDBACK_UNKNOWN_ERROR'));
        return false;
    }

    /**
     * Gets the user's id
     *
     * @param $user_name
     *
     * @return mixed
     */
    public static function getUserIdByUsername($user_name)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT user_id FROM users WHERE user_name = :user_name AND user_provider_type = :provider_type LIMIT 1";
        $query = $database->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute(array(':user_name' => $user_name, ':provider_type' => 'DEFAULT'));

        // return one row (we only have one result or nothing)
        return $query->fetch()->user_id;
    }

    /**
     * Gets the user's data
     *
     * @param $user_name string User's name
     *
     * @return mixed Returns false if user does not exist, returns object with user's data when user exists
     */
    public static function getUserDataByUsername($user_name)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT user_id, user_name, user_email, user_password_hash, user_active,user_deleted, user_suspension_timestamp, user_account_type,
                       user_failed_logins, user_last_failed_login
                  FROM users
                 WHERE (user_name = :user_name OR user_email = :user_name)
                       AND user_provider_type = :provider_type
                 LIMIT 1";
        $query = $database->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute(array(':user_name' => $user_name, ':provider_type' => 'DEFAULT'));

        // return one row (we only have one result or nothing)
        return $query->fetch();
    }

	    public static function getBalance($user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT balance FROM userextension WHERE (userid = :user_id )";
        $query = $database->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute(array(':user_id' => $user_id)); 
		$balance = "";
		        foreach ($query->fetchAll() as $user) {
			
            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values
            array_walk_recursive($user, 'Filter::XSSFilter');

            
            $balance = $user->balance;
           }
        // return one row (we only have one result or nothing)
        return $balance;
    }
	
	 public static function addBalance($user_id,$value)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT balance FROM userextension WHERE (userid = :user_id )";
        $query = $database->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute(array(':user_id' => $user_id)); 
		$balance = "";
		        foreach ($query->fetchAll() as $user) {
			
            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values
            array_walk_recursive($user, 'Filter::XSSFilter');

            
            $balance = $user->balance;
           }
		   $value = (int)$value / 100;
		   $sql = "UPDATE userextension SET balance = :balance WHERE (userid = :user_id )";
        $query = $database->prepare($sql);
		$query->execute(array(':user_id' => $user_id,
							  ':balance' => (int)$balance + (int)$value)); 
		if($query){
			return true;
		}
        // return one row (we only have one result or nothing)
        return false;
    }
		 public static function chargeUser($user_id,$value)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "SELECT balance FROM userextension WHERE (userid = :user_id )";
        $query = $database->prepare($sql);

        // DEFAULT is the marker for "normal" accounts (that have a password etc.)
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute(array(':user_id' => $user_id)); 
		$balance = "";
		        foreach ($query->fetchAll() as $user) {
			
            // all elements of array passed to Filter::XSSFilter for XSS sanitation, have a look into
            // application/core/Filter.php for more info on how to use. Removes (possibly bad) JavaScript etc from
            // the user's values
            array_walk_recursive($user, 'Filter::XSSFilter');

            
            $balance = $user->balance;
           }
		   if((int)$value < (int)$balance){
		   $value = (int)$value / 100;
		   $sql = "UPDATE userextension SET balance = :balance WHERE (userid = :user_id )";
        $query = $database->prepare($sql);
		$query->execute(array(':user_id' => $user_id,
							  ':balance' => (int)$balance - (int)$value)); 
		if($query){
			return true;
		   }}else{
			   return "There was not enough money in the account please add <a href = '<?php echo Config::get('URL'); ?>dashboard/reload'>Money Here</a>";
		   }
        // return one row (we only have one result or nothing)
        return false;
    }
		
		    public static function setBalance($balance,$user_id)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        $sql = "UPDATE userextension SET balance = :balance WHERE (userid = :user_id )";
        $query = $database->prepare($sql);

        // pretty Self Explanitory
        // There are other types of accounts that don't have passwords etc. (FACEBOOK)
        $query->execute(array(':user_id' => $user_id, ':balance' => $balance)); 
		        
		
        // Check if successful
		    $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
        
    }
	
    /**
     * Gets the user's data by user's id and a token (used by login-via-cookie process)
     *
     * @param $user_id
     * @param $token
     *
     * @return mixed Returns false if user does not exist, returns object with user's data when user exists
     */
    public static function getUserDataByUserIdAndToken($user_id, $token)
    {
        $database = DatabaseFactory::getFactory()->getConnection();

        // get real token from database (and all other data)
        $query = $database->prepare("SELECT user_id, user_name, user_email, user_password_hash, user_active,
                                          user_account_type,  user_has_avatar, user_failed_logins, user_last_failed_login
                                     FROM users
                                     WHERE user_id = :user_id
                                       AND user_remember_me_token = :user_remember_me_token
                                       AND user_remember_me_token IS NOT NULL
                                       AND user_provider_type = :provider_type LIMIT 1");
        $query->execute(array(':user_id' => $user_id, ':user_remember_me_token' => $token, ':provider_type' => 'DEFAULT'));

        // return one row (we only have one result or nothing)
        return $query->fetch();
    }
}
