<?php

namespace ApiBundle\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use ApiBundle\Controller\BaseController;
use ApiBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use ApiBundle\Form\UserType;
// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse; //por poner  

class MemberController extends BaseController
{
	 /**
     * @Route("/user")
     * @Method("GET")
     */
    public function getAllAction()
    {
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }
        $users = $this->getDoctrine()->getRepository('ApiBundle:User')->findAll();
        if (!$users) {
            $response = new Response(json_encode('no user in database'));
             return $response;
        }
        $data = array('users' => array());
        foreach ($users as $user) { $data['users'][] = $this->serializeUser($user); }
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/user/{id}", name="api_getOne_User")
     * @Method("GET")
     */
    public function getOneAction($id)
    {
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }
        $user = $this->getDoctrine()->getRepository('ApiBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException(sprintf(
                'No User found that User "%s"',
                $id
            ));
        }
        $data = $this->serializeUser($user);
        $response = new Response(json_encode($data), 200);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/user")
     * @Method("POST")
     */

    public function newAction(Request $request)
    {
        if (false === $this->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new AccessDeniedException();
        }
        $data = json_decode($request->getContent(), true);
        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $form->submit($data);
        // $user->setUser($this->findUserByUsername('weaverryan'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        // return new Response('It worked. Believe me - I\'m an API');
        return new Response(json_encode('User Created'));
    }

 /**
     * @Route("/user/{id}")
     * @Method("PUT")
     */
    public function updateAction($id, Request $request)
    {
            $user = $this->getDoctrine()->getRepository('ApiBundle:User')->find($id);
        if (!$user) {
            throw $this->createNotFoundException(sprintf(
                'No user found with id "%s"',
                $id
            ));
        }
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(new UserType(), $user);
        $form->submit($data);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $data = $this->serializeUser($user);
        $response = new JsonResponse($data, 200);
        return $response;
    }

    /**
     * @Route("/user/{username}")
     * @Method("PUT")
     */
    public function updateByUsernameAction($username, Request $request)
    {
        $user = $this->getDoctrine()->getRepository('ApiBundle:User')->findOneByUsername($username);
        if (!$user) {
            throw $this->createNotFoundException(sprintf( 'No user found with username "%s"', $username
            ));
        }
        $data = json_decode($request->getContent(), true);
        $form = $this->createForm(new UserType(), $user);
        $form->submit($data);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $data = $this->serializeUser($user);
        $response = new JsonResponse($data, 200);
        return $response;
    }

   /**
     * @Route("/user/{id}")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {
        $User = $this->getDoctrine()->getRepository('ApiBundle:User')->find($id);
        if ($User) { 
            $em = $this->getDoctrine()->getManager();
            $em->remove($User);
            $em->flush();
        }
        return new Response(null, 204);
    }
    private function serializeUser(User $user)
    {
        return array(
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
        );
    }
}
