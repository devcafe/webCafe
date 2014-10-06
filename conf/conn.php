<?php
class Connection extends PDO {
	private $dsn = 'mysql:dbname=ipsum;host=127.0.0.1';
	private $user = 'root';
	private $password = '';
	public $pdo = null;

	function __construct( ) {
		try {
			if ( $this->pdo == null ) {
				$dbh = parent::__construct( $this->dsn , $this->user , $this->password );
				$this->pdo = $dbh;

				return $this->pdo;
			}
		}
		catch ( PDOException $e ) {
			echo 'Connection failed: ' . $e->getMessage( );
		return false;
		}
	}

	function __destruct( ) {
		$this->handle = NULL;
	}
}
?>