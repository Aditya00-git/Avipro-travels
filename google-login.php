<?php
require_once __DIR__ . '/config.php';
header('Content-Type: application/json; charset=utf-8');

// Accept POST JSON { id_token: "...", OR access_token: "..."}
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(['success' => false, 'message' => 'No input']);
    exit;
}

// your google client id from config.php
global $google_client_id;

function fetch_json($url, $post=false) {
    $opts = ['http' => ['method'=> $post ? 'POST' : 'GET']];
    $context = stream_context_create($opts);
    $res = @file_get_contents($url, false, $context);
    return $res ? json_decode($res, true) : null;
}

$userinfo = null;

// prefer id_token verification if provided
if (!empty($input['id_token'])) {
    $id_token = $input['id_token'];
    // verify using Google's tokeninfo endpoint
    $tokeninfo = fetch_json("https://oauth2.googleapis.com/tokeninfo?id_token=" . urlencode($id_token));
    if (!$tokeninfo || empty($tokeninfo['aud'])) {
        echo json_encode(['success'=>false,'message'=>'Invalid id_token']);
        exit;
    }
    // check audience
    if ($tokeninfo['aud'] !== $google_client_id) {
        echo json_encode(['success'=>false,'message'=>'Token audience mismatch']);
        exit;
    }
    // tokeninfo contains email, name, picture, sub
    $userinfo = [
        'sub' => $tokeninfo['sub'] ?? null,
        'email' => $tokeninfo['email'] ?? null,
        'name' => $tokeninfo['name'] ?? null,
        'picture' => $tokeninfo['picture'] ?? null
    ];
}

// else accept access_token (obtained via oauth2 token client)
elseif (!empty($input['access_token'])) {
    $access = $input['access_token'];
    // use people api or tokeninfo/userinfo endpoint
    $res = fetch_json("https://www.googleapis.com/oauth2/v3/userinfo?access_token=" . urlencode($access));
    if (!$res || empty($res['sub'])) {
        echo json_encode(['success'=>false,'message'=>'Invalid access token']);
        exit;
    }
    $userinfo = [
        'sub' => $res['sub'],
        'email' => $res['email'],
        'name' => $res['name'] ?? '',
        'picture' => $res['picture'] ?? ''
    ];
} else {
    echo json_encode(['success'=>false,'message'=>'No token provided']);
    exit;
}

// must have email
if (empty($userinfo['email'])) {
    echo json_encode(['success'=>false,'message'=>'No email returned by Google']);
    exit;
}

// insert or update user in DB
try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $userinfo['email']]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        $stmt = $conn->prepare("UPDATE users SET google_id = :gid, name = :name, picture = :pic, last_login = NOW() WHERE id = :id");
        $stmt->execute([
            'gid' => $userinfo['sub'],
            'name'=> $userinfo['name'],
            'pic' => $userinfo['picture'],
            'id'  => $existing['id']
        ]);
        $userId = $existing['id'];
    } else {
        $stmt = $conn->prepare("INSERT INTO users (google_id, email, name, picture) VALUES (:gid, :email, :name, :pic)");
        $stmt->execute([
            'gid' => $userinfo['sub'],
            'email' => $userinfo['email'],
            'name' => $userinfo['name'],
            'pic' => $userinfo['picture']
        ]);
        $userId = $conn->lastInsertId();
    }

    // set session
    $_SESSION['user_id'] = $userId;
    $_SESSION['user_email'] = $userinfo['email'];
    $_SESSION['user_name'] = $userinfo['name'];
    $_SESSION['user_picture'] = $userinfo['picture'];

    echo json_encode(['success'=>true, 'message'=>'Logged in', 'email'=>$userinfo['email']]);
    exit;

} catch (Exception $e) {
    echo json_encode(['success'=>false,'message'=>'DB error: '.$e->getMessage()]);
    exit;
}
