<?php

namespace ApiBundle\Controller;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class YourApiController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('ApiBundle:Default:index.html.twig');
    }
    /**
     * @Route("/test")
     */
	public function getSecureResourceAction()
    {
        # this is it
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }
        // [...]
    }
     /**
     * @Route("/clientgen")
     */
	public function getSecureResourceAction()
    {
	 //    $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');
		// $client = $clientManager->createClient();
		// $client->setRedirectUris(array('http://www.example.com'));
		// $client->setAllowedGrantTypes(array('token', 'authorization_code'));
		// $clientManager->updateClient($client);

		// return $this->redirect($this->generateUrl('fos_oauth_server_authorize', array(
		//     'client_id'     => $client->getPublicId(),
		//     'redirect_uri'  => 'http://www.example.com',
		//     'response_type' => 'code'
		// )));
	}
}
