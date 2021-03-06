--TEST--
Test for Xdebug's remote log (can not connect, no remote callback)
--SKIPIF--
<?php
require __DIR__ . '/../utils.inc';
check_reqs('dbgp; !win');
?>
--INI--
xdebug.remote_enable=1
xdebug.remote_log=/tmp/{RUNID}remote-log1.txt
xdebug.remote_log_level=20
xdebug.remote_autostart=1
xdebug.remote_connect_back=0
xdebug.remote_host=doesnotexist
xdebug.remote_port=9002
--FILE--
<?php
echo strlen("foo"), "\n";
echo file_get_contents(sys_get_temp_dir() . '/' . getenv('UNIQ_RUN_ID') . 'remote-log1.txt' );
unlink (sys_get_temp_dir() . '/' . getenv('UNIQ_RUN_ID') . 'remote-log1.txt' );
?>
--EXPECTF--
3
[%d] Log opened at %d-%d-%d %d:%d:%d
[%d] I: Connecting to configured address/port: doesnotexist:9002.
[%d] W: Creating socket for 'doesnotexist:9002', getaddrinfo: %s.
[%d] E: Could not connect to client. :-(
[%d] Log closed at %d-%d-%d %d:%d:%d

[%d] Log opened at %d-%d-%d %d:%d:%d
[%d] I: Connecting to configured address/port: doesnotexist:9002.
[%d] W: Creating socket for 'doesnotexist:9002', getaddrinfo: %s.
[%d] E: Could not connect to client. :-(
[%d] Log closed at %d-%d-%d %d:%d:%d
