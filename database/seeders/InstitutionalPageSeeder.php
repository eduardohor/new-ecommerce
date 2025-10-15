<?php

namespace Database\Seeders;

use App\Models\InstitutionalPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class InstitutionalPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Termos e Condições',
                'slug' => 'termos-e-condicoes',
                'content' => '<h2>Termos e Condições</h2><p>Este é um texto de exemplo que descreve os termos e condições da loja. Personalize este conteúdo conforme as políticas do seu negócio.</p>',
            ],
            [
                'title' => 'Política de Privacidade',
                'slug' => 'politica-de-privacidade',
                'content' => '<h2>Política de Privacidade</h2><p>Exemplo de conteúdo explicando como os dados dos clientes são coletados, utilizados e protegidos. Atualize com as informações reais da empresa.</p>',
            ],
            [
                'title' => 'Política de Cookies',
                'slug' => 'politica-de-cookies',
                'content' => '<h2>Política de Cookies</h2><p>Descreva aqui como os cookies são utilizados no site, quais dados são armazenados e como o usuário pode gerenciar suas preferências.</p>',
            ],
            [
                'title' => 'Sobre Nós',
                'slug' => 'sobre-nos',
                'content' => '<h2>Sobre Nós</h2><p>Conte a história da sua empresa, missão, valores e diferenciais. Utilize este texto como ponto de partida e adapte para refletir sua marca.</p>',
            ],
        ];

        foreach ($pages as $page) {
            $slug = Str::slug($page['slug'] ?? $page['title']);

            InstitutionalPage::updateOrCreate(
                ['slug' => $slug],
                Arr::only($page, ['title', 'content']) + [
                    'slug' => $slug,
                    'is_active' => true,
                ]
            );
        }
    }
}
