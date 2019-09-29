<?php

class Workouts extends JMC_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function add()
    {
        if (!logged_in()) {
            redirect('auth/login');
        }
        $data['title'] = "Add workout";
        $this->load->view("templates/header", $data);
        $this->load->view("workouts/add");
        $this->load->view("templates/footer");
    }
    public function edit($workoutID)
    {
        if (!logged_in()) {
            redirect('auth/login');
        }
        $data['title'] = "Add workout";
        $this->load->view("templates/header", $data);
        $this->load->view("workouts/edit");
        $this->load->view("templates/footer");
    }
    public function addlifts($workoutID)
    {
        if (!logged_in()) {
            redirect('auth/login');
        }
        $data['lifts'] = $this->users_model->getLifts($workoutID);
        $data['workoutID'] = $workoutID;

        $data['workouts'] = $this->users_model->getWorkouts(user('id'));
        $data['title'] = "Add workout";
        $this->load->view("templates/header", $data);
        $this->load->view("workouts/addlifts", $data);
        $this->load->view("templates/footer");
    }

    public function insertBodyPart()
    {
        $date = date('Y-m-d H:i:s');

        $connect = mysqli_connect("localhost", "root", "", "gymlog");
        $query = "INSERT INTO workout(body_parts,users_id,date) VALUES ('".$_POST["hidden_framework"]."','".user('id')."','".$date."')";
        if (mysqli_query($connect, $query)) {
        }
    }
    public function insertLift($workoutID)
    {
        echo "<pre>";
        print_r($_POST) ;
        echo "</pre>";
        $date = date('Y-m-d H:i:s');
        $connect = mysqli_connect("localhost", "root", "", "gymlog");
        $query = "INSERT INTO lift(name,reps,weight,date,workout_id) VALUES ('".$_POST["lift"]."','".$_POST["reps"]."','".$_POST["weight"]."','".$date."','".$workoutID."')";
        echo($query);
        if (mysqli_query($connect, $query)) {
        }
    }

    public function deleteWorkout($workoutID)
    {
        $connect = mysqli_connect("localhost", "root", "", "gymlog");
        $query = "DELETE FROM lift where workout_id = '".$workoutID."'";
        if (mysqli_query($connect, $query)) {
        }

        $connect = mysqli_connect("localhost", "root", "", "gymlog");
        $query = "DELETE FROM workout where id = '".$workoutID."'";
        if (mysqli_query($connect, $query)) {
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function deleteLift($liftId)
    {
        $date = date('Y-m-d H:i:s');

        $connect = mysqli_connect("localhost", "root", "", "gymlog");
        $query = "DELETE FROM lift where id = '".$liftId."'";
        if (mysqli_query($connect, $query)) {
        }
        redirect($_SERVER['HTTP_REFERER']);
    }
}
