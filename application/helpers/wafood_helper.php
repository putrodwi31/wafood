<?php
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        $ci->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade" role="alert">Silahkan login terlebih dahulu!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        redirect('auth');
    }
}
