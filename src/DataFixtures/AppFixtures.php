<?php

namespace App\DataFixtures;

use App\Entity\Carte;
use App\Entity\CarteStatus;
use App\Entity\Compte;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $dataStatus = [
            ['name' => 'Actif'],
            ['name' => 'Fermé'],
            ['name' => 'Volé'],
        ];

        foreach ($dataStatus as $ds) {
            $status = new CarteStatus();
            $status->setName($ds['name']);

            $manager->persist($status);
            $manager->flush();
        }

        $dataUsers = [
            ['nom' => 'Ricciardo', 'prenom' => 'Daniel', 'date_naissance' => date_create('1989-07-01'), 'email' => 'honey.badger@fia.com', 'comptes' => 2],
            ['nom' => 'Gasly', 'prenom' => 'Pierre', 'date_naissance' => date_create('1996-02-07'), 'email' => 'pierrot-monza2020@fia', 'comptes' => 1],
            ['nom' => 'Ricciardo', 'prenom' => 'Daniel', 'date_naissance' => date_create('1987-07-03'), 'email' => 'babyschumy@fia.com', 'comptes' => 1],
        ];

        foreach ($dataUsers as $ds) {
            $user = new User();
            $user->setNom($ds['nom']);
            $user->setPrenom($ds['prenom']);
            $user->setDateNaissance($ds['date_naissance']);
            $user->setEmail($ds['email']);

            $manager->persist($user);

            $status = $manager->getRepository(CarteStatus::class)->findOneBy(array('name' => 'Actif'));

            for ($i = 1; $i <= $ds['comptes']; $i++) {

                $numbers = '01234567891011121314151617181920212223242526272829303132333435363738394041424344454647484950';
                $letters = 'ABCDEFGHIJKLMNOPQRSTUVWYZ';

                $randomNumbers = str_shuffle($numbers);
                $randomLetters = str_shuffle($letters);
                $randomAll = str_shuffle($letters . $numbers);


                $iban = 'FR' . substr($randomNumbers, 0, 29);
                $bic = substr($randomLetters . $randomNumbers, 0, 10);

                $compte = new Compte();
                $compte->setUser($user);
                $compte->setIban($iban);
                $compte->setBic($bic);
                $compte->setReference(substr($randomAll, 0, 10));
                $compte->setBalance(rand(0, 10000));
                $manager->persist($compte);


                $randomAll = str_shuffle($letters . $numbers);
                $numero = substr($randomNumbers, 0, 16);
                $carte = new Carte();
                $carte->setNumero($numero);
                $carte->setStatus($status);
                $carte->setDateExpiration(new \DateTime());
                $carte->setReferenceCarte(substr($randomAll, 0, 15));
                $carte->setCompte($compte);
                $manager->persist($carte);
            }
        }

        $manager->flush();
    }
}
