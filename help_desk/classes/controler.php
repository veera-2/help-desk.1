<?php

class Controler extends Model {

    public function check_username($username){

        $result = $this->checkUsename($username);

        if ($result) {
            echo '{"response":true}';
        }else {
            echo '{"response":false}';
        }
    }

    public function login_auth($username, $password){

        $result = $this->loginAuth($username, $password);

        return $result;
    }

    public function problem_categories(){
        return $this->get_problem_categories();
    }

    public function ticket_priorities(){
        return $this->get_priorities();
    }
    
    public function ticket_type(){
        return $this->get_ticket_type();
    }

    public function generate_ticket_code(){

        $code = "TKT".rand(111, 999).substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3);
        $result = $this->check_ticket_code($code);

        if (empty($result) ) {
            return $code;
        }else {
            $this->generate_ticket_code();
        }
    }

    public function submit_ticket($category, $priority, $ticket_title, $ticket_description, $complainant_id, $type){

        $problem_category = $this->get_problem_category_id($category);
        $ticket_priority = $this->get_priority_id($priority);
        $ticket_type = $this->get_ticket_type_id($type);
        $ticket_status = 6;
        $date_logged = date("Y-m-d H:i:s");
        $code = $this->generate_ticket_code();

        $this->add_ticket($code, $ticket_title, $ticket_description, $problem_category, $ticket_priority, $ticket_type, $ticket_status, $complainant_id, $date_logged);
    }

    public function update_ticket($ticket_code, $ticket_title, $ticket_description, $category, $priority, $type){

        $problem_category = $this->get_problem_category_id($category);
        $ticket_priority = $this->get_priority_id($priority);
        $ticket_type = $this->get_ticket_type_id($type);

        $this->ticket_update($ticket_code, $ticket_title, $ticket_description, $problem_category, $ticket_priority, $ticket_type);
    }
    
    public function user_tickets($id){
        return $this->get_user_tickets($id);
    }
    
    public function tickets(){
        return $this->get_tickets();
    }
    
    public function ticket($code){
        return $this->get_ticket($code);
    }
    
    public function get_details($id){
        return $this->get_info($id);
    }
    
    public function update_details($id, $first_name, $surname, $other_name, $address, $email, $phone_number, $gender){
        return $this->update_info($id, $first_name, $surname, $other_name, $address, $email, $phone_number, $gender);
    }
    
    public function create_login($username, $password, $account_type){
        return $this->add_credentials($username, $password, $account_type);
    }
    
    public function add_user_info($id, $first_name, $surname, $other_name, $gender, $address, $phone_number, $email, $fileNewName){
        return $this->add_user($id, $first_name, $surname, $other_name, $gender, $address, $phone_number, $email, $fileNewName);
    }

    public function add_admin_info($id, $first_name, $surname, $other_name, $gender, $phone_number, $department, $role){
        return $this->add_admin($id, $first_name, $surname, $other_name, $gender, $phone_number, $department, $role);
    }

    public function roles(){
        return $this->get_roles();
    }

    public function role($id){
        return $this->get_role($id);
    }

    public function departments(){
        return $this->get_departments();
    }

    public function assignees($department_id){
        return $this->get_assignees($department_id);
    }

    public function assign($assignee_id, $code){
        $this->assign_ticket($assignee_id, $code);
    }

    public function delete($code){
        $this->delete_ticket($code);
    }
    
    public function close($code){
        $this->close_ticket($code);
    }

    public function open($code){
        $this->open_ticket($code);
    }

    public function send_msg($code, $msg, $id){
        $this->send_message($code, $msg, $id);
    }

    public function fetch_msgs($code){
        return $this->get_message($code);
    }

    public function system_users(){
        return $this->get_users();
    }

    public function system_admins(){
        return $this->get_admins();
    }

    public function system_admin($id){
        return $this->get_admin($id);
    }

    public function change_password($id, $password){
        return $this->update_password($id, $password);
    }

    public function delete_user($id){
        return $this->drop_user($id);
    }
}


