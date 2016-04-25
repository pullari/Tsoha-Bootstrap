<?php
class Message extends BaseModel{

	public $id, $posttime, $topicid, $accoid, $content;

	public function __construct($attributes){
		parent::__construct($attributes);
		$this->validators = array('messageValidate');
	}

	public static function echoName(){
		return 'name';
	}

	public static function all(){

		$query = DB::connection()->prepare('SELECT * FROM Message');
		$query->execute();

		$rows = $query->fetchAll();
		$messages = array();

		foreach ($rows as $row) {		
			$messages[] = new Message(array(
				'id' => $row['id'],
				'posttime' => $row['posttime'],
				'topicid' => $row['topicid'],
				'accoid' => $row['accoid'],
				'content' => $row['content']
			));
		}
		return $messages;
	}

	public static function find($id){

		$query = DB::connection()->prepare('SELECT * FROM Message WHERE id = :id LIMIT 1');
		$query->execute(array('id' => $id));

		$row = $query->fetch();
		if($row){

			$message = new Message(array(
				'id' => $row['id'],
				'posttime' => $row['posttime'],
				'topicid' => $row['topicid'],
				'accoid' => $row['accoid'],
				'content' => $row['content']
			));
			return $message;
		}
		return null;
	}

	public static function findAllFromTopic($id){

		$query = DB::connection()->prepare('SELECT * FROM Message WHERE topicID = :id ORDER BY posttime');
		$query->execute(array('id' => $id));

		$rows = $query->fetchAll();
		$messages = array();

		foreach ($rows as $row) {
			
			$messages[] = new Message(array(
				'id' => $row['id'],
				'posttime' => $row['posttime'],
				'topicid' => $row['topicid'],
				'accoid' => $row['accoid'],
				'content' => $row['content']
			));
		}
		
		return $messages;
	}

	public static function destroy($id){

		$query = DB::connection()->prepare('DELETE FROM Message WHERE id = :id RETURNING topicid');
		$query->execute(array('id' => $id));

		$row = $query->fetch();
		$topicid = $row['topicid'];

		return $topicid;
	}

	public function save(){

		$query = DB::connection()->prepare('INSERT INTO Message(topicid, accoid, content) VALUES (:topicid, 1, :content) RETURNING id, posttime');
		$query->execute(array('topicid' => $this->topicid, 'content' => $this->content));
		$row = $query->fetch();

		$this->id = $row['id'];
		$this->posttime = $row['posttime'];
	}

	public function update(){

		$query = DB::connection()->prepare('UPDATE Message SET content = :content, posttime = NOW() WHERE id = :id RETURNING posttime');
		$query->execute(array('id'=>$this->id, 'content'=>$this->content));

		$row = $query->fetch();

		$this->posttime = $row['posttime'];
	}

	public function messageValidate(){

		$errors = array();
		$errors = parent::validateString($this->content, '5');
		return $errors;
	}
}