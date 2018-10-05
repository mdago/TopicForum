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


    /**
     * Get Total # of topics
     */
     public function getTotalTopics(){

        $this->db->query('SELECT * FROM topics');
        $row = $this->db->resultset();
        return $this->db->rowCount();
     }

     /**
     * Get Total # of categories
     */
    public function getTotalCategories(){

        $this->db->query('SELECT * FROM categories');
        $row = $this->db->resultset();
        return $this->db->rowCount();
    }

    /**
     * Get Topics by Category
     * @param $categoryId 
     * @return $results 
     * 
     */
    public function getByCategory($categoryId){
        $this->db->query("SELECT topics.*, categories.*, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
						WHERE topics.category_id = :category_id			
        ");
        
        $this->db->bind(':category_id', $categoryId);

        $results = $this->db->resultset();

        return $results;
    }

    /*
	 * Get Topics By Username
	 */
	public function getByUser($user_id){
		$this->db->query("SELECT topics.*, categories.*, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
						WHERE topics.user_id = :user_id
		");
		$this->db->bind(':user_id', $user_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
	
		return $results;
	}

    /**
     * Get Category by id
     */
    public function getCategory($categoryId){
        $this->db->query('SELECT * FROM categories WHERE id = :category_id');
        $this->db->bind(':category_id', $categoryId);

        //Assign Row
        $row = $this->db->single();

        return $row;
    }

    /**
     * Get Total # of replies
     */
    public function getTotalReplies($topicId){
        
        $this->db->query('SELECT * FROM replies WHERE topic_id= '. $topicId);
        $row = $this->db->resultset();
        return $this->db->rowCount();
    }


    /**
     * Get Topic by its Id
     * 
     */
    public function getTopic($id){
        $this->db->query('SELECT topics.*, users.username, users.avatar FROM topics
                          INNER JOIN users on topics.user_id = users.id WHERE topics.id = :id  ');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    /**
     * Get Topic Replies
     */
    public function getReplies($topicId){
        $this->db->query('SELECT replies.*, users.* FROM replies INNER JOIN users ON
                          replies.user_id = users.id WHERE replies.topic_id = :topicId ORDER BY create_date ASC');
        
        $this->db->bind(':topicId', $topicId);

        $results = $this->db->resultset();
        
        return $results;
    }


    /*
	 * Create Topic
	*/
	public function create($data){
		//Insert Query
		$this->db->query("INSERT INTO topics (category_id, user_id, title, body,last_activity)
											VALUES (:category_id, :user_id, :title,:body,:last_activity)");
		//Bind Values
		$this->db->bind(':category_id', $data['category_id']);
		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);
		$this->db->bind(':last_activity', $data['last_activity']);
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
    }
    
    /*
	 * Add Reply
	 */
	public function reply($data){
		//Insert Query
		$this->db->query("INSERT INTO replies (topic_id, user_id, body)
											VALUES (:topic_id, :user_id, :body)");
		//Bind Values
		$this->db->bind(':topic_id', $data['topic_id']);
		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':body', $data['body']);
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}
}