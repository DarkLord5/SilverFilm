<?php

namespace App\Form;

use App\Repository\JanreRepository;
use App\Entity\ChildFilter;
use App\Entity\Janre;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class FilterType extends AbstractType
{
	
	

/**
 * @var JanreRepository $janreRepository
 */
protected $janreRepository;



public function __construct(JanreRepository $janreRepository)
{
    $this->janreRepository = $janreRepository;
}
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('max_year', null, [
			'required' => false,
			'attr' => [
                'placeholder' => '2000', 'pattern'=>"^[0-9]{4}$"
            ]])
			
			 ->add('max_age_limit', null, [
			 'required' => false,
			
				'attr' => [
                 'placeholder' => '18', 'pattern'=>"^[0-9]{1,2}$"
			]])
			
			
			->add('janre_filter_id', EntityType::class, [
            'class' => Janre::class,
            'choices'  => $this->janreRepository->findAll(),
            'choice_label' => 'janreName',
            'required' => false,
            'multiple' => true,
            'expanded' => true
        ]);
			
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ChildFilter::class,
        ]);
    }

}