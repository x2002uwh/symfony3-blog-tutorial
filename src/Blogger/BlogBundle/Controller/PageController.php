<?php
namespace Blogger\BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Form\EnquiryType;

class PageController extends Controller
{
    /**
     * Blog Home page
     * @Route("/", name="blog_homepage")
     */
    public function indexAction()
    {
        return $this->render('BloggerBlogBundle:Page:index.html.twig');
    }

    /**
     * Blog about page
     * @Route("/about", name="blog_about")
     * @return [type] [description]
     */
    public function aboutAction()
    {
        return $this->render('BloggerBlogBundle:Page:about.html.twig');
    }

    /**
     * Blog contact page
     * @Route("/contact", name="blog_contact")
     * @return [type] [description]
     */
    public function contactAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(EnquiryType::class, $enquiry);

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // Perform some action, such as sending an email

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('blog_contact'));
            }
        }

        return $this->render('BloggerBlogBundle:Page:contact.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Show a blog entry
     * @Route("/{id}", name="show_blog")
     * @return [type] [description]
     */
    public function showBlogAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $this->render('BloggerBlogBundle:Blog:show.html.twig', array(
            'blog' => $blog
        ));
    }
}
