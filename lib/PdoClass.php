<?php
namespace lib;
 /**
 * 
 */
 class PdoClass  
 {
 	private $link;
 	private $table;
 	private $order;
 	private $where;
 	private $field;
 	private $limit;
 	function __construct($config = '')
 	{
 		$dns = 'mysql:host='.$config['host'].';dbname='.$config['database'].';port='.$config['port'];
 		$this->link = new \PDO($dns,$config['username'],$config['password']);
 		
 	}

 	function table($table){
 		$this->table= $table;
 		$this->where = '';
 		$this->field = '*';
 		$this->order = '';
 		$this->limit = '';
 		return $this;
 	}

 	// 条件
 	function where($wheres){
 		if(is_array($wheres)){
 			$couds =[];
 			$i =0;
 			foreach ($wheres as $key => $value) {
 				$couds[$i] = '`'.$key. '`=\''.$value.'\''; 
 				$i++;
 			}
 			$this->where = implode('AND', $couds);
 		}else{
 			$this->where=$where;
 		}	
 		return $this;
 	}

 	//排序
 	function order($field,$sort='DESC'){
 		$this->order = $field. ' '.$sort;
 		return $this;
 	}

 	// 单条查询
 	function find($field=''){
 		if($field){
 			$this->field=$field;
 		}
 		$sql = 'SELECT '. $this->field .' FROM '.$this->table .($this->where ? ' WHERE '.$this->where : '' ). ' LIMIT 0,1 ';
 		$query = $this->query($sql);
 		$result = $query->fetch(\PDO::FETCH_ASSOC);
 		return $result;
 	}
 	//  
 	function all($field=''){
 		$sql = 'SELECT '. $this->field. ' FROM ' .$this->table .( $this->where ? ' WHERE '.$this->where : '') . ($this->order ? ' ORDER BY '.$this->order :'');
 		$query = $this->query($sql);
		$result = $query->fetchAll(\PDO::FETCH_ASSOC);
 		return $result;
 	}
 	function limit($data1,$data2){
 		$sql = 'SELECT '. $this->field. ' FROM ' .$this->table .( $this->where ? ' WHERE '.$this->where : '') . ($this->order ? ' ORDER BY '.$this->order :'').' LIMIT '.$data1.','.$data2;
 		$query = $this->query($sql);
		$result = $query->fetchAll(\PDO::FETCH_ASSOC);
 		return $result;

 	}
 	// 插入数据
 	public function insert($data){
		$cloums = $this->getColumns($this->table);
		$sql = ' INSERT INTO '.$this->table . ' '. $this->bindSql($data,'insert',$cloums);
	 	
		return  $this->exec($sql );
	}
	// 更新数据
	public function update($data){
		$cloums = $this->getColumns($this->table);
		$sql = ' UPDATE '.$this->table.' SET '.$this->bindSql($data, 'update',$cloums) . ' WHERE ' . $this->where;
		return  $this->exec($sql );
	}
	// 删除数据
	public function delete(){
		$sql = ' DELETE FROM '.$this->table.' WHERE '. $this->where;
		return  $this->exec($sql );
	}
	// 获取数据库字段名
	public function getColumns($table){
		$sql = 'SELECT * FROM '.$table;
		$query = $this->query($sql);
		$count = $query->columnCount();

		$cloums = [];
		for ($i=0; $i < $count; $i++) { 
			$cloums[$i] = $query->getColumnMeta($i)['name'];
		}

		return $cloums;
	}
	// 查询并捕获异常
	public function query($sql){
		try{
			return $this->link->query($sql);
		}catch(PDOException $e){
			echo  $e->getMessage();
			exit;
		}
	}
// 执行并捕获异常
	public function exec($sql){
		try{
			return $this->link->exec($sql);
		}catch(PDOException $e){
			echo $e->getMessage();
			exit;
		}
	}
public function bindSql($arrs, $mode = 'insert',$cloums=[]){
	$keys = [];
	$vals = [];
	$fields = [];
	$i = 0;
	foreach ($arrs as $key => $val) {
		if(count($cloums) > 0 && in_array($key, $cloums)){
			if($mode == 'insert'){
			$keys[$i] = '`'. $key . '`';
			$vals[$i] = '\'' . $val .'\' ';
			}else{
				$fields[$i] = '`'. $key. '`' . ' = \'' .$val.'\'';
			}
			$i++;
		}
	}
	if($mode == 'insert'){
		$sql = '( '.implode(', ', $keys ).') VALUES ('.implode(', ', $vals ).')';
	}else{
		$sql = implode(', ', $fields);
	}

	return $sql;
 }
}
 ?>