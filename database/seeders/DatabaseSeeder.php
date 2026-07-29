<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Product;
use App\Models\Service;
use App\Models\Slide;
use App\Models\Campaign;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database safely without conflicting with online production data.
     */
    public function run(): void
    {
        // 1. User / Admin Standard Account (firstOrCreate)
        User::firstOrCreate(
            ['email' => 'admin@fresmart.ao'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Settings (firstOrCreate)
        Setting::firstOrCreate(
            ['id' => 1],
            [
                'description' => 'Servindo Angola com coração. Qualidade, frescura e os melhores preços perto de si.',
                'phone' => '+244 923 000 000',
                'email' => 'geral@fresmart.ao',
                'address' => 'Avenida Luanda, Angola',
                'facebook' => 'https://facebook.com/fresmart',
                'instagram' => 'https://instagram.com/fresmart',
                'tiktok' => 'https://tiktok.com/@fresmart',
                'linkedin' => 'https://linkedin.com/company/fresmart',
                'youtube' => 'https://youtube.com/@fresmart',
            ]
        );

        // 3. Pages CMS Registry (firstOrCreate by slug)
        $pages = [
            [
                'slug' => 'home',
                'name' => 'Página Inicial (Início)',
                'title' => 'Fresmart - O seu Supermercado de Confiança',
                'subtitle' => 'Produtos frescos, preços baixos e ofertas imperdíveis todos os dias em Angola.',
            ],
            [
                'slug' => 'about',
                'name' => 'Quem Somos',
                'title' => 'Quem Somos',
                'subtitle' => 'Saiba mais sobre a nossa história, visão e o compromisso da Fresmart com as famílias angolanas.',
                'content_title' => 'A Nossa Empresa',
                'content' => 'Fundada em Angola, a Fresmart é uma rede de supermercados dedicada a oferecer produtos alimentares de elevada qualidade, com especial foco nos produtos frescos e de origem nacional.',
            ],
            [
                'slug' => 'sustainability',
                'name' => 'Sustentabilidade',
                'title' => 'Sustentabilidade',
                'subtitle' => 'Promovemos práticas sustentáveis e apoio direto à agricultura local.',
                'content_title' => 'O Nosso Compromisso Ambiental',
                'content' => 'Na Fresmart, acreditamos num futuro mais verde e responsável. Trabalhamos diariamente para reduzir o desperdício alimentar, otimizar embalagens e apoiar a produção local angolana.',
            ],
            [
                'slug' => 'social_responsibility',
                'name' => 'Responsabilidade Social',
                'title' => 'Responsabilidade Social',
                'subtitle' => 'Investimos no bem-estar das comunidades e em causas sociais ativas.',
                'content_title' => 'Apoio Ativo à Comunidade',
                'content' => 'Desenvolvemos e apoiamos iniciativas sociais focadas na nutrição infantil, educação e apoio a famílias em situação de vulnerabilidade.',
            ],
            [
                'slug' => 'posts',
                'name' => 'Notícias',
                'title' => 'Notícias & Novidades',
                'subtitle' => 'Fique a par das últimas aberturas de lojas, eventos e notícias institucionais da Fresmart.',
            ],
            [
                'slug' => 'careers',
                'name' => 'Trabalhe Connosco',
                'title' => 'Trabalhe Connosco',
                'subtitle' => 'Junte-se à equipa Fresmart e construa um futuro de sucesso connosco.',
                'content_title' => 'Construa o seu Futuro na Fresmart',
                'content' => 'Valorizamos o talento, a dedicação e o espírito de equipa. Oferecemos oportunidades de crescimento profissional num ambiente dinâmico e acolhedor.',
            ],
            [
                'slug' => 'contacts',
                'name' => 'Contactos',
                'title' => 'Fale Connosco',
                'subtitle' => 'Estamos disponíveis para responder a dúvidas, sugestões ou parcerias comerciais.',
            ],
            [
                'slug' => 'products',
                'name' => 'Produtos',
                'title' => 'Nossos Produtos',
                'subtitle' => 'Conheça a frescura e qualidade dos nossos departamentos.',
            ],
            [
                'slug' => 'services',
                'name' => 'Serviços',
                'title' => 'Nossos Serviços',
                'subtitle' => 'Soluções pensadas para facilitar as suas compras diárias.',
            ],
            [
                'slug' => 'campaigns',
                'name' => 'Ofertas e Folhetos',
                'title' => 'Ofertas & Campanhas',
                'subtitle' => 'Consulte os nossos folhetos promocionais e aproveite os melhores descontos.',
            ],
            [
                'slug' => 'stores',
                'name' => 'Nossas Lojas',
                'title' => 'Encontre as Nossas Lojas',
                'subtitle' => 'Consulte os endereços, horários de funcionamento e serviços em cada loja Fresmart.',
            ],
        ];

        foreach ($pages as $pageData) {
            Page::firstOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }

        // 4. Default Stores (firstOrCreate by slug)
        $stores = [
            [
                'name' => 'Fresmart Talatona',
                'slug' => 'fresmart-talatona',
                'city' => 'Luanda',
                'bairro' => 'Talatona',
                'address' => 'Av. Talatona, Luanda, Angola',
                'lat' => -8.91750000,
                'lng' => 13.18660000,
                'opening_time' => '07:00:00',
                'closing_time' => '22:00:00',
                'phone' => '+244 923 000 001',
                'email' => 'talatona@fresmart.ao',
                'status' => 'Aberta',
            ],
            [
                'name' => 'Fresmart Belas',
                'slug' => 'fresmart-belas',
                'city' => 'Luanda',
                'bairro' => 'Belas',
                'address' => 'Rua Principal, Belas, Luanda',
                'lat' => -8.96220000,
                'lng' => 13.14920000,
                'opening_time' => '07:00:00',
                'closing_time' => '22:00:00',
                'phone' => '+244 923 000 002',
                'email' => 'belas@fresmart.ao',
                'status' => 'Aberta',
            ],
            [
                'name' => 'Fresmart Viana',
                'slug' => 'fresmart-viana',
                'city' => 'Luanda',
                'bairro' => 'Viana',
                'address' => 'Av. 4 de Fevereiro, Viana',
                'lat' => -8.90560000,
                'lng' => 13.36440000,
                'opening_time' => '07:00:00',
                'closing_time' => '21:00:00',
                'phone' => '+244 923 000 003',
                'email' => 'viana@fresmart.ao',
                'status' => 'Aberta',
            ],
            [
                'name' => 'Fresmart Kilamba',
                'slug' => 'fresmart-kilamba',
                'city' => 'Luanda',
                'bairro' => 'Kilamba',
                'address' => 'Rua do Comércio, Kilamba',
                'lat' => -8.99500000,
                'lng' => 13.25000000,
                'opening_time' => '07:00:00',
                'closing_time' => '22:00:00',
                'phone' => '+244 923 000 004',
                'email' => 'kilamba@fresmart.ao',
                'status' => 'Aberta',
            ],
            [
                'name' => 'Fresmart Benguela',
                'slug' => 'fresmart-benguela',
                'city' => 'Benguela',
                'bairro' => 'Centro',
                'address' => 'Avenida Eduardo dos Santos, Benguela',
                'lat' => -12.57830000,
                'lng' => 13.40720000,
                'opening_time' => '08:00:00',
                'closing_time' => '20:00:00',
                'phone' => '+244 923 000 005',
                'email' => 'benguela@fresmart.ao',
                'status' => 'Aberta',
            ],
        ];

        foreach ($stores as $storeData) {
            Store::firstOrCreate(
                ['slug' => $storeData['slug']],
                $storeData
            );
        }

        // 5. Default Product Categories (firstOrCreate by slug)
        $defaultProducts = [
            [
                'name' => 'Frutas e Legumes',
                'slug' => 'frutas-e-legumes',
                'description' => 'Fruta fresca de época e legumes selecionados diariamente para garantir a máxima qualidade na sua mesa.',
                'show_title' => true,
            ],
            [
                'name' => 'Frescos',
                'slug' => 'frescos',
                'description' => 'Laticínios, iogurtes, queijos, charcutaria e refeições prontas. A frescura que a sua família merece.',
                'show_title' => true,
            ],
            [
                'name' => 'Talho',
                'slug' => 'talho',
                'description' => 'Cortes de carne bovina, suína, aves e enchidos frescos. Peça ao nosso mestre talhante o seu corte favorito.',
                'show_title' => true,
            ],
            [
                'name' => 'Padaria',
                'slug' => 'padaria',
                'description' => 'Pão quente a toda a hora, pastelaria fina e croissants acabados de cozer. O cheirinho a padaria tradicional.',
                'show_title' => true,
            ],
        ];

        foreach ($defaultProducts as $productData) {
            Product::firstOrCreate(
                ['slug' => $productData['slug']],
                $productData
            );
        }

        // 6. Default Services (firstOrCreate by slug)
        $defaultServices = [
            [
                'name' => 'Talho Atendido',
                'slug' => 'talho-atendido',
                'description' => 'Atendimento personalizado com corte de carne feito à sua medida pelos nossos especialistas.',
                'show_title' => true,
            ],
            [
                'name' => 'Padaria & Pastaria',
                'slug' => 'padaria-pastaria',
                'description' => 'Pão quente cozido várias vezes ao dia e pastelaria deliciosa para todos os momentos.',
                'show_title' => true,
            ],
            [
                'name' => 'Cafetaria Fresmart',
                'slug' => 'cafetaria-fresmart',
                'description' => 'Espaço aconchegante para tomar o seu café expresso, refeições rápidas e lanches saborosos.',
                'show_title' => true,
            ],
        ];

        foreach ($defaultServices as $serviceData) {
            Service::firstOrCreate(
                ['slug' => $serviceData['slug']],
                $serviceData
            );
        }
    }
}
