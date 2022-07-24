<?php

class Members extends CI_Model
{

        public function getMembers()
        {
                $query = $this->db->get('member');
                return $query->result();
        }
        public function deleteMember($id)
        {
                $this->db->delete('member', array('id' => $id));
                return;
        }


        public function addMember($obj)
        {
                $this->db->insert('member', $obj);
                return;
        }
        public function editMember($obj, $id)
        {
                $this->db->update('member', $obj, "id = $id");
                return;
        }
}
