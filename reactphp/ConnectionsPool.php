<?php

class ConnectionsPool
{
    protected $connections;

    public function __construct()
    {
        $this->connections = new SplObjectStorage();
    }

    public function add(\React\Socket\ConnectionInterface $connection) {
        $connection->write("Enter your name: ");
        $this->setConnectionName($connection, '');

        $this->initEvents($connection);
    }

    public function sendMessage(\React\Socket\ConnectionInterface $connection, $message) {
        $name = $this->getConnectionName($connection);
        if (empty($name)) {
            return;
        }

        $this->sendAll($name.": ".$message, $connection);
    }

    private function initEvents(\React\Socket\ConnectionInterface $connection)
    {
        $connection->on('data', function ($data) use ($connection) {
            $name = $this->getConnectionName($connection);
            if (empty($name)) {
                $this->addNewMember($connection, $data);
                return;
            }
            $this->sendAll($name.": ".$data, $connection);
        });

        $connection->on('close', function () use ($connection) {
            $name = $this->getConnectionName($connection);
            $this->connections->offsetUnset($connection);
            $this->sendAll('User '.$name.' chat \n', $connection);
        });
    }

    private function addNewMember(\React\Socket\ConnectionInterface $connection, $name)
    {
        $name = str_replace(["\n", "\r"], '', $name);
        $this->setConnectionName($connection, $name);
        $this->sendAll('User '. $name. ' joined chat \n', $connection);
    }

    private function getConnectionName(\React\Socket\ConnectionInterface $connection) {
        return $this->connections->offsetGet($connection);
    }

    private function setConnectionName(\React\Socket\ConnectionInterface $connection, $name) {
        $this->connections->offsetSet($connection, $name);
    }

    private function sendAll($message, \React\Socket\ConnectionInterface $connection) {
        foreach ($this->connections as $conn) {
            if ($conn !== $connection) {
                $conn->write($message);
            }
        }
    }
}
