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
 * Les figurines illustrent les lieux touristiques et les grandes figures
 * de l'histoire du Burundi. Les photos proviennent de Wikimedia Commons
 * (licences Creative Commons ou domaine public, crédits dans le README).
 *
 * Chargement : php bin/console doctrine:fixtures:load
 * Mot de passe de tous les comptes : Password123!
 */
class AppFixtures extends Fixture
{
    /** Mot de passe en clair commun aux comptes de démonstration */
    private const DEMO_PASSWORD = 'Password123!';

    /** Base des URL d'images Wikimedia Commons (redirige vers le fichier redimensionné) */
    private const COMMONS = 'https://commons.wikimedia.org/wiki/Special:FilePath/';

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
            // [titre, description, fichier Commons ou URL complète, propriétaire]
            ['Chutes de la Karera', "Les chutes de la Karera, dans la province de Rutana, forment un ensemble de six cascades au cœur d'une forêt luxuriante. Site naturel protégé et l'une des plus belles excursions du sud du pays.", 'Chutes_de_Karera_01.jpg', 'trinitas'],
            ['Plage du lac Tanganyika', "Paillotes et sable fin au bord du lac Tanganyika, à quelques minutes de Bujumbura. Le deuxième lac le plus profond du monde est le lieu de détente favori des habitants de la capitale.", 'Beach_in_Bujumbura.jpg', 'amina'],
            ['Bujumbura vue du lac', "La ville de Bujumbura s'étire entre les rives du lac Tanganyika et les collines. Au loin, les montagnes du Congo ferment l'horizon.", 'Bujumbura_%26_Lake_Tanganyika.JPG', 'lucas'],
            ['Source du Nil à Rutovu', "La source la plus méridionale du Nil se trouve à Rutovu, dans la province de Bururi. Une pyramide y a été érigée en 1938 par l'explorateur Burkhart Waldecker.", 'Source_du_Nill.jpg', 'trinitas'],
            ['Hippopotames de la Rusizi', "Le parc national de la Rusizi, aux portes de Bujumbura, abrite hippopotames, crocodiles et de nombreux oiseaux dans le delta de la rivière Rusizi.", 'Rusizi_NP_hippopotamus.jpg', 'lucas'],
            ['Cathédrale de Gitega', "Gitega, capitale politique du Burundi depuis 2019, abrite le Musée national et cette cathédrale en briques rouges typiques de la région.", 'Gitega_Church.JPG', 'amina'],
            ['Théiers de Teza', "Les plantations de thé de Teza, sur les hauteurs de la Kibira, offrent un paysage de collines d'un vert intense. Le thé est l'une des principales exportations du pays.", 'Le_th%C3%A9_du_teza_%C3%A0_kibira.jpg', 'trinitas'],
            ['Collines de Teza-Muramvya', "Entre Muramvya et la forêt de la Kibira, les collines cultivées descendent en terrasses vers la vallée. Le Burundi est surnommé le pays des mille collines.", 'Teza-Muramvya.jpg', 'amina'],
            ['Mausolée du prince Rwagasore', "Sur la colline de Vugizo, à Bujumbura, le mausolée du prince Louis Rwagasore, héros de l'indépendance assassiné en 1961, domine la ville et le lac.", 'Prince_Rwagasore_Tomb_-_Flickr_-_Dave_Proffer.jpg', 'lucas'],
            ['Pierre de Livingstone et Stanley', "À Mugere, cette pierre marque l'endroit où, selon la tradition, les explorateurs Livingstone et Stanley ont passé deux nuits en novembre 1871.", 'Livingstone_monument_burundi.jpg', 'trinitas'],
            ['Paysage de Rutana', "Collines, champs et nuages au-dessus de la province de Rutana. Un exemple des paysages ruraux qui font la beauté du Burundi.", 'Burundi_Rutana.jpg', 'amina'],
            ['Timbre Louis Rwagasore 1963', "Timbre du Royaume du Burundi émis en 1963 en hommage au prince Louis Rwagasore (1932-1961), Premier ministre et père de l'indépendance.", 'BDI_1963_MiNr0044A_pm_B002.jpg', 'lucas'],
            ['Cathédrale Regina Mundi', "La cathédrale Regina Mundi de Bujumbura, avec son clocher élancé, est le principal édifice religieux de la ville.", 'Cath%C3%A9drale_Regina_Mundi_de_Bujumbura%2C_2006.jpg', 'amina'],
            ['Melchior Ndadaye', "Melchior Ndadaye, premier président démocratiquement élu du Burundi en 1993, assassiné la même année. Il est célébré comme héros de la démocratie.", 'https://www.burundi-forum.org/wp-content/uploads/2019/10/bdi_burundi_ndadaye_2019.jpeg', 'trinitas'],
        ];

        // Les dates de création sont étalées dans le temps pour rendre le « il y a ... » plus parlant
        $daysAgo = count($figurinesData);

        foreach ($figurinesData as [$title, $description, $image, $ownerKey]) {
            // Un simple nom de fichier est complété en URL Wikimedia Commons
            $imageName = str_starts_with($image, 'http') ? $image : self::COMMONS . $image . '?width=900';

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
