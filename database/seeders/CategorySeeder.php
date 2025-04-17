<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Faker\Factory;

class CategorySeeder extends Seeder
{
    public function run(): void
    {

        $categories = [
            [
                'fr' => 'Construction résidentielle',
                'en' => 'Residential Construction',
                'fr_description' => 'Conception et construction de maisons individuelles, d\'appartements et de logements collectifs pour répondre aux besoins résidentiels.',
                'en_description' => 'Design and construction of single-family homes, apartments, and multi-family dwellings to meet residential needs.'
            ],
            [
                'fr' => 'Construction commerciale',
                'en' => 'Commercial Construction',
                'fr_description' => 'Réalisation de bâtiments commerciaux tels que des bureaux, des centres commerciaux et des espaces de vente au détail.',
                'en_description' => 'Construction of commercial buildings such as offices, shopping centers, and retail spaces.'
            ],
            [
                'fr' => 'Construction industrielle',
                'en' => 'Industrial Construction',
                'fr_description' => 'Création d\'installations industrielles, d\'usines et d\'entrepôts pour soutenir les activités de production et de fabrication.',
                'en_description' => 'Creation of industrial facilities, factories, and warehouses to support production and manufacturing activities.'
            ],
            [
                'fr' => "Construction d'infrastructures",
                'en' => 'Infrastructure Construction',
                'fr_description' => 'Développement et réalisation de projets d\'infrastructure tels que les routes, les ponts et les systèmes de transport public.',
                'en_description' => 'Development and implementation of infrastructure projects such as roads, bridges, and public transportation systems.'
            ],
            [
                'fr' => 'Rénovation',
                'en' => 'Renovation',
                'fr_description' => 'Modernisation et amélioration de bâtiments existants pour les adapter aux normes actuelles et aux nouveaux besoins.',
                'en_description' => 'Modernization and improvement of existing buildings to meet current standards and new requirements.'
            ],
            [
                'fr' => 'Aménagement intérieur',
                'en' => 'Interior Design',
                'fr_description' => 'Conception et réalisation d\'espaces intérieurs fonctionnels et esthétiques pour les bâtiments résidentiels et commerciaux.',
                'en_description' => 'Design and implementation of functional and aesthetic interior spaces for residential and commercial buildings.'
            ],
            [
                'fr' => 'Aménagement paysager',
                'en' => 'Landscape Design',
                'fr_description' => 'Création et entretien d\'espaces extérieurs attrayants et durables pour les propriétés résidentielles et commerciales.',
                'en_description' => 'Creation and maintenance of attractive and sustainable outdoor spaces for residential and commercial properties.'
            ],
            [
                'fr' => 'Gestion de projets',
                'en' => 'Project Management',
                'fr_description' => 'Coordination et supervision de l\'ensemble du processus de construction, de la planification à l\'exécution.',
                'en_description' => 'Coordination and supervision of the entire construction process, from planning to execution.'
            ],
            [
                'fr' => 'Construction durable',
                'en' => 'Sustainable Building',
                'fr_description' => 'Mise en œuvre de pratiques de construction respectueuses de l\'environnement et économes en énergie.',
                'en_description' => 'Implementation of environmentally friendly and energy-efficient construction practices.'
            ],
            [
                'fr' => 'Urbanisme',
                'en' => 'Urban Planning',
                'fr_description' => 'Planification et développement de zones urbaines pour créer des communautés durables et fonctionnelles.',
                'en_description' => 'Planning and development of urban areas to create sustainable and functional communities.'
            ],
            [
                'fr' => 'Architecture',
                'en' => 'Architecture',
                'fr_description' => 'Conception et design de bâtiments et de structures, alliant esthétique et fonctionnalité.',
                'en_description' => 'Design and planning of buildings and structures, combining aesthetics and functionality.'
            ],
            [
                'fr' => 'Ingénierie',
                'en' => 'Engineering',
                'fr_description' => 'Application de principes scientifiques et mathématiques pour résoudre des problèmes techniques dans la construction.',
                'en_description' => 'Application of scientific and mathematical principles to solve technical problems in construction.'
            ],
            [
                'fr' => 'Conseil',
                'en' => 'Consulting',
                'fr_description' => 'Fourniture d\'expertise et de conseils professionnels sur divers aspects de l\'industrie de la construction.',
                'en_description' => 'Provision of expertise and professional advice on various aspects of the construction industry.'
            ],
            [
                'fr' => 'Immobilier',
                'en' => 'Real Estate',
                'fr_description' => 'Achat, vente et développement de propriétés immobilières pour des fins résidentielles ou commerciales.',
                'en_description' => 'Buying, selling, and developing real estate properties for residential or commercial purposes.'
            ],
            [
                'fr' => 'Gestion immobilière',
                'en' => 'Property Management',
                'fr_description' => 'Gestion et entretien de biens immobiliers pour le compte de propriétaires ou d\'investisseurs.',
                'en_description' => 'Management and maintenance of real estate properties on behalf of owners or investors.'
            ],
            [
                'fr' => 'Facility Management',
                'en' => 'Facility Management',
                'fr_description' => 'Gestion intégrée des installations et des services pour optimiser le fonctionnement des bâtiments.',
                'en_description' => 'Integrated management of facilities and services to optimize building operations.'
            ],
            [
                'fr' => 'Matériel de construction',
                'en' => 'Construction Equipment',
                'fr_description' => 'Fourniture et maintenance d\'équipements et de machines utilisés dans les projets de construction.',
                'en_description' => 'Supply and maintenance of equipment and machinery used in construction projects.'
            ],
            [
                'fr' => 'Matériaux de construction',
                'en' => 'Building Materials',
                'fr_description' => 'Production et distribution de matériaux essentiels utilisés dans la construction de bâtiments et d\'infrastructures.',
                'en_description' => 'Production and distribution of essential materials used in the construction of buildings and infrastructure.'
            ],
            [
                'fr' => "Construction d'immeubles",
                'en' => 'Green Building',
                'fr_description' => 'Construction de bâtiments écologiques utilisant des matériaux durables et des technologies économes en énergie.',
                'en_description' => 'Construction of environmentally friendly buildings using sustainable materials and energy-efficient technologies.'
            ],
            [
                'fr' => 'Efficacité énergétique',
                'en' => 'Energy Efficiency',
                'fr_description' => 'Mise en œuvre de solutions pour réduire la consommation d\'énergie dans les bâtiments et les infrastructures.',
                'en_description' => 'Implementation of solutions to reduce energy consumption in buildings and infrastructure.'
            ],
            [
                'fr' => 'Bâtiments intelligents',
                'en' => 'Smart Buildings',
                'fr_description' => 'Intégration de technologies avancées pour créer des bâtiments automatisés et connectés.',
                'en_description' => 'Integration of advanced technologies to create automated and connected buildings.'
            ],
            [
                'fr' => 'Construction modulaire',
                'en' => 'Modular Construction',
                'fr_description' => 'Utilisation de modules préfabriqués pour une construction plus rapide et plus efficace.',
                'en_description' => 'Use of prefabricated modules for faster and more efficient construction.'
            ],
            [
                'fr' => 'Préfabrication',
                'en' => 'Prefabrication',
                'fr_description' => 'Fabrication hors site de composants de construction pour une installation rapide sur le chantier.',
                'en_description' => 'Off-site manufacturing of construction components for quick on-site installation.'
            ],
            [
                'fr' => 'Technologie de construction',
                'en' => 'Construction Technology',
                'fr_description' => 'Développement et application de technologies innovantes pour améliorer les processus de construction.',
                'en_description' => 'Development and application of innovative technologies to improve construction processes.'
            ],
            [
                'fr' => 'Sécurité de construction',
                'en' => 'Construction Safety',
                'fr_description' => 'Mise en place de mesures et de pratiques pour assurer la sécurité sur les chantiers de construction.',
                'en_description' => 'Implementation of measures and practices to ensure safety on construction sites.'
            ],
        ];

        $faker = Factory::create();

        // Réinitialisation sécurisée
        Schema::disableForeignKeyConstraints();
        Project::query()->delete();
        Category::query()->delete();
        Schema::enableForeignKeyConstraints();

        // Réinitialisation du stockage
        Storage::disk('public')->deleteDirectory('categories');
        Storage::disk('public')->makeDirectory('categories');

        foreach ($categories as $categoryName) {
            $baseSlug = Str::slug($categoryName['en']);
            $slug = $baseSlug;
            $counter = 1;

            // Vérification d'unicité dans la base (redondant après suppression mais utile en cas d'ajouts)
            while (Category::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }



            // Création avec gestion d'erreur
            try {
                Category::create([
                    'fr_name' => $categoryName['fr'],
                    'en_name' => $categoryName['en'],
                    'slug' => $slug,
                    'fr_description' =>  $categoryName['fr_description'] ,
                    'en_description' => $categoryName['en_description'] ,
                    'image' => null,
                ]);
            } catch (\Exception $e) {
                $this->command->error("Erreur création catégorie $categoryName: " . $e->getMessage());
            }
        }

        $this->command->info(count($categories) . ' catégories créées avec ' . Category::count() . ' enregistrements.');
    }
}
