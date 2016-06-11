<?php

namespace Danilov\Legacy;

class MySQL
{

    private $host;
    private $username;
    private $password;
    private $port;
    private $new_link;
    private $client_flags;

    private static $connection = null;

    /**
     * @var \mysqli
     */
    private $db;

    /**
     * Open a connection to a MySQL Server
     *
     * @TODO - Add default values
     * @TODO - Add case for ini_get("mysql.default_")
     *
     * @param string $server
     * @param string $username
     * @param string $password
     * @param bool $new_link
     * @param int $client_flags
     */
    public function __construct($server, $username, $password, $new_link = false, $client_flags = 0)
    {
        $server = explode(':', $server);

        $this->host = $server[0];
        $this->port = array_key_exists(1, $server) ? $server[1] : 3306;

        $this->username = $username;
        $this->password = $password;
        $this->new_link = $new_link;
        $this->client_flags = $client_flags;

        $this->connect();
    }

    protected function connect()
    {
        $this->db = new \mysqli($this->host, $this->username, $this->password, '', $this->port, '');
    }

    /**
     * Open a connection to a MySQL Server.
     *
     * @TODO - revisit this, need to create a proper getConnection
     *
     * @param string $server
     * @param string $username
     * @param string $password
     * @param bool $new_link
     * @param int $client_flags
     *
     * @return MySQL
     */
    public static function getConnection($server, $username, $password, $new_link = false, $client_flags = 0)
    {
        if (self::$connection === null) {
            self::$connection = new self($server, $username, $password, $new_link, $client_flags);
        }

        return self::$connection;
    }

    /**
     * Returns the numerical value of the error message from previous MySQL operation
     *
     * @return int the error number from the last MySQL function, or
     * 0 (zero) if no error occurred.
     */
    public function getErrno()
    {
        if ($this->db->connect_errno > 0) {
            return $this->db->connect_errno;
        } else {
            return $this->db->errno;
        }
    }

    /**
     * Returns the text of the error message from previous MySQL operation
     *
     * @return string the error text from the last MySQL function, or
     * '' (empty string) if no error occurred.
     */
    public function getError()
    {
        if ($this->db->connect_errno > 0) {
            return $this->db->connect_error;
        } else {
            return $this->db->error;
        }
    }

    /**
     * Close MySQL connection
     *
     * @return bool true on success or false on failure.
     */
    public function close()
    {
        return $this->db->close();
    }

}
