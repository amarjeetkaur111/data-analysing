public function test(){

$host = '10.8.1.31';
$user = 'testuser';
$workgroup = '';
$password = 'password';
$share = 'jsontest';

$auth = new \Icewind\SMB\BasicAuth($user, $workgroup, $password);
$serverFactory = new \Icewind\SMB\ServerFactory();

$server = $serverFactory->createServer($host, $auth);

$share = $server->getShare($share);

$shares = $server->listShares();
print_r($auth);exit;

}