<?php

class Workouts_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getWorkouts($user_id)
    {
        $this->db->select("*");
        $this->db->from('workout');
        $this->db->where('users.id', $user_id);
        $query = $this->db->get();
        $results = $query->result();
        if ($results) {
            return $results;
        } else {
            return false;
        }
    }
    public function getLifts($workoutID)
    {
        $this->db->select("*");
        $this->db->from('lifts');
        $this->db->where('users.id', $user_id);
        $query = $this->db->get();
        $results = $query->result();
        if ($results) {
            return $results;
        } else {
            return false;
        }
    }
    public function deleteLift($liftID)
    {
        return $this->db->delete('lift', ['id'=>$liftID]);
    }
    public function getallusers()
    {
        $this->db->select("users.*");
        $this->db->from('users');
        $this->db->join('roles', 'users.role_id=roles.id');
        $this->db->order_by('email');
        $query = $this->db->get();
        $results = $query->result();
        return $results;
    }



    public function getroles()
    {
        $this->db->select("*");
        $this->db->from('roles');
        $query = $this->db->get();
        return $query->result();
    }


    public function delete_news($slug)
    {
        if (!$slug) {
            return false;
        }
        return $this->db->delete('news', array('slug' => $slug));
    }
}
