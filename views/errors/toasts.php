<div class="toasts-container"></div>
<?php $errors = App\Helper\Session::take('errors');
$message = App\Helper\Session::take('message');
if (isset($errors)) {
    if (is_string($errors)) {
        $errors = [$errors];
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo '<script>showToast({ type: "danger", title: "Error", message: "' . $error . '" })</script>';
        }
    }
}
if (isset($message)) {
    if (is_string($message)) {
        $message = [$message];
    }
    if (count($message) > 0) {
        foreach ($message as $msg) {
            echo '<script>showToast({ type: "success", title: "Success", message: "' . $msg . '" })</script>';
        }
    }
}
?>
