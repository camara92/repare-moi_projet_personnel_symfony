<?php

namespace App\DataFixtures;

use App\Entity\Blogpost;
use App\Entity\Categorie;
use App\Entity\Peinture;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{


    public function load(ObjectManager $manager,): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $user = new User();
        $user->setEmail($faker->Email())
            ->setPrenom($faker->firstName())
            ->setNom($faker->lastName())
            ->setTelephone($faker->phoneNumber())
            ->setAPropos($faker->text())
            ->setInstagram('instagram')
            ->setPassword('daouda');
        $manager->persist($user);

        for ($i=0; $i <= 15; $i++) {
            $blogpost = new Blogpost();
            $blogpost->setTitre($faker->word(3, true))
                ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                ->setContenu($faker->text(350))
                ->setSlug($faker->slug())
                ->setUser($user)
                ;

            $manager->persist($blogpost);
        }
        for ($i=0; $i <= 6; $i++) {
            $categorie = new Categorie();
            $categorie->setNom($faker->word(3, true))
                ->setDescription($faker->words(10, true))
                ->setSlug($faker->slug())
                
                ;
            // creation de peinture par categorie 
            $manager->persist($categorie);
            for($p=0; $p<=3; $p++){
                $peinture = new Peinture();
                $peinture-> setNom($faker->userName())
                ->setLargeur($faker->randomFloat(2,20,60))
                ->setHauteur($faker->randomFloat(2,20,60))
                ->setEnVente($faker->randomElement([true, false]))
                ->setDateRealisation($faker->dateTimeBetween('-6 month', 'now'))
                ->setCreatedAt($faker->dateTimeBetween('-6 month', 'now'))
                ->setDescription($faker->text())
                ->setPortefolio($faker->randomElement([true, false]))
                ->setSlug($faker->slug())
                ->setFile("https://picsum.photos/200/300")
                ->addCategorie($categorie)
                ->setPrix($faker->randomFloat(2,100,9999))
                ->setUser($user)
                ;
    
                $manager->persist($peinture); 
            }
        }



        $manager->flush();
    }
}
