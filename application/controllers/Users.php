<?php

class Users extends JMC_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {
        if (!logged_in()) {
            redirect('auth/login');
        }
        switch (user('role_id')) {
            case Users_model::DEFAULT_USER:
                $data['workouts'] = $this->users_model->getWorkouts(user('id'));
                $data['title'] = "User dashboard";
                $this->load->view("templates/header", $data);
                $this->load->view("users/userdashboard", $data);
                $this->load->view("templates/footer");
                break;
            case Users_model::WORKER_USER:
                $data['reservations'] = $this->users_model->getallreservations();
                $data['items'] = $this->inventory_model->getallitems();
                $data['title'] = "Worker dashboard";
                $this->load->view("templates/header", $data);
                $this->load->view("users/workerdashboard", $data);
                $this->load->view("templates/footer");
                break;
            case Users_model::ADMIN_USER:
                $data['reservations'] = $this->users_model->getallreservations();
                $data['items'] = $this->inventory_model->getallitems();
                $data['users'] = $this->users_model->getallusers();
                $data['title'] = "Admin dashboard";
                $this->load->view("templates/header", $data);
                $this->load->view("users/admindashboard", $data);
                $this->load->view("templates/footer");
                break;
        }
    }
    public function addworkout()
    {
        if (!logged_in()) {
            redirect('auth/login');
        }

        // Redirect to your logged in landing page here
        $this->load->view("templates/header", $data);
        $this->load->view("addworkout", $data);
        $this->load->view("templates/footer");
    }

    protected function _prepareRoles()
    {
        $rolesall = $this->users_model->getroles();
        $roles = [];
        foreach ($rolesall as $role) {
            $roles[$role->id] = $role->title;
        }
        return $roles;
    }


    public function adminadd()
    {
        if (!$this->_isAuthorized([Users_model::ADMIN_USER])) {
            redirect('auth/login');
        }
        $data['title'] = 'Admin user add';
        $data['roles'] = $this->_prepareRoles();
        $data['error'] = false;
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[' . $this->config->item('authit_users_table') . '.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('authit_password_min_length') . ']');
        $this->form_validation->set_rules('password_conf', 'Confirm Password', 'required|matches[password]');
        if ($this->form_validation->run()) {
            if ($this->authit->signup(set_value('email'), set_value('password'), set_value('role_id'))) {
                // Redirect to admin page - need to add some sort of success message
                redirect('users/dashboard');
            }
        }
        $this->load->view('templates/header', $data);
        $this->load->view('users/adminadd', $data);
        $this->load->view('templates/footer');
    }
}
