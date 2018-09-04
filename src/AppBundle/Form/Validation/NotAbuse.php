<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 9/4/2018
 * Time: 1:44 PM
 */

namespace AppBundle\Form\Validation;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotAbuse extends Constraint
{
    public $message = 'The string "{{ string }}" contains abusive words';

    public function validatedBy()
    {
        return parent::validatedBy();
    }

}