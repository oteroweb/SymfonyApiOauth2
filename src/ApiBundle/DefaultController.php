<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/create_token")
     */
    public function indexAction()
    {


    	$clientManager = $this->get('fos_oauth_server.client_manager.default');
$client = $clientManager->createClient();
$client->setRedirectUris(array('http://212.24.97.144/'));
$client->setAllowedGrantTypes(array('password'));
// $client->setAllowedGrantTypes(array('token', 'authorization_code'));
$clientManager->updateClient($client);

// return var_dump("your public id", $client->getPublicId());
return new Response("your client id ".$client->getRandomId()."<br>secret_id ".$client->getSecret().
    "<br>public id ".$client->getPublicId()
    // ."secret_id ". $secret->getRandomId()
);
// return new Response("your client",var_dump($client));
// return new Response("your public id");
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
