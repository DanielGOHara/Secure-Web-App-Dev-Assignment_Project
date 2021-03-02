<?php
/** Name: Authentication
*  Description:
*	- Checks username/password against database
*	- Generates a new login_key and (on successful db insert) applies to session
*	- generates errors array if any errors exist
*	- IMPORTANT! : username and password must be sanitized BEFORE this method is used
*
*  Author: Lewis Harris @ p2419279
*/
namespace Gobbwobblers;

class Authentication
{
    // property declaration
    private $u_name = "";
    private $u_pass = "";
	public $u_key = "";
	public $errorsArray = array();
	
	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	//!!!!!!!!!TO BE REMOVED!!!!!!!!!!
	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	private $tempAdminUsername = "admin";
	private $tempAdminPassword = "root";
	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	//!!!!!!!!!TO BE REMOVED!!!!!!!!!!
	//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	

    // construction inputs must be ALREADY SANITIZED AND VALIDATED
    function __construct($input_user, $input_pass) {
		//assign u_name+u_pass as inputs for username and password
        $this->u_name = $input_user;
        $this->u_pass = $input_pass;
    }
	
	// authenticate will be used to check user inputs against the db
	// returns true if authentication was a success
	public function authenticate() {
		if ($this->u_name==$this->tempAdminUsername) {
			if ($this->u_pass==$this->tempAdminPassword) {
				//valid username + password
			} else {
				array_push($this->errorsArray, "The username or password you entered is invalid");
			}
		} else {
			array_push($this->errorsArray, "The username or password you entered is invalid");
		}
		
		//
		if (count($this->errorsArray)>0) {
			//contains errors
			return false;
		} else {
			//does not contain errors
			//##########################
			//##########################
			//this key should be grabbed from the database and stored in the session only on validation
			$this->u_key = "kb0ss";
			return true;
		}
	}
	
	//method returns errorsArray
	public function getErrors() {
		//check errorsArray isn't empty
		$return = "No errors";
		if (count($this->errorsArray)>-1) {
			$return = "";
			for ($i=0;$i<count($this->errorsArray);$i++) {
				if ($i==count($this->errorsArray)) {
					$return = $return . $this->errorsArray[$i];
				} else {
					$return = $return . $this->errorsArray[$i] .  ", ";
				}
			}
			return $return;
		}
	}
	
	//method dumps this object
	public function dump() {
		return var_dump($this);
	}
	
}
?>










