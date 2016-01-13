<?php
# source:
# http://nl2.php.net/memcache
# markfrawley at gmail dot com

class Memcache {
    var $connections;
    var $_servers;

    function Memcache($servers) {
        $this->_servers = $servers;
        // Attempt to establish/retrieve persistent connections to all servers.
        // If any of them fail, they just don't get put into our list of active
        // connections.
        $this->connections = array();
        for ($i = 0, $n = count($servers); $i < $n; $i++) {
            $server = $servers[$i];
            $con = memcache_connect($server['host']);
            //memcache_debug(1);
            //$memcache = &new Memcache;
            //$con = $memcache->connect($server['host']);
            if (!($con == false)) {
                $this->connections[] = &$con;
            }
           
        }
    }

    function _getConForKey($key) {
        $hashCode = 0;
        for ($i = 0, $len = strlen($key); $i < $len; $i++) {
            $hashCode = (int)(($hashCode*33)+ord($key[$i])) & 0x7fffffff;
        }
        if (($ns = count($this->connections)) > 0) {
            return $this->connections[$hashCode%$ns];
            //return $this->connections[0];
        }
        return false;
    }

    function debug($on_off) {
        $result = false;
        for ($i = 0; $i < count($this->connections); $i++) {
            if ($this->connections[$i]->debug($on_off)) $result = true;
        }
        return $result;
    }

    function flush() {
        $result = false;
        for ($i = 0; $i < count($this->connections); $i++) {
            if ($this->connections[$i]->flush()) $result = true;
        }
        return $result;
    }

    /// The following are not implemented:
    ///getStats()
    ///getVersion()

    function get($key) {
        if (is_array($key)) {
            $dest = array();
            foreach ($key as $subkey) {
            $val = get($subkey);
            if (!($val === false)) $dest[$subkey] = $val;
            }
            return $dest;
        } else {
            $conn = &$this->_getConForKey($key);
            return $conn->get($key);
        }
    }

    function set($key, $var, $compress=0, $expire=0) {
        $conn = &$this->_getConForKey($key);
        return $conn->set($key, $var, $compress, $expire);
    }

    function add($key, $var, $compress=0, $expire=0) {
        $conn = &$this->_getConForKey($key);
        return $conn->add($key, $var, $compress, $expire);
    }

    function replace($key, $var, $compress=0, $expire=0) {
        $conn = &$this->_getConForKey($key);
        return $conn->replace($key, $var, $compress, $expire);
    }

    function delete($key, $timeout=0) {
        $conn = &$this->_getConForKey($key);
        return $conn->delete($key, $timeout);
    }

    function increment($key, $value=1) {
        $conn = &$this->_getConForKey($key);
        return $conn->increment($key, $value);
    }

    function decrement($key, $value=1) {
        $conn = &$this->_getConForKey($key);
        return $conn->decrement($key, $value);
    }

    function showStats($server=null) {
        $stats_out = '';
        if($server == null) {
            $i=0;
            foreach($this->connections as $conn) { 
                $server = $this->_servers[$i];
                $stats_array = memcache_get_stats($conn);
                $stats_out .= "</br><b>Server: ".$server['host'].": </b><br/>";
                foreach($stats_array as $key => $val) {
                    $stats_out .= "$key => $val <br/>";
                }  
                $i++;
            }
        }
        return $stats_out;
    }   
}
?>