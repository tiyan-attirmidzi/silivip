<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    const ADMIN_ROLE = 0;
    const THERAPIST_ROLE = 1;
    const CHILD_ROLE = 2;
    const PATH_IMAGE_ADMIN = "assets/image/user/admin/";
    const PATH_IMAGE_CHILD = "assets/image/user/child/";
    const PATH_IMAGE_THERAPIST = "assets/image/user/therapist/";

    private $tableUser = 'tbl_users';
    private $tableTherapist = 'tbl_therapists';
    private $tableChild = 'tbl_childs';
    private $tableParent = 'tbl_parents';
    private $idUsers = 'user_id';    
    private $idParents = 'parent_id';    
    private $idChilds = 'child_id';    
    private $idTherapists = 'therapist_id';    

    public function getAllTherapists($select, $role) {
        $this->db->select($select);
        $this->db->from($this->tableTherapist.' AS t');
        $this->db->join($this->tableUser.' AS u', 'u.user_id = t.user_id', 'left');
        $this->db->where('u.user_role', $role);
        $this->db->order_by('u.user_fullname','ASC');
        $query = $this->db->get();
        if($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getAllChilds($select, $role) {
        $this->db->select($select);
        $this->db->from($this->tableChild.' AS c');
        $this->db->join($this->tableUser.' AS u', 'u.user_id = c.user_id', 'left');
        $this->db->join($this->tableParent.' AS p', 'p.parent_id = c.parent_id', 'left');
        $this->db->where('u.user_role', $role);
        $this->db->order_by('c.child_name','ASC');
        $query = $this->db->get();
        if($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneTherapist($id) {
        $this->db->from($this->tableTherapist.' AS t');
        $this->db->join($this->tableUser.' AS u', 'u.user_id = t.user_id', 'left');
        $this->db->where('t.therapist_id', $id);
        $query = $this->db->get();
        if($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getOneChild($id) {
        $this->db->from($this->tableChild.' AS c');
        $this->db->join($this->tableUser.' AS u', 'u.user_id = c.user_id', 'left');
        $this->db->join($this->tableParent.' AS p', 'p.parent_id = c.parent_id', 'left');
        $this->db->where('c.child_id', $id);
        $query = $this->db->get();
        if($query->num_rows() != 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getWhereTherapist($data) {
        $query = $this->db->where($data)->get($this->tableTherapist);
        return $query->result();
    }

    public function getWhereChild($data) {
        $query = $this->db->where($data)->get($this->tableChild);
        return $query->result();
    }

    public function insertUser($data) {
        $this->db->insert($this->tableUser, $data);
        $id = $this->db->insert_id();
        return $id;
    }
    
    public function insertParent($data) {
        $this->db->insert($this->tableParent, $data);
        $id = $this->db->insert_id();
        return $id;
    }
    
    public function insertChild($data) {
        $this->db->insert($this->tableChild, $data);
        $id = $this->db->insert_id();
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function insertTherapist($data) {
        $this->db->insert($this->tableTherapist, $data);
        $id = $this->db->insert_id();
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function updateTherapist($idUser, $idTherapist, $user, $therapist) {
        if(isset($data[$this->idUsers]) || isset($data[$this->idTherapists])) { 
            unset($data[$this->idUsers]);
            unset($data[$this->idTherapists]);
        };
        $this->db->where($this->idUsers, $idUser)->update($this->tableUser, $user);
        $this->db->where($this->idTherapists, $idTherapist)->update($this->tableTherapist, $therapist);
        return true;
    }

    public function updateChild($idUser, $idParent, $idchild, $user, $parent, $child) {
        if(isset($data[$this->idUsers]) || isset($data[$this->idParents]) || isset($data[$this->idChilds])) { 
            unset($data[$this->idUsers]);
            unset($data[$this->idParents]);
            unset($data[$this->idChilds]);
        };
        $this->db->where($this->idUsers, $idUser)->update($this->tableUser, $user);
        $this->db->where($this->idParents, $idParent)->update($this->tableParent, $parent);
        $this->db->where($this->idChilds, $idchild)->update($this->tableChild, $child);
        // return ($this->db->affected_rows() != 1) ? false : true;
        return true;
    }
    
    public function deleteTherapist($idUser, $idTherapist) {
        $this->db->delete($this->tableUser, array('user_id' => $idUser));
        $this->db->delete($this->tableTherapist, array('therapist_id' => $idTherapist));
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function deleteChild($idUser, $idParent, $idChild) {
        $this->db->delete($this->tableUser, array('user_id' => $idUser));
        $this->db->delete($this->tableParent, array('parent_id' => $idParent));
        $this->db->delete($this->tableChild, array('child_id' => $idChild));
        return ($this->db->affected_rows() != 1) ? false : true;
    }
    
    public function attempt($username, $password) {
        $this->db->where("user_email = '$username' OR user_name = '$username'");
        $this->db->where('user_password', $password);
        $query = $this->db->get($this->tableUser);
        return $query->row();
    }
}