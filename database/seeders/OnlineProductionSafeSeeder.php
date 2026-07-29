<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Store;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OnlineProductionSafeSeeder extends Seeder
{
    /**
     * Seed initial configuration and essential pages for production
     * without altering or conflicting with any existing online data.
     */
    public function run(): void
    {
        // 1. Admin Account (Create only if email does not exist)
        User::firstOrCreate(
            ['email' => 'admin@fresmart.ao'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Global Settings (Create only if record 1 missing)
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

        // 3. Managed Pages CMS Registry (Create only if slug missing)
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
    }
}
