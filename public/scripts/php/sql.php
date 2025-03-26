<?php 

	class SQL_Query {
		
		private $connection;
		private $user;

		function __construct($user="root", $password="") {
			$this->connection = mysqli_connect("localhost", $user, $password, "chillout_apartman");
			$this->user = $user;
			if (mysqli_connect_errno()) {
				throw new Exception("Database connection error: ". mysqli_connect_error());
			}
			mysqli_set_charset($this->connection, "utf8");
		}

		private function get_param_type($value) {
			switch (gettype($value)) {
				case 'integer':
					return 'i';
				case 'double':
					return 'd';
				case 'string':
					return 's';
				default:
					return 'b'; // nem felismert type-ra
			}
		}

		function query($query, $params) {
			$stmt = $this->connection->prepare($query);

			if ($stmt === false) {
				throw new Exception("Error preparing the query: " . $this->connection->error . " (" . $this->user . ")");
			}

			if (!empty($params)) {
				$paramTypes = "";
				$paramValues = [];
				
				foreach ($params as $key => $value) {
					$paramTypes .= $this->get_param_type($value);
					$paramValues[] = &$params[$key]; // reference-kell az stmt bind_param-nak azért kell a & karakter
				}

				$bindParams = array_merge([$paramTypes], $paramValues);
				call_user_func_array([$stmt, "bind_param"], $bindParams);
			}

			// Query futtatás
			if (!$stmt->execute()) {
				throw new Exception("Error executing query: " . $stmt->error . " (" . $this->user . ")");
			}

			// Fetch results
			if ($stmt->field_count > 0) {  // SELECT query
				$result = $stmt->get_result();
				if ($result && $result->num_rows > 0) {
					$stmt->close();
					return $result->fetch_all(MYSQLI_ASSOC);
				} else {
					$stmt->close();
					return null;
				}
			} else {  // Nem SELECT query (INSERT, UPDATE, DELETE)
				$last_insert_id = mysqli_insert_id($this->connection);
				$stmt->close();
				return $last_insert_id;
			}

		}

		function begin_transaction() {
			if (!$this->connection->begin_transaction()) {
				throw new Exception("Error starting transaction: " . $this->connection->error);
			}
		}

		function commit() {
			if (!$this->connection->commit()) {
				throw new Exception("Error committing transaction: " . $this->connection->error);
			}
		}

		function rollback() {
			if (!$this->connection->rollback()) {
				throw new Exception("Error rolling back transaction: " . $this->connection->error);
			}
		}

		function __destruct() {
			mysqli_close($this->connection);
		}
	}

 ?>