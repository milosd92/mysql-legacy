<?php
/**
 * Created by PhpStorm.
 * User: danilov
 * Date: 4.6.16.
 * Time: 11.12
 */

/**
 * @var \Danilov\Legacy\MySQL
 */
$__mysql_link = null;

/**
 * Open a connection to a MySQL Server.
 *
 * @param string    $server
 * @param string    $username
 * @param string    $password
 * @param bool      $new_link
 * @param int       $client_flags
 *
 * @return \Danilov\Legacy\MySQL
 */
function mysql_connect($server, $username, $password, $new_link = false, $client_flags = 0)
{
    global $__mysql_link;

    $__mysql_link = new \Danilov\Legacy\MySQL($server, $username, $password, $new_link, $client_flags);

    return $__mysql_link;
}

/**
 * Returns the numerical value of the error message from previous MySQL operation.
 *
 * @param \Danilov\Legacy\MySQL $link_identifier [optional]
 *
 * @return int
 */
function mysql_errno($link_identifier = null)
{
    global $__mysql_link;

    if ($link_identifier !== null) {
        $errno = $link_identifier->getErrno();
    } else {
        /* @var $__mysql_link \Danilov\Legacy\MySQL */
        $errno = $__mysql_link->getErrno();
    }

    return $errno;
}