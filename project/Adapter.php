<?php 
date_default_timezone_set("Asia/Kolkata");
class Adapter{
    public $config = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'dbname' => 'adapter'
    ];
    private $connect = NULL;

    public function connect()
    {
        $connect = mysqli_connect($this->config['host'],$this->config['user'],$this->config['password'],$this->config['dbname']);
        $this->setConnect($connect);
        return $connect;
    }

    public function setConnect($connect)
    {
        $this->connect = $connect;
        return $this;
    }

    public function getConnect()
    {
        return $this->connect;
    }

    public function setConfig($config)
    {
        $this->config = $config;
        return $config;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function query($query)
    {
        if(!$this->getConnect())
        {
            $this->connect();
        }
        $result = $this->getConnect()->query($query);
        return $result;
    }

    public function insert($query)
    {
        $result = $this->query($query);
        if($result)
        {
            return $this->getConnect()->insert_id;  //insert_id = to fetch the last id of last inserted data
        }
        return $result;
    }

    public function update($query)
    {
        $result = $this->query($query);
        return $result;
    }

    public function delete($query)
    {
        $result = $this->query($query);
        return $result;
    }

    public function fetchRow($query)
    {
        $result = $this->query($query);
        if($result->num_rows)
        {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function fetchAll($query)
    {
        $result = $this->query($query);
        if($result->num_rows)
        {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return false;
    }
}

$adapter = new Adapter();

?>