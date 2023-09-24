<?php

class Model extends Dbh {

    protected function checkUsename($username){

        $sql = "SELECT * FROM login_credentials WHERE username = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username]);

        $result = $stmt->fetchAll();

        return $result;
    }
    
    protected function loginAuth($username, $password){

        $sql = "SELECT * FROM login_credentials WHERE username = ? AND password = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$username, $password]);

        $result = $stmt->fetchAll();

        return $result[0] ?? false;
    }

    protected function get_problem_categories(){

        $sql = "SELECT * FROM problem_categories";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function get_problem_category_id($problem_category){

        $sql = "SELECT id FROM problem_categories WHERE category_description = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$problem_category]);

        $result = $stmt->fetch();

        return $result[0] ?? false;
    }

    protected function get_priorities(){

        $sql = "SELECT * FROM ticket_priorities";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function get_priority_id($ticket_priority){

        $sql = "SELECT id FROM ticket_priorities WHERE priority_description = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ticket_priority]);

        $result = $stmt->fetch();

        return $result[0] ?? false;
    }

    protected function get_ticket_type(){

        $sql = "SELECT * FROM ticket_type";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function get_ticket_type_id($ticket_type){

        $sql = "SELECT id FROM ticket_type WHERE type_description = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ticket_type]);

        $result = $stmt->fetch();

        return $result[0] ?? false;
    }

    protected function check_ticket_code($code){

        $sql = "SELECT * FROM tickets WHERE code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function add_ticket($code, $ticket_title, $ticket_description, $problem_category, $ticket_priority, $ticket_type, $ticket_status, $complainant_id, $date_logged){

        $sql = "INSERT INTO tickets(code, ticket_title, ticket_description, problem_category, ticket_priority, ticket_type, ticket_status, complainant_id, date_logged) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if ($stmt->execute([$code, $ticket_title, $ticket_description, $problem_category, $ticket_priority, $ticket_type, $ticket_status, $complainant_id, $date_logged])) {
            
            echo "submitted";
        }else {
            echo "not_submitted";
        }

    }

    protected function get_user_tickets($id){

        $sql = "SELECT * FROM tickets LEFT JOIN problem_categories ON tickets.problem_category = problem_categories.id LEFT JOIN ticket_status ON tickets.ticket_status = ticket_status.id LEFT JOIN ticket_priorities ON tickets.ticket_priority = ticket_priorities.id LEFT JOIN ticket_type ON tickets.ticket_type = ticket_type.id WHERE tickets.complainant_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function get_tickets(){

        $sql = "SELECT * FROM tickets LEFT JOIN problem_categories ON tickets.problem_category = problem_categories.id LEFT JOIN ticket_status ON tickets.ticket_status = ticket_status.id LEFT JOIN ticket_priorities ON tickets.ticket_priority = ticket_priorities.id LEFT JOIN ticket_type ON tickets.ticket_type = ticket_type.id  LEFT JOIN  users on tickets.complainant_id = users.id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function get_ticket($code){

        $sql = "SELECT * FROM tickets LEFT JOIN problem_categories ON tickets.problem_category = problem_categories.id LEFT JOIN ticket_status ON tickets.ticket_status = ticket_status.id LEFT JOIN ticket_priorities ON tickets.ticket_priority = ticket_priorities.id LEFT JOIN ticket_type ON tickets.ticket_type = ticket_type.id WHERE tickets.code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);

        $result = $stmt->fetchAll();

        return $result[0] ?? false;
    }

    protected function ticket_update($ticket_code, $ticket_title, $ticket_description, $problem_category, $ticket_priority, $ticket_type){

        $sql = "UPDATE tickets SET ticket_title = ?, ticket_description = ?, problem_category = ?, ticket_priority = ?, ticket_type = ? WHERE code = ?";
        $stmt = $this->connect()->prepare($sql);

        if ($stmt->execute([$ticket_title, $ticket_description, $problem_category, $ticket_priority, $ticket_type, $ticket_code])) {
           
            echo "submitted";
        }else {
            echo "not_submitted";
        }

    }

    protected function get_info($id){

        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetchAll();

        return $result[0] ?? false;
    }

    protected function update_info($id, $first_name, $surname, $other_name, $address, $email, $phone_number, $gender){

        $sql = "UPDATE USERS SET first_name = ?, surname = ?, other_name = ?, address = ?, email_address = ?, phone_number = ?, gender = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([$first_name, $surname, $other_name, $address, $email, $phone_number, $gender, $id]);
    }

    protected function add_credentials($username, $password, $account_type){

        $sql = "INSERT INTO login_credentials(username, password, account_type) VALUES(?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if ($stmt->execute([$username, $password, $account_type])) {
            
            $sql = "SELECT id FROM login_credentials WHERE username = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$username]);
    
            $result = $stmt->fetch();
    
            return $result[0] ?? false;
            
        }else {
            
            return false;

        }
    }

    protected function add_user($id, $first_name, $surname, $other_name, $gender, $address, $phone_number, $email, $fileNewName){
        $sql = "INSERT INTO users(id, first_name, surname, other_name, gender, address, phone_number, email_address, image) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if ($stmt->execute([$id, $first_name, $surname, $other_name, $gender, $address, $phone_number, $email, $fileNewName])) {

            echo "success";
        }
    }

