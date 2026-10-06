# FigurineVie – figurine_trinitas

Application web Symfony permettant aux collectionneurs de partager et d'organiser
les photos de leurs figurines. Projet réalisé dans le cadre de la formation
développeur web (Cfitech).

- **Front-end** : Twig + Bootstrap 5 + CSS personnalisé (`assets/styles/app.css`), charte graphique reprise du portfolio de l'auteur (Poppins, dégradé nuit → turquoise → citron, cartes translucides, mise en page pleine largeur)
- **Back-end** : Symfony 7.4 (PHP 8.3)
- **Base de données** : MySQL (`figurine_trinitas_db`)

## Installation

```bash
# 1. Dépendances
composer install

# 2. Base de données (adapter DATABASE_URL dans .env ou .env.local si besoin)
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate --no-interaction

# 3. Données de démonstration (3 utilisateurs, 14 figurines)
php bin/console doctrine:fixtures:load --no-interaction

# 4. Serveur de développement
symfony serve
# ou : php -S 127.0.0.1:8000 -t public
```

Un export complet de la base (`figurine_trinitas_db.sql`) se trouve à la racine
du projet et peut être importé directement dans phpMyAdmin ou via :

```bash
mysql -u root figurine_trinitas_db < figurine_trinitas_db.sql
```

## Comptes de démonstration

| Email                     | Mot de passe   | Figurines |
|---------------------------|----------------|-----------|
| amina@figurinevie.be      | `Password123!` | 5         |
| lucas@figurinevie.be      | `Password123!` | 4         |
| trinitas@figurinevie.be   | `Password123!` | 5         |

## Structure

### Entités (`src/Entity`)

| Entité     | Table       | Propriétés                                                                 |
|------------|-------------|----------------------------------------------------------------------------|
| `Figurine` | `figurines` | title (100), description (text, nullable), imageName (500), createdAt, updatedAt, user |
| `User`     | `users`     | email (identifiant), password (haché), roles, firstname (50), lastname (50), imageName (500), isVerified, createdAt, updatedAt |

- Relation : un utilisateur possède 0 à plusieurs figurines, une figurine appartient à un seul utilisateur (`ManyToOne` / `OneToMany`, suppression en cascade).
- `createdAt` / `updatedAt` sont gérés automatiquement par le trait `App\Entity\Trait\TimestampableTrait` (callbacks `PrePersist` / `PreUpdate`).
- Choix retenu pour `imageName` : **URL d'image** (plutôt que VichUploader), ce qui évite la gestion de fichiers sur le serveur.

### Contrôleurs et routes

| Contrôleur               | Méthode           | Route                   | Nom                    |
|--------------------------|-------------------|-------------------------|------------------------|
| `HomeController`         | `home`            | `/`                     | `app_home`             |
| `FigurineController`     | `index`           | `/figurine`             | `app_figurine_index`   |
|                          | `create`          | `/figurine/create`      | `app_figurine_create`  |
|                          | `show`            | `/figurine/{id}`        | `app_figurine_show`    |
|                          | `edit`            | `/figurine/{id}/edit`   | `app_figurine_edit`    |
|                          | `delete`          | `/figurine/{id}/delete` | `app_figurine_delete`  |
| `SecurityController`     | `login`           | `/login`                | `app_login`            |
|                          | `logout`          | `/logout`               | `app_logout`           |
| `RegistrationController` | `register`        | `/register`             | `app_register`         |
|                          | `verifyUserEmail` | `/verify/email`         | `app_verify_email`     |
| `AccountController`      | `show`            | `/account`              | `app_account`          |
|                          | `edit`            | `/account/edit`         | `app_account_edit`     |

### Templates (`templates/`)

- `base.html.twig` : layout commun, affichage des messages flash
- `partials/_navbar.html.twig` et `partials/_footer.html.twig`
- `home/home.html.twig` : page d'accueil
- `figurine/index|show|create|edit|_form.html.twig`
- `security/login.html.twig`, `registration/register.html.twig`
- `account/show|edit.html.twig`

## Sécurité et validation

- Seuls les utilisateurs connectés accèdent aux figurines et au profil (`access_control` dans `config/packages/security.yaml`) ; toute tentative non autorisée redirige vers `/login`.
- Un utilisateur ne peut modifier / supprimer que ses propres figurines (`App\Security\FigurineVoter`).
- Suppression protégée par un jeton CSRF et une confirmation JavaScript.
- Validation : titre obligatoire (3 à 100 caractères, mot « spam » interdit), description optionnelle, URL d'image valide, email unique, mot de passe de 6 caractères minimum.
- Messages flash : création / modification réussie (vert), suppression réussie (rouge), connexion « Bienvenue prénom » et inscription réussie (bleu), erreurs en rouge.

## Autres éléments

- `App\Twig\AgoExtension` : filtre `ago` (« il y a 3 jours ») utilisé dans la liste des figurines.
- `App\EventSubscriber\LoginSubscriber` : message de bienvenue après connexion.
- `src/DataFixtures/AppFixtures.php` : jeu de données de démonstration.
