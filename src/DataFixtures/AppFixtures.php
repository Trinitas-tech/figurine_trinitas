<?php

namespace App\DataFixtures;

use App\Entity\Figurine;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Jeu de données de démonstration : 3 utilisateurs et 14 figurines.
 *
 * Chargement : php bin/console doctrine:fixtures:load
 * Mot de passe de tous les comptes : Password123!
 */
class AppFixtures extends Fixture
{
    /** Mot de passe en clair commun aux comptes de démonstration */
    private const DEMO_PASSWORD = 'Password123!';

    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $users = $this->loadUsers($manager);
        $this->loadFigurines($manager, $users);

        $manager->flush();
    }

    /**
     * Crée les utilisateurs et retourne le tableau indexé par clé courte.
     *
     * @return array<string, User>
     */
    private function loadUsers(ObjectManager $manager): array
    {
        $usersData = [
            'amina' => ['Amina', 'Diallo', 'amina@figurinevie.be', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=400&q=80'],
            'lucas' => ['Lucas', 'Martin', 'lucas@figurinevie.be', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80'],
            'trinitas' => ['Trinitas', 'Ntirampeba', 'trinitas@figurinevie.be', 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=80'],
        ];

        $users = [];
        foreach ($usersData as $key => [$firstname, $lastname, $email, $imageName]) {
            $user = (new User())
                ->setFirstname($firstname)
                ->setLastname($lastname)
                ->setEmail($email)
                ->setImageName($imageName)
                ->setIsVerified(true);

            // Le mot de passe est toujours stocké haché
            $user->setPassword($this->passwordHasher->hashPassword($user, self::DEMO_PASSWORD));

            $manager->persist($user);
            $users[$key] = $user;
        }

        return $users;
    }

    /**
     * Crée les figurines et les répartit entre les utilisateurs.
     *
     * @param array<string, User> $users
     */
    private function loadFigurines(ObjectManager $manager, array $users): void
    {
        $figurinesData = [
            // [titre, description, image, propriétaire]
            ['Dark Vador et ses stormtroopers', "Figurines Hot Toys à l'échelle 1/6. Dark Vador surveille deux stormtroopers en pleine discussion. Photo prise en extérieur pour profiter de la lumière naturelle.", 'https://images.unsplash.com/photo-1608889825103-eb5ed706fc64?auto=format&fit=crop&w=900&q=80', 'trinitas'],
            ['Stormtrooper perdu dans le désert', "Minifigurine LEGO Stormtrooper laissant ses traces dans le sable. Une mise en scène toute simple mais que j'adore.", 'https://images.unsplash.com/photo-1472457897821-70d3819a0e24?auto=format&fit=crop&w=900&q=80', 'trinitas'],
            ['Batman - The Dark Knight', 'Figurine S.H.Figuarts de Batman, version The Dark Knight. Éclairage sombre pour coller à l\'ambiance de Gotham.', 'https://images.unsplash.com/photo-1531259683007-016a7b628fc3?auto=format&fit=crop&w=900&q=80', 'lucas'],
            ['Baby Groot dans le jardin', 'Petit Groot en résine, environ 15 cm. Il a trouvé sa place au milieu des plantes du jardin.', 'https://images.unsplash.com/photo-1559535332-db9971090158?auto=format&fit=crop&w=900&q=80', 'amina'],
            ['Minion Kevin', "Figurine Minion articulée, édition Moi, Moche et Méchant 3. Toujours de bonne humeur sur mon bureau.", 'https://images.unsplash.com/photo-1593085512500-5d55148d6f0d?auto=format&fit=crop&w=900&q=80', 'amina'],
            ['Grogu - The Mandalorian', "Peluche-figurine de Grogu (Baby Yoda) avec sa petite tunique. Un indispensable pour tout fan de The Mandalorian.", 'https://images.unsplash.com/photo-1601814933824-fd0b574dd592?auto=format&fit=crop&w=900&q=80', 'lucas'],
            ['Deadpool en garde', 'Figurine Deadpool Marvel Legends, katana en main. Fond noir pour faire ressortir le rouge du costume.', 'https://images.unsplash.com/photo-1608889175123-8ee362201f81?auto=format&fit=crop&w=900&q=80', 'trinitas'],
            ['Deadpool prend un selfie', "Une seconde figurine Deadpool, version chibi avec sa perche à selfie. Impossible de résister à sa tête.", 'https://images.unsplash.com/photo-1608889335941-32ac5f2041b9?auto=format&fit=crop&w=900&q=80', 'trinitas'],
            ['Pikachu géant', 'Grande figurine Pikachu photographiée lors d\'une convention. Pas la mienne, mais elle méritait une photo !', 'https://images.unsplash.com/photo-1609372332255-611485350f25?auto=format&fit=crop&w=900&q=80', 'amina'],
            ['Totoro', 'Figurine Totoro en vinyle souple, acquise lors d\'un voyage au Japon. Studio Ghibli pour toujours.', 'https://images.unsplash.com/photo-1611457194403-d3aca4cf9d11?auto=format&fit=crop&w=900&q=80', 'amina'],
            ['Spider-Man, Iron Man et Captain America', 'Trio de figurines Marvel en version chibi. Spider-Man est clairement la star de la collection.', 'https://images.unsplash.com/photo-1608889476561-6242cfdbf622?auto=format&fit=crop&w=900&q=80', 'lucas'],
            ['Stormtrooper à dos de tortue', 'Mise en scène humoristique : un stormtrooper qui part en patrouille sur une tortue. Photo macro dans le jardin.', 'https://images.unsplash.com/photo-1608889825205-eebdb9fc5806?auto=format&fit=crop&w=900&q=80', 'lucas'],
            ['Abbey Road version LEGO', 'Hommage à la célèbre pochette des Beatles avec des minifigurines LEGO, photographié sur un vrai passage piéton.', 'https://images.unsplash.com/photo-1585366119957-e9730b6d0f60?auto=format&fit=crop&w=900&q=80', 'amina'],
            ['Grogu en forêt', null, 'https://images.unsplash.com/photo-1618336753974-aae8e04506aa?auto=format&fit=crop&w=900&q=80', 'trinitas'],
        ];

        // Les dates de création sont étalées dans le temps pour rendre le « il y a ... » plus parlant
        $daysAgo = count($figurinesData);

        foreach ($figurinesData as [$title, $description, $imageName, $ownerKey]) {
            $figurine = (new Figurine())
                ->setTitle($title)
                ->setDescription($description)
                ->setImageName($imageName)
                ->setUser($users[$ownerKey]);

            $manager->persist($figurine);

            // Surcharge des dates posées par le PrePersist pour simuler un historique
            $createdAt = new \DateTimeImmutable(sprintf('-%d days', $daysAgo--));
            $figurine->setCreatedAt($createdAt)->setUpdatedAt($createdAt);
        }
    }
}
