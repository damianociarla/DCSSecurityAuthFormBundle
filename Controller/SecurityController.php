<?php

namespace DCS\Security\Auth\FormBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render($this->getParameter('dcs_security.auth.form.view'), [
            'last_username' => $lastUsername,
            'error'         => $error,
            'csrf'          => $this->getParameter('dcs_security.auth.form.csrf'),
        ]);
    }

    public function loginCheckAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}