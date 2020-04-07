<?php


namespace App\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class UserRegistrationFormModel
{
    /**
    * @Assert\NotBlank(message="Veuillez saisir une adresse e-mail")
    * @Assert\Email(message="Veuillez saisir une adresse e-mail valide")
     */
    public $email;

    /**
     * @Assert\NotBlank(message="Veuillez saisir un mot de passe")
     * @Assert\Length(min="5", minMessage="Votre mot de passe doit contenir au minimum 5 caractères !")
     */
    public $plainPassword;

    /**
     * @Assert\IsTrue(message="Vous devez accepter les conditions d'utilisation pour vous inscrire")
     */
    public $agreeTerms;
}