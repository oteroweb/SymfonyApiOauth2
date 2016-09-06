<?php  
namespace ApiBundle\Controller;  
use FOS\RestBundle\Controller\FOSRestController;  

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\View\View;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use ApiBundle\Entity\User;
use ApiBundle\Repository\UserRepository;
use ApiBundle\Form\UserType;


class UserController extends FOSRestController   implements ClassResourceInterface 
{ 

    // private $manager;
    private $manager;

    private $repo;
    // private $repo = "UserRepository";

    private $formFactory;
    // private $formFactory = "FormFactoryInterface";

    private $router;
    // private $router = "RouterInterface";

    /**
     * Controller constructor
     * @var ObjectManager $manager
     * @var UserRepository $repo
     * @var FormFactoryInterface $formFactory
     * @var RouterInterface $router
     */
    public function __construct(ObjectManager $manager, UserRepository $repo, FormFactoryInterface $formFactory, RouterInterface $router)
    {
        $this->manager = $manager;
        $this->repo = $repo;
        $this->formFactory = $formFactory;
        $this->router = $router;
    }
    /**
     * Retrieve all users
     * @return Collection
     *
     * @Rest\View()
     */
    public function cgetAction()
    {   
        $user = $this->repo->findAll();
        return $user;
    }
   /**
     * Retrieve an user
     * @var user $user
     * @return User
     *
     * @Rest\View()
     */
    public function getAction(User $user)
    {
        return $user;
    }

    // /**

   /**
     * Create an user
     * @var Request $request
     * @return View|FormInterface
     * @Rest\View()   //falla al mandar por post no se porque resuelta en el otro codigo bien
     */
    public function cpostAction(Request $request)
    {
        $user = new User();
        $form = $this->formFactory->createNamed('', new UserType(), $user)->add('submit','submit');
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->manager->persist($user);
            $this->manager->flush($user);

            $url = $this->router->generate(
                'get_user',
                array('user' => $user->getId())
            );
            return View::createRedirect($url, Codes::HTTP_CREATED);
        }

        return $form;


    }


    /**
     * Update an user
     * @var User $user
     * @var Request $request
     * @return View|FormInterface
     * @Rest\View()
     */
    public function putAction(User $user, Request $request)
    {
        $form = $this->formFactory->createNamed('', new UserType(), $user, array('method' => 'PUT'));
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->manager->flush($user);

            return View::create(null, Codes::HTTP_NO_CONTENT);
        }

        return $form;
    }

    /**
     * Delete an user
     * @var User $user
     * @return View
     */
    public function deleteAction(User $user)
    {
        $this->manager->remove($user);
        $this->manager->flush($user);

        return View::create(null, Codes::HTTP_NO_CONTENT);
    }



}

