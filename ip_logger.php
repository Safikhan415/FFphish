<?php
function log_visitor() {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
    $referrer = $_SERVER['HTTP_REFERER'] ?? 'Direct';
    $timestamp = date('Y-m-d H:i:s');
    
    $log_data = "$timestamp | IP: $ip | Agent: $user_agent | Referrer: $referrer\n";
    
    file_put_contents('data/ip_log.txt', $log_data, FILE_APPEND);
    file_put_contents('data/ips.txt', "$ip\n", FILE_APPEND);
    
    // Also log to access log
    file_put_contents('logs/access.log', "$timestamp - $ip - $user_agent\n", FILE_APPEND);
}
?>