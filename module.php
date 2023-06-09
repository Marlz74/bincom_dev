<?php
// require "config.php";
    class query{
        private $stmt;
        private $con;
        public function __construct(){
            $this->con=new mysqli('localhost','root','','bincom');
            $this->con->connect_error?die($this->con->connect_error):'';
            
        }

        
        // Method to prepare a query
        public function prepareQuery($sql,$types,...$params) {
            switch($types){
                case '':
                    $this->stmt = $this->con->prepare($sql);
                    break;
                default :
                $this->stmt = $this->con->prepare($sql);
                $this->stmt->bind_param($types,...$params);
                break ;                        
            }
        }
        
        public function sanitize($data){
            $data=htmlspecialchars($data);
            $data=trim($data);
            $data = stripslashes($data);
            return $data;
        }
        // Method to bind parameters to a prepared statement
        // public function bindParams($types, ...$params) {
        //     $this->stmt->bind_param($types, ...$params);
        // }
        
        // Method to execute a prepared statement that returns a result set
        public function executeSelect() {
            $this->stmt->execute();
            $result = $this->stmt->get_result();
            $data=[];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($data,$row);
                }
                return json_encode($data);
            }
            return false;
            
            
        }
        
        // Method to execute a prepared statement that does not return a result set
        public function executeNonQuery() {
            if ($this->stmt->execute() === TRUE) {
                return true;
            } else {
                return false;
            }
        }
        
        // Destructor to close the database conection
        // public function __destruct() {
        //     $this->stmt->close();
        //     $this->con->close();
        // }

    }

    // $query=new query();
    // $sql='SELECT * FROM party';
    // $query->prepareQuery($sql,'','');
    // $result=json_decode($query->executeSelect());
    // print_r($result);
    // echo "<br>";echo "<br>";echo "<br>";
    // HOW TO READ JSON IN PHP
    // for($i=0;$i<count($result);$i++){
    //     print_r($result[$i]->id);echo "<br>";
    // }
    // HOW TO READ JSON IN PHP
    // foreach ($result as $key => $value) {
    //     print_r($result[$key]->id);
    // }

?>