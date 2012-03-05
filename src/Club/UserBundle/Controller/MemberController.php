<?php

namespace Club\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MemberController extends Controller
{
  /**
   * @Template()
   * @Route("/members/")
   */
  public function indexAction()
  {
    $em = $this->getDoctrine()->getEntityManager();
    $form = $this->createForm(new \Club\UserBundle\Form\UserQuery);

    $data = array();
    if ($this->getRequest()->getMethod() == 'POST') {
      $form->bindRequest($this->getRequest());
      if ($form->isValid()) $data = $form->getData();
    }

    $sort = isset($data['sort']) ? $data['sort'] : 'u.member_number';
    $users = $em->getRepository('ClubUserBundle:User')->getBySearch($data, $sort);

    return array(
      'form' => $form->createView(),
      'users' => $users
    );
  }

  /**
   * @Template()
   * @Route("/members/{id}")
   */
  public function showAction($id)
  {
    $em = $this->getDoctrine()->getEntityManager();
    $user = $em->find('ClubUserBundle:User', $id);

    return array(
      'user' => $user
    );
  }
}