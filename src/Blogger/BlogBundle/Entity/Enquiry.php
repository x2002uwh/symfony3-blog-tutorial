<?php

namespace Blogger\BlogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Enquiry
 */
class Enquiry
{
    /**
      * @Assert\NotBlank()
      */
    private $name;

    /**
     * @Assert\Email(
     *     message = "symblog does not like invalid emails. Give me a real one!",
     *     checkMX = true
     * )
     */
    private $email;

    /**
      * @Assert\NotBlank()
      * @Assert\Length(
      *      max = 50,
      *      maxMessage = "The subject cannot be longer than {{ limit }} characters"
      * )
      */
    private $subject;

    /**
     * @Assert\Length(
     *      min = 50,
     *      minMessage = "The body must be at least {{ limit }} characters long"
     * )
    */
    private $body;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }
}
