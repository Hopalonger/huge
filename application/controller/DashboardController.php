<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class DashboardController extends Controller
{
    /**
     * Construct this object by extending the basic Controller class
     */
    public function __construct()
    {
        parent::__construct();

        // this entire controller should only be visible/usable by logged in users, so we put authentication-check here
        Auth::checkAuthentication();
    }

    /**
     * This method controls what happens when you move to /dashboard/index in your app.
     */
    public function index()
    {	
        $this->View->render('dashboard/index', array(
                'jobs' => UserModel::getBalance(Session::get('user_id')),
				'users' => UserModel::getJobsUsers(Session::get('user_id')),
				'totaljobs' => UserModel::getTotalJobsOfUser(Session::get('user_id')))
        );
    }
	public function reload()
	{
		$this->View->render('dashboard/reload', array(
                'jobs' => UserModel::getBalance(Session::get('user_id')),
				'users' => UserModel::getJobsUsers(Session::get('user_id')),
				'totaljobs' => UserModel::getTotalJobsOfUser(Session::get('user_id')))
		);
	}	
	public function pay()
	{
		$this->View->render('dashboard/pay', array(
                'jobs' => UserModel::getBalance(Session::get('user_id')),
				'users' => UserModel::getJobsUsers(Session::get('user_id')),
				'totaljobs' => UserModel::getTotalJobsOfUser(Session::get('user_id')),
				'value' => Request::post('pay'))
		);
	}
	public function payment()
	{
				$this->View->render('dashboard/payment', array(
                'jobs' => UserModel::getBalance(Session::get('user_id')),
				'users' => UserModel::getJobsUsers(Session::get('user_id')),
				'totaljobs' => UserModel::getTotalJobsOfUser(Session::get('user_id')),
				'message' => UserModel::addBalance(Session::get('user_id'),Request::post('pay')),
				'value' => Request::post('pay'),
				'token' => Request::post('token'))
		);
	}
	

}

