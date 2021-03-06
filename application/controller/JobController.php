<?php

/**
 * This controller shows an area that's only visible for logged in users (because of Auth::checkAuthentication(); in line 16)
 */
class JobController extends Controller
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
        $this->View->render('job/index', array(
                'jobs' => UserModel::getBalance(Session::get('user_id')),
				'users' => UserModel::getAllJobs(Session::get('user_id')),
				'totaljobs' => UserModel::getTotalJobsOfUser(Session::get('user_id')))
        );
    }

}

