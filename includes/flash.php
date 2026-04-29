<?php

function startFlashSession()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function setFlashMessage($type, $message)
{
    startFlashSession();
    $_SESSION['flash_message'] = [
        'type' => $type,
        'message' => $message,
    ];
}

function getFlashMessage()
{
    startFlashSession();

    if (empty($_SESSION['flash_message'])) {
        return null;
    }

    $message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);

    return $message;
}

function renderFlashMessage()
{
    $flash = getFlashMessage();

    if (!$flash) {
        return;
    }

    $type = $flash['type'] === 'success' ? 'success' : 'error';
    $message = htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8');
    $title = htmlspecialchars($type === 'success' ? 'Message Sent' : 'Please Check', ENT_QUOTES, 'UTF-8');
    $icon = $type === 'success' ? '&#10003;' : '!';

    echo '<div class="form-dialog-overlay">';
    echo '<div class="form-dialog form-dialog-' . $type . '" role="dialog" aria-modal="true" aria-labelledby="form-dialog-title">';
    echo '<div class="form-dialog-icon" aria-hidden="true">' . $icon . '</div>';
    echo '<h3 id="form-dialog-title">' . $title . '</h3>';
    echo '<p>' . $message . '</p>';
    echo '<button type="button" class="btn btn-primary form-dialog-ok" onclick="window.location.reload()">OK</button>';
    echo '</div>';
    echo '</div>';
}
