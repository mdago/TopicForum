<?php

class Topic {
    //Initialize the Database Variable
    private $db;


    /**
     * Constructor
     */
    public function __construct(){
        $this->db = new Database();
    }

    /**
     * Method to get all the topics
     * query to get all the info from the topics table, username and avatar from the users table 
     * and name from the categories table
     */
    public function getAllTopics(){
        
        $this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
                          INNER JOIN users ON topics.user_id = users.id
                          INNER JOIN categories ON topics.category_id = categories.id
                          ORDER BY create_date DESC");

        //Assigning the results from the db
        $results = $this->db->resultset();

        return $results;
    }
}