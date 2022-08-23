<?php
require_once '../DBconnect.php';

class Book{
    // private $conn = $pdo;
    public function runQuery($sql){
        // $stmt = $conn->prepare($sql);
        // return $stmt;
      }
  
      // Insert
      public function insert($name, $email){
        try{
          $stmt = $this->conn->prepare("INSERT INTO crud_users (name, email) VALUES(:name, :email)");
          $stmt->bindparam(":name", $name);
          $stmt->bindparam(":email", $email);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
      }
  
  
      // Update
      public function update($name, $email, $id){
          try{
            $stmt = $this->conn->prepare("UPDATE crud_users SET name = :name, email = :email WHERE id = :id");
            $stmt->bindparam(":name", $name);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return $stmt;
          }catch(PDOException $e){
            echo $e->getMessage();
          }
      }
  
  
      // Delete
      public function delete($id){
        try{
          $stmt = $this->conn->prepare("DELETE FROM crud_users WHERE id = :id");
          $stmt->bindparam(":id", $id);
          $stmt->execute();
          return $stmt;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
      }
  
      // Redirect URL method
      public function redirect($url){
        header("Location: $url");
      }





}

?>