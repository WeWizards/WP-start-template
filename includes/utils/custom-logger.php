<?php

function wwzrds_logger( $log_file_name, $subject ) {
    $now = current_datetime();
    if ( is_array( $subject ) || is_object( $subject ) ) {
        $subject = json_encode( $subject, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
    }
    error_log( $subject );
    file_put_contents(
        WP_CONTENT_DIR . '/' . $log_file_name . '.log',
        PHP_EOL . $now->format('Ymd H:i:s') . PHP_EOL . $subject,
        FILE_APPEND
    );
}
