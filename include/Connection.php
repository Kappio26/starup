<?php
if (!class_exists('SQLiteMySQLiResult')) {
    class SQLiteMySQLiResult {
        private $rows;
        private $index = 0;
        public $num_rows = 0;

        public function __construct(array $rows) {
            $this->rows = $rows;
            $this->num_rows = count($rows);
        }

        public function fetch_assoc() {
            if ($this->index < $this->num_rows) {
                return $this->rows[$this->index++];
            }
            return null;
        }
    }
}

if (!class_exists('SQLiteMySQLiStmt')) {
    class SQLiteMySQLiStmt {
        private $pdo;
        private $sql;
        private $params = [];
        private $result = null;

        public function __construct(PDO $pdo, string $sql) {
            $this->pdo = $pdo;
            $this->sql = $sql;
        }

        public function bind_param(string $types, &...$args) {
            $this->params = $args;
        }

        public function execute() {
            $stmt = $this->pdo->prepare($this->sql);
            $stmt->execute($this->params);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->result = new SQLiteMySQLiResult($rows);
            return true;
        }

        public function get_result() {
            return $this->result;
        }
    }
}

if (!class_exists('SQLiteMySQLiBridge')) {
    class SQLiteMySQLiBridge {
        private $pdo;
        public $connect_error = null;
        public $connect_errno = 0;
        public $error = '';
        public $affected_rows = 0;

        public function __construct(string $dbPath) {
            try {
                $this->pdo = new PDO('sqlite:' . $dbPath);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                $this->pdo->sqliteCreateFunction('CURDATE', function() { return date('Y-m-d'); });
                $this->pdo->sqliteCreateFunction('NOW', function() { return date('Y-m-d H:i:s'); });
            } catch (Exception $e) {
                $this->connect_error = $e->getMessage();
                $this->connect_errno = 1;
            }
        }

        public function query(string $sql) {
            $trimmed = strtoupper(trim($sql));
            if (str_starts_with($trimmed, 'SELECT') || str_starts_with($trimmed, 'PRAGMA')) {
                $stmt = $this->pdo->query($sql);
                if ($stmt === false) {
                    $err = $this->pdo->errorInfo();
                    $this->error = $err[2] ?? 'Query error';
                    return false;
                }
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return new SQLiteMySQLiResult($rows);
            } else {
                $affected = $this->pdo->exec($sql);
                if ($affected === false) {
                    $err = $this->pdo->errorInfo();
                    $this->error = $err[2] ?? 'Exec error';
                    return false;
                }
                $this->affected_rows = $affected;
                return true;
            }
        }

        public function prepare(string $sql) {
            return new SQLiteMySQLiStmt($this->pdo, $sql);
        }

        public function close() {
            return true;
        }
    }
}

mysqli_report(MYSQLI_REPORT_OFF);
$db = @new mysqli("localhost", "root", "", "startup");

if ($db->connect_errno) {
    // MySQL not reachable - fallback to SQLite database
    $sqlitePath = __DIR__ . '/startup.sqlite';
    $db = new SQLiteMySQLiBridge($sqlitePath);
}
?>
