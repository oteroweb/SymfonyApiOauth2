<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/hola")
     */
    public function indexAction()
    {


    	$clientManager = $this->get('fos_oauth_server.client_manager.default');
$client = $clientManager->createClient();
$client->setRedirectUris(array('http://www.example.com'));
$client->setAllowedGrantTypes(array('password'));
$client->setAllowedGrantTypes(array('token', 'authorization_code'));
$clientManager->updateClient($client);

return var_dump($client->getPublicId());
// return $this->redirect($this->generateUrl('fos_oauth_server_authorize', array(
//     'client_id'     => $client->getPublicId(),
//     'redirect_uri'  => 'http://www.example.com',
//     'response_type' => 'code'
// )));

        // return $this->render('ApiBundle:Default:index.html.twig');
    }
public function getSecureResourceAction()
    {
        # this is it
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }

        // [...]
    }
}
