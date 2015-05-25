<?php

namespace Nutrivida\LojaBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\SecurityContext;

class DefaultController extends Controller
{
    
    /**
     * @Route("/", name="_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Route("/login", name="_login")
     * @Template()
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $errorMsg = "";
        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->set(SecurityContext::AUTHENTICATION_ERROR, "");
        }
        
        if (is_object($error)) {
            $errorMsg = $this->get("translator")->trans($error->getMessage());
        }

        return array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $errorMsg,
        );
    }

    
    /**
     * @Route("/sem/permissao", name="_sem_permissao")
     * @Template()
     */
    public function semPermissaoAction()
    {
        return array();
    }
    
}
