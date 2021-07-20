<?php

namespace App\Form;

use App\Repository\ChildFilterRepository;
use App\Entity\ChildFilter;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class ChildType extends AbstractType
{
 /**
 * @var ChildFilterRepository $childFilterRepository
 */
protected $childFilterRepository;



public function __construct(ChildFilterRepository $childFilterRepository)
{
    $this->childFilterRepository = $childFilterRepository;
}
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null, [
				
				'attr' => [
                'class' => 'form-control', 'placeholder' => 'ivanovivan@gmail.com', 'pattern'=>"^[A-Za-z0-9.]+@[a-z0-9.-]+\.[a-z]{2,4}$"
				
					
            ]])
            ->add('nickname', null, [
			
			'attr' => [
                'class' => 'form-control', 'placeholder' => 'Пользователь', 'pattern'=>"^[А-Яа-яa-zA-Z0-9]{3,15}$"
            ]])
            ->add('name', null, ['attr' => [
                'class' => 'form-control', 'placeholder' => 'Иван', 'pattern'=>"^[А-Яа-яa-zA-Z]{2,15}$"
            ]])
			 ->add('surname', null, ['attr' => [
                'class' => 'form-control', 'placeholder' => 'Иванов', 'pattern'=>"^[А-Яа-яa-zA-Z]{2,15}$"
            ]])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least 6 characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 18,
						'maxMessage' => 'Your password should 18 or less',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control', 'placeholder' => 'Пароль', 'pattern'=>"^[А-Яа-яa-zA-Z0-9]{6,18}$"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}