    protected function add_admin($id, $first_name, $surname, $other_name, $gender, $phone_number, $department, $role){
        $sql = "INSERT INTO administrators(id, first_name, surname, other_name, gender, phone_number, department_id, role_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);

        if ($stmt->execute([$id, $first_name, $surname, $other_name, $gender, $phone_number, $department, $role])) {

            echo "success";
        }
    }

    protected function get_roles(){

        $sql = "SELECT * FROM roles";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result ?? false;
    }

    protected function get_role($id){

        $sql = "SELECT role_name FROM roles WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();

        return $result[0] ?? false;
    }

    protected function get_departments(){

        $sql = "SELECT * FROM departments";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result ?? false;
    }

    protected function get_assignees($department_id){

        $sql = "SELECT * FROM administrators WHERE department_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$department_id]);

        $result = $stmt->fetchAll();

        return $result ?? false;
    }

    protected function assign_ticket($assignee_id, $code){

        $sql = "UPDATE tickets SET ticket_status = 1, assignee_id = ? WHERE code = ?";
        $stmt = $this->connect()->prepare($sql);

        if ($stmt->execute([$assignee_id, $code])) {
           
            echo "assigned";

        }else {
            echo "not_assigned";
        }
    }

    protected function delete_ticket($code){

        $sql = "DELETE FROM tickets WHERE code = ?";
        $stmt = $this->connect()->prepare($sql);
        
        if ($stmt->execute([$code])) {
            
            echo "deleted";
        }
    }

    protected function close_ticket($code){
        $sql = "UPDATE tickets SET ticket_status = ? WHERE code = ?";
        $stmt = $this->connect()->prepare($sql);
        
        if ($stmt->execute([2 , $code])) {
            echo "closed";
        }
    }

    protected function open_ticket($code){

        $sql = "UPDATE tickets SET ticket_status = ? WHERE code = ?";
        $stmt = $this->connect()->prepare($sql);
        
        if ($stmt->execute([3 , $code])) {
            echo "opened";
        }
    }

    protected function send_message($code, $msg, $id){

        $sql = "SELECT id FROM tickets WHERE code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);

        $ticket_id = $stmt->fetch()[0];

        $input_date = date("Y-m-d H:i:s");

        if (!empty($ticket_id)) {
            
            $sql = "INSERT INTO ticket_actions(tIcket_id, input_date, responded_by, action_details) VALUES(?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            
            if ($stmt->execute([$ticket_id, $input_date, $id, $msg])) {
                echo "sent";
            }else {
                echo "false";
            }
        }
    }

    protected function get_message($code){

        $sql = "SELECT id FROM tickets WHERE code = ? ORDER BY id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);

        $ticket_id = $stmt->fetch()[0];

        if (!empty($ticket_id)) {
            
            $sql = "SELECT * FROM ticket_actions WHERE ticket_id = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$ticket_id]);

            $result = $stmt->fetchAll();

            return $result ?? false;
        }
    }

    protected function get_users(){

        $sql = "SELECT * FROM login_credentials LEFT JOIN users ON login_credentials.id = users.id ORDER BY users.id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function get_admins(){

        $sql = "SELECT login_credentials.id, login_credentials.username, login_credentials.account_type, administrators.first_name, administrators.surname, administrators.other_name, administrators.gender, administrators.phone_number, roles.role_name, departments.department_name FROM login_credentials LEFT JOIN administrators ON login_credentials.id = administrators.id LEFT JOIN roles ON administrators.role_id = roles.id LEFT JOIN departments ON administrators.department_id = departments.id ORDER BY login_credentials.id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    protected function get_admin($id){

        $sql = "SELECT * FROM login_credentials LEFT JOIN administrators ON login_credentials.id = administrators.id LEFT JOIN roles ON administrators.role_id = roles.id LEFT JOIN departments ON administrators.department_id = departments.id WHERE login_credentials.id = ? ORDER BY login_credentials.id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetch();

        return $result;
    }

    protected function update_password($id, $password){

        $sql = "UPDATE login_credentials SET password = ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);

        if ($stmt->execute([$password, $id])) {
            echo "changed";
        }
    }

    protected function drop_user($id){
        echo $id;
        // $sql = "DELETE FROM login_credentials WHERE id = ?";
        // $stmt = $this->connect()->prepare($sql);
        
        // if ($stmt->execute([$id])) {
            
        //     echo "deleted";
        // }
    }
}